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
        $billing = MasterBilling::get();

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
        //
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
