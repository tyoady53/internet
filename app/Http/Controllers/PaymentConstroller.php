<?php

namespace App\Http\Controllers;

use App\Models\CustomerBilling;
use App\Models\CustomerGroup;
use App\Models\SetupProgram;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class PaymentConstroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = CustomerGroup::orderBy('group_name')->get();
        $now = Carbon::now();
        $from_mo = Carbon::parse('2025-01-01');
        $month_arr = new Collection();
        $monthDiff = ($now->format('Y') - $from_mo->format('Y')) * 12 + ($now->format('m') - $from_mo->format('m')) + 1;
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        for ($i = 0; $i < $monthDiff; $i++){
            $month  = $from_mo->format('m')+$i;
            $year   = $from_mo->format('Y');
            $monthsBetween = $month % 12;
            if($month > 12){
                $yearsBetween = floor($month / 12);
                if($monthsBetween > 0){
                    if($monthsBetween < 10){
                        $month_current = '0'.$monthsBetween;
                    } else {
                        $month_current = $monthsBetween;
                    }
                    $year_current = $year+$yearsBetween;
                } else {
                    $month_current = 12;
                    $year_current = $year+$yearsBetween-1;
                }
            } else {
                if($month < 10){
                    $month_current = '0'.$month;
                } else {
                    $month_current = $month;
                }
                $year_current = $year;
            }
            $month_arr->push((object)['key' => $year_current.'-'.$month_current, 'value' => $year_current.'-'.$months[$month_current-1]]);
        }

        $return_array =[];
        if(request()->periode && request()->group) {
            $date = request()->periode;
            $data = CustomerGroup::where('id',request()->group)->with(['customers.package','customers.billing' => function ($query) use ($date) {
                $query->where('billing_date', $date);
            }])->get();

            $return_array = [
                'Sudah Bayar' => [],
                'Belum Bayar' => []
            ];
            // dd($data);

            foreach($data as $d) {
                $billingData = $d['customers']->map(function ($customer) {
                    if(count($customer['billing']) > 0) {
                        return [
                            'name' => $customer->name,
                            'paket' => $customer['package']['billing_name'],
                            'billing_number' => $customer['billing'][0]['billing_number'],
                            'tanggal_billing' => $customer['billing'][0]['billing_date'],
                            'tanggal_bayar' => $customer['billing'][0]['pay_date'] ? $customer['billing'][0]['pay_date'] : '-',
                            'jumlah' => $customer['billing'][0]['price'],
                            'diskon' => $customer['billing'][0]['discount'],
                            'total' => $customer['billing'][0]['total'],
                        ];
                    }
                    return null;
                })
                ->filter();

                foreach ($billingData as $billing) {
                    $paymentDate = $billing['tanggal_bayar'];
                    if ($paymentDate == '-') {
                        $return_array['Belum Bayar'][] = $billing;
                    } else {
                        $return_array['Sudah Bayar'][] = $billing;
                    }
                }
            }
        }
        return view('pages.payment.index',[
            'groups'    => $groups,
            'filters'   => $month_arr->reverse(),
            'datas'      => $return_array
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pay($request) {
        $transaction = CustomerBilling::where('billing_number',$request)->first();
        // dd($transaction);
        $update = CustomerBilling::where('billing_number',$request)->update([
            'pay_date'  => Carbon::now()
        ]);

        if($update) {
            return response()->json([
                'status'    => 200,
                'message'   => 'Insert Success',
                'data'      => $transaction->billing_number,
            ]);
        }

        return response()->json([
            'status'    => 402,
            'message'   => 'Transaction Failed',
        ]);
    }

    public function print_receipt($request) {
        $transaction = CustomerBilling::where('billing_number',$request)->with('customer.group')->first();
        if(is_null($transaction->pay_date)) {
            return redirect('payment/index');
        }

        // dd($transaction);
        $setup = SetupProgram::where('id',1)->first();
        return view('layouts.receipt',[
            'data' => $transaction,
            'setup'=> $setup,
        ])->with('success','created');
    }

    public function reprint($request) {

    }
}
