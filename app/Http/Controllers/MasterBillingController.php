<?php

namespace App\Http\Controllers;

use App\Models\MasterBilling;
use Illuminate\Http\Request;

class MasterBillingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $billing = MasterBilling::orderByRaw('CAST(package AS UNSIGNED)')->get();

        return view('pages.master.billing',[
            'data'      => $billing,
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
        // dd($request);
        $random = md5($request->package.$request->_token);
        $price = str_replace(".","",$request->price);

        $insert = MasterBilling::create([
            'billing_name'  => $request->package.' MBPS',
            'package'       => $request->package,
            'unit'          => 'mbps',
            'price'         => $price,
            'is_active'     => 1,
            'encrypted_id'  => $random
        ]);

        if($insert) {
            return redirect('master-bill/index')->with('success','created');
        }

        return redirect('master-bill/index')->with('success','failed');
        // dd($request,$request->_token,$random,$price);
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterBilling $masterBilling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterBilling $masterBilling)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterBilling $masterBilling)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterBilling $masterBilling)
    {
        //
    }
}
