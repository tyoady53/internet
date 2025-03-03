<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerBilling;
use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class CustomerBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = [];
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
                    // $month_current = $monthsBetween;
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
        return view('pages.billings.index',[
            'user'      => $users,
            'filters'   => $month_arr->reverse(),
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
    public function show(CustomerBilling $customerBilling)
    {
        //
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

    public function fetch($date) {
        $data = CustomerBilling::where('billing_date', $date)->pluck('customer_id')->toArray();
        $cut_date = substr($date,-5);
        $customers = Customer::with('package')->whereNotIn('id',$data)->get();
        foreach($customers as $customer) {
            $price = $customer->package->price;
            $discount = (int)$customer->discount/100 * (int)$customer->package->price;
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $billing_number = $cut_date.'-'.str_pad($customer->id, 4, '0', STR_PAD_LEFT).'-'.substr(str_shuffle($characters), 0, 4);
            $insert = [
                'customer_id'   => $customer->id,
                'billing_date'  => $date,
                'package_name'  => $customer->package->billing_name,
                'price'         => $price,
                'quantity'      => 1,
                'discount'      => $discount,
                'total'         => $price - $discount,
                'billing_number'=> $billing_number
            ];
            CustomerBilling::create($insert);
        }
        return response()->json([
            'status'    => 200,
            'message'   => 'Fetch data '.$date.' success',
        ]);
        // dd($date);
    }

    public function get($date) {
        $data = CustomerGroup::with(['customers.package','customers.billing' => function ($query) use ($date) {
            $query->where('billing_date', $date);
        }])->get();
        return response()->json([
            'status'    => 200,
            'message'   => 'Fetch data '.$date.' success',
            'data'      => $data
        ]);
    }
}
