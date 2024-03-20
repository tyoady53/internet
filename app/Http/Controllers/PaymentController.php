<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBilling;
use App\Models\MasterBilling;
use App\Models\Payment;
use App\Models\PaymentDetail;
use App\Models\SetupProgram;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();
        $users = Customer::with(['billings.consumption',
        'billings'=> function ($query) use ($now) {
            $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->whereNull('pay_date');
        }])->whereHas('billings', function ($query) {
            $query->whereNull('pay_date');
        })->get();

        $paid = Payment::with('detail.billing','customer')->get();

        // dd($paid);

        return view('pages.payment.index',[
            'data'      => $users,
            'paid'      => $paid,
            'setup'     => SetupProgram::where('id',1)->first(),
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

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function payment($unique_id)
    {
        $now = Carbon::now();
        $get = Customer::where('encrypted_id',$unique_id)->with(['billings.consumption',
        'billings'=> function ($query) use ($now) {
            $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->whereNull('pay_date');
        }])
        ->first();
        // dd($get);
        // dd(count($get->billings));
        $data = '';
        if(count($get->billings)){
            // $this->show_kwitansi($get);
            $now = Carbon::now();
            $setup = SetupProgram::where('id',1)->first();
            $payment = Payment::create([
                'customer_id'   => $get->id,
                'created_by'    => auth()->user()->id,
                'payment'       => $now,
                'encrypted_id'  => md5($get->id.Carbon::now())
            ]);

            foreach($get->billings as $billing){
                $fines = $billing->late * $setup->fine_fee;
                CustomerBilling::where('id',$billing->id)->update([
                    'fines'     => $fines,
                    'pay_date'  => $now
                ]);

                PaymentDetail::create([
                    'payment_id'    => $payment->id,
                    'billing_id'    => $billing->id,
                    'fines'         => $fines,
                    'administration_fee'    => $setup->administration_fee,
                    'price'         => $billing->price_total,
                    'late'          => $billing->late,
                    'total'         => $setup->administration_fee+$fines+$billing->price_total,
                ]);
            }
            $data = Payment::with('detail.billing.consumption','customer')->where('id',$payment->id)->first();

            $billing_periode = $payment->payment;
            $billing_month = explode("-",$billing_periode)[1];
            $billing_date = '';
            switch ($billing_month) {
                case "01":
                    $billing_date = "Januari ".explode("-",$billing_periode)[0];
                    break;
                case "02":
                    $billing_date = "Februari ".explode("-",$billing_periode)[0];
                    break;
                case "03":
                    $billing_date = "Maret ".explode("-",$billing_periode)[0];
                    break;
                case "04":
                    $billing_date = "April ".explode("-",$billing_periode)[0];
                    break;
                case "05":
                    $billing_date = "Mei ".explode("-",$billing_periode)[0];
                    break;
                case "06":
                    $billing_date = "Juni ".explode("-",$billing_periode)[0];
                    break;
                case "07":
                    $billing_date = "Juli ".explode("-",$billing_periode)[0];
                    break;
                case "08":
                    $billing_date = "Agustus ".explode("-",$billing_periode)[0];
                    break;
                case "09":
                    $billing_date = "September ".explode("-",$billing_periode)[0];
                    break;
                case "10":
                    $billing_date = "Oktober ".explode("-",$billing_periode)[0];
                    break;
                case "11":
                    $billing_date = "November ".explode("-",$billing_periode)[0];
                    break;
                case "12":
                    $billing_date = "Desember ".explode("-",$billing_periode)[0];
                    break;
                default:
                    $billing_date = "-";
            }

            // return view('layouts.kwitansi',[
            //     'setup'         => $setup,
            //     'data'          => $data,
            //     'billing_date'  => $billing_date
            // ])->with('success','created');
        }

        return redirect('payment/index')->with('success','created');
    }

    public function print($unique_id)
    {
        $data = Payment::where('encrypted_id',$unique_id)->with('detail.billing','customer')->first();
        $setup = SetupProgram::where('id',1)->first();
        // dd($data);
        return view('layouts.kwitansi',[
            'data' => $data,
            'setup'=> $setup,
        ])->with('success','created');
    }
}
