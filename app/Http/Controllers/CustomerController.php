<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\MasterBilling;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = [];
        $users = CustomerGroup::with('customers.package')->orderBy('group_name')->get()->toArray();
        $groups = CustomerGroup::orderBy('group_name')->get();
        $billings = MasterBilling::get();
        return view('pages.customers.index',[
            'cust_groups'   => $users,
            'groups'        => $groups,
            'billings'      => $billings,
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
        $validated = $request->validate([
            'name'      => 'required',
            // 'address'   => 'required',
            'group'     => 'required',
            'package'   => 'required',
        ]);

        $group = CustomerGroup::where('id', $request->group)->first();

        if(!$request->address) {
            $address = $group->group_name;
        } else {
            $address = $request->address;
        }

        if(!$request->join_date) {
            $join_date = Carbon::now()->format('Y-m-d');
        } else {
            $join_date = $request->join_date;
        }

        if(!$request->discount) {
            $discount = 0;
        } else {
            $discount = $request->discount;
        }

        $last_data = Customer::where('join_date', $join_date)->where('group_id',$request->group)->latest()->first();
        $last_number = (int) substr($last_data->customer_number,4,4) + 1;

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $generated = substr(str_shuffle($characters), 0, 4);

        $customer_number = Carbon::parse($join_date)->format('ym').str_pad($last_number, 4, '0', STR_PAD_LEFT).str_pad($request->group, 4, '0', STR_PAD_LEFT).$generated;
        $insert = [
            'name'      => $request->name,
            'address'   => $address,
            'join_date' => $join_date,
            'group_id'  => $request->group,
            'discount'  => $discount,
            'billing_id'=> $request->package,
            'quantity'  => 1,
            'is_active' => '1',
            'encrypted_id' => md5(Carbon::now()->format('Y-m-d H:i').$request->group.$request->package),
            'customer_number' => $customer_number
        ];

        $save = Customer::create($insert);

        if($save) {
            return redirect('customer/index')->with('success','created');
        }else {
            return redirect('customer/index')->with('success','failed');
        }
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

    public function fetch() {
        $customers = Customer::with('package')->orderBy('join_date')->orderBy('group_id')->get();
        $last_data = 1;
        $return = ''; $message = '';
        $join_date = '2024-01-08';
        foreach($customers as $customer) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $generated = substr(str_shuffle($characters), 0, 4);
            if(Carbon::parse($customer->join_date)->format('ym') >  Carbon::parse($join_date)->format('ym')) {
                $join_date = $customer->join_date;
                $last_data = 1;
            }
            $customer_number = Carbon::parse($join_date)->format('ym').str_pad($last_data, 4, '0', STR_PAD_LEFT).str_pad($customer->group_id, 4, '0', STR_PAD_LEFT).$generated;
            $insert= [
                'customer_number'   => $customer_number,
            ];
            $last_data += 1;
            if($customer->customer_number == '' || $customer->customer_number == null){
                $customer->update($insert);
            }
        }

        return redirect('customer/index')->with('success','updated');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);

		// menangkap file excel
		$file = $request->file('file');

		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();

		// upload ke folder file_siswa di dalam folder public
		$file->move('file_upload',$nama_file);

		// import data
		Excel::import(new CustomerImport, public_path('/file_upload/'.$nama_file));

		// notifikasi dengan session
		// Session::flash('sukses','Data Siswa Berhasil Diimport!');

		// alihkan halaman kembali
		return redirect('customer/index')->with('success','saved');
    }
}
