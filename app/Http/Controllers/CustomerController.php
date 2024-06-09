<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Customer::orderBy('status','DESC')->orderBy('house_no','ASC')->get();
        return view('pages.customers.index',[
            'user'      => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.customers.create',[
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $year_date =Carbon::now()->format('Ym');
        // dd($year_date);
        $last_data = Customer::where('customer_number','LIKE','%'.$year_date.'%')->orderBy('customer_number','DESC')->first();
        if($last_data){
            $customer_number = (int)$last_data->customer_number + 1;
        } else {
            $customer_number = $year_date.'001';
        }
        $insert = Customer::create([
            'name'          => $request->name,
            'address'       => $request->address,
            'status'        => '1',
            'encrypted_id'  => '-',
            'billing_number'=> $request->billing,
            'phone'         => $request->phone,
            'customer_number'   => $customer_number,
        ]);

        // dd('insert->id '.$insert->id,$insert->id.Carbon::now(),'md5 Now'.md5(Carbon::now()),'md5 uniq '.md5($insert->id.Carbon::now()));

        $encrypted_id   = md5($insert->id.Carbon::now());


        if($insert){
            $insert->update(['encrypted_id'  => $encrypted_id]);
        }

        return redirect('customer/index')->with('success','created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer,$slug)
    {
        $user   = Customer::where('encrypted_id',$slug)->first();
        return view('pages.customers.edit',[
            'user'      => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $slug)
    {
        $array_update = [];
        $user   = Customer::where('encrypted_id',$slug)->first();
        if($request->status){
            $array_update['status'] = 1;
            $status = 1;
        } else {
            $array_update['status'] = 0;
            $status = 0;
        }
        if($request->name){
            $array_update['name'] = $request->name;
        }
        if($request->address){
            $array_update['address'] = $request->address;
        }
        if($request->house_no){
            $array_update['house_no'] = $request->house_no;
        }
        if($request->billing_number){
            $array_update['billing_number'] = $request->billing_number;
        }
        if($request->phone){
            $array_update['phone'] = $request->phone;
        }
        // dd($array_update);
        $update = $user->update($array_update);

        return redirect('customer/index')->with('success','updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
