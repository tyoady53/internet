<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBilling;
use App\Models\CustomerConsumption;
use App\Models\MasterBilling;
use App\Models\PrintCount;
use App\Models\SetupProgram;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

class CustomerBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Customer::with(['billings' => function ($query) {
            return $query->orderBy('tempo','DESC');
        }])->get();
        // dd($users);

        return view('pages.billings.index',[
            'user'      => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($unique_id)
    {
        $customer = Customer::where('encrypted_id',$unique_id)->with(['billings' => function ($query) {
            $query->orderBy('tempo','DESC')->first();
        }])->get();

        $year_arr = array();
        $billings = array();
        $now = Carbon::now();
        $from = '2023-11-01';
        $from_mo = Carbon::parse($from);
        $to = $now->toDateString();
        $period = CarbonPeriod::create($from, '1 year', $to);
        $month_diff = $from_mo->diffInMonths($to);

        foreach ($period as $dt) {
            array_push($year_arr,$dt);
        }
        $month_arr = new Collection();
        $months = array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");
        for ($i = 0; $i < count($year_arr); $i++){
            $year_now = $year_arr[$i];
            // foreach ($months as $idx => $month) {
            for ($j = 0; $j <12;$j++) {
                if($j < 9){
                    $now_idx = '0'.$j + 1;
                } else {
                    $now_idx = $j + 1;
                }
                $month_arr->push((object)['key' => substr($year_now,0,4).'-'.$now_idx, 'value' => substr($year_now,0,4).'-'.$months[$j]]);
            }
        }
        $billings_collection = MasterBilling::get();
        foreach ($billings_collection as $bill) {
            array_push($billings,$bill);
        }

        return view('pages.billings.create',[
            'month_arr'     => $month_arr,
            'customer'      => $customer,
            'billings'      => $billings,
            'unique_id'     => $unique_id,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$unique_id)
    {
        // $inputString = $request->usage;
        $a = 0; $total = 0;
        $customer = Customer::where('encrypted_id',$unique_id)->first();
        $billing_date = new Carbon($request->periode.'-20');
        $billing_tempo = $billing_date->addMonth()->format('Y-m-d');
        $billings_collection = MasterBilling::get();
        $data = CustomerBilling::where('customer_id',$customer->id)->orderBy('billing_date','DESC')->first();
        $inputString = $request->usage -($data ? $data->water_meter_count : 0);
        $print_count = PrintCount::where('billing_date',$request->periode)->first();
        $billing_no = '';
        if(!$print_count){
            PrintCount::create([
                'billing_date'  => $request->periode,
                'print_count'  => 1,
            ]);
            $billing_no = str_replace("-","/",$request->periode).'/'.$customer->customer_number.'/0001';
        } else {
            $count = $print_count->print_count + 1;
            $print_count->update([
                'print_count'   => $count
            ]);
            if($count < 10){
                $number = '000'.$count;
            }
            else if($count < 100){
                $number = '00'.$count;
            }
            else if($count < 1000){
                $number = '0'.$count;
            } else {
                $number = $count;
            }
            $billing_no = str_replace("-","/",$request->periode).'/'.$customer->customer_number.'/'.$number;
        }
        $insert = CustomerBilling::create([
            'customer_id'   => $customer->id,
            'billing_date'  => $request->periode,
            'tempo'         => $billing_tempo,
            'usage'         => $request->usage,
            'administration_fees'   => 2500,
            'price_total'   => 0,
            'water_meter_count' => $request->last_usage,
            'billing_number'    => $billing_no,
        ]);
        foreach ($billings_collection as $bill) {
            if($inputString > $bill->minimal - 1){
                if($inputString > $bill->minimal) {
                    if($inputString > $bill->maximal){
                        $a = $a+($bill->maximal - ($bill->minimal -1)) * $bill->price;
                        CustomerConsumption::create([
                            'consumption_id'    => $insert->id,
                            'billing_id'        => $bill->id,
                            'usage'             => $bill->maximal - ($bill->minimal -1),
                            'price'             => $bill->price
                        ]);
                    }
                    else {
                        $a = $a+($inputString - ($bill->minimal -1)) * $bill->price;
                        CustomerConsumption::create([
                            'consumption_id'    => $insert->id,
                            'billing_id'        => $bill->id,
                            'usage'             => $inputString - ($bill->minimal -1),
                            'price'             => $bill->price
                        ]);
                    }
                } else {
                    $a = $a+($inputString - ($bill->minimal -1)) * $bill->price;
                    CustomerConsumption::create([
                        'consumption_id'    => $insert->id,
                        'billing_id'        => $bill->id,
                        'usage'             => $inputString - ($bill->minimal -1),
                        'price'             => $bill->price
                    ]);
                    // a += '<label> >'+billing_arr[i].minimal+' <br> &nbsp'+($inputString - (billing_arr[i].minimal - 1)) +'x'+ billing_arr[i].price+' = Rp'+($inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price+'</label> <br>';
                    // total += ($inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price;
                }
            } else {
                if($inputString > ($bill->minimal - 1)) {
                    if($inputString > $bill->maximal){
                        $a = $a+($bill->maximal - ($bill->minimal -1)) * $bill->price;
                        CustomerConsumption::create([
                            'consumption_id'    => $insert->id,
                            'billing_id'        => $bill->id,
                            'usage'             => $bill->maximal - ($bill->minimal -1),
                            'price'             => $bill->price
                        ]);
                        // a += '<label>'+$bill->minimal+'-'+$bill->maximal+' <br> &nbsp'+($bill->maximal - ($bill->minimal -1)) +'x'+ $bill->price+' = Rp'+($bill->maximal - ($bill->minimal -1)) * $bill->price+'</label> <br>';
                        // total += ($bill->maximal - ($bill->minimal -1)) * $bill->price;
                    }
                    else {
                        $a = $a+($inputString - ($bill->minimal -1)) * $bill->price;
                        CustomerConsumption::create([
                            'consumption_id'    => $insert->id,
                            'billing_id'        => $bill->id,
                            'usage'             => $inputString - ($bill->minimal -1),
                            'price'             => $bill->price
                        ]);
                        // a += '<label> '+$bill->minimal+'-'+$bill->maximal+' <br> &nbsp'+($inputString - ($bill->minimal - 1)) +'x'+ $bill->price+' = Rp'+($inputString - ($bill->minimal - 1)) * $bill->price+'</label> <br>';
                        // total += ($inputString - ($bill->minimal - 1)) * $bill->price;
                    }
                }
            }
        }

        $insert->update([
            'price_total'   => $a
        ]);
        // dd($unique_id);
        return redirect('billing/index')->with('success','created');
    }

    /**
     * Display the specified resource.
     */
    public function show($unique_id)
    {
        $now = Carbon::now();
        $customer = Customer::where('encrypted_id',$unique_id)->with(['billings.consumption',
        'billings'=> function ($query) use ($now) {
            $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late");
        }])
        ->first();
        // $data['customer']   = Customer::where('encrypted_id',$unique_id)->first();
        // foreach($customer->billings as $idx=>$billing){
        //     $data['billing'][$idx] = $now->diffInMonths($billing->billing_date);
        // }
        // dd($customer);

        return view('pages.billings.pay',[
            'data'      => $customer,
            'setup'     => SetupProgram::where('id',1)->first(),
            'date'      => $now,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerBilling $customerBilling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerBilling $customerBilling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerBilling $customerBilling)
    {
        //
    }

    public function print($unique_id,$date)
    {
        $setup = SetupProgram::where('id',1)->first();
        $now = Carbon::now();
        $get = Customer::where('encrypted_id',$unique_id)->with(['billings.consumption',
        'billings'=> function ($query) use ($now,$date) {
            $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->where('billing_date',$date);
        }])
        ->first();
        CustomerBilling::where('id',$get->billings[0]->id)->update([
            // 'late'  => $get->billings[0]->late,
            'fines' => $get->billings[0]->late * $setup->fine_fee
        ]);
        $data = $get = Customer::where('encrypted_id',$unique_id)->with(['billings.consumption',
        'billings'=> function ($query) use ($now,$date) {
            $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->where('billing_date',$date);
        }])
        ->first();
        $billing_periode = $data->billings[0]->billing_date;
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
            case "11":
                $billing_date = "Desember ".explode("-",$billing_periode)[0];
                break;
            default:
                $billing_date = "-";
          }
        // dd($data->billings[0]->billing_date,$billing_date);
        return view('layouts.print',[
            'data'          => $data,
            'billing_date'  => $billing_date
        ]);
    }
}
