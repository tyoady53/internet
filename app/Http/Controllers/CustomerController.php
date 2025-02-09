<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\CustomerGroup;
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
        return view('pages.customers.index',[
            'cust_groups'      => $users,
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
            'name'          => 'required',
            'address'       => 'required',
            'billing'       => 'required',
            'house_no'      => 'required',
            'phone'         => 'required',
        ]);

        $year_date =Carbon::now()->format('Ym');
        $last_data = Customer::where('customer_number','LIKE','%'.$year_date.'%')->orderBy('customer_number','DESC')->first();
        if($last_data){
            $customer_number = (int)$last_data->customer_number + 1;
        } else {
            $customer_number = $year_date.'001';
        }
        $water_meter_no = "";
        if($request->water_meter_no){
            $water_meter_no = $request->water_meter_no;
        }
        $insert = Customer::create([
            'name'          => $request->name,
            'address'       => $request->address,
            'status'        => '1',
            'encrypted_id'  => '-',
            'water_meter_no'=> $water_meter_no,
            'billing_number'=> $request->billing,
            'house_no'      => $request->house_no,
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
