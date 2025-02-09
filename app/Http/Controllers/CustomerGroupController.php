<?php

namespace App\Http\Controllers;

use App\Models\CustomerGroup;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = CustomerGroup::orderBy('group_name')->get();

        return view('pages.master.cust-group',[
            'data'      => $data,
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
        $insert = CustomerGroup::create([
            'group_name'    => $request->group_name,
        ]);

        // dd('insert->id '.$insert->id,$insert->id.Carbon::now(),'md5 Now'.md5(Carbon::now()),'md5 uniq '.md5($insert->id.Carbon::now()));

        $encrypted_id   = md5($insert->id.Carbon::now());


        if($insert){
            $insert->update(['encrypted_id'  => $encrypted_id]);
        }

        return redirect('master-group/index')->with('success','created');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerGroup $customerGroup)
    {
        //
    }
}
