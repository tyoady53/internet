<?php

namespace App\Http\Controllers;

use App\Models\BenchMarkGroup;
use App\Models\BenchMarkQuestion;
use App\Models\Customer;
use App\Models\CustomerBilling;
use App\Models\QuickResponseQuestion;
use App\Models\RolePlayGroup;
use App\Models\RolePlayQuestion;
use App\Models\RolePlaySubGroup;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Benchmark;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rolename = '';
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();
        // $rolenames = $user->getRoleNames();
        // if(count($rolenames)){
        //     $rolename = $rolenames[0];
        // }
        return view('pages.dashboard',[
            'role'      => $rolename,
        ]);
    }

    public function report(Request $request)
    {
        $paid_bill = array(); $unpaid_bill = array();
        $dates = CustomerBilling::select('billing_date')->distinct()->get();
        $now = Carbon::now();
        $from_mo = Carbon::parse($dates[0]->billing_date);
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

        if($request->periode){
            $paid_bill  = CustomerBilling::with('customer')->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->where('billing_date',$request->periode)->whereNotNull('pay_date')->get();

            // $unpaid_bill  = Customer::whereHas('billings', function ($query) {
            //     $query->whereNull('pay_date');
            // })
            // ->with(['billings'=> function ($query) use ($now,$request) {
            //     $query->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->where('billing_date',$request->periode);
            // }])
            // ->get();
            $unpaid_bill    = CustomerBilling::with('customer')->selectRaw("*, TIMESTAMPDIFF(MONTH, CONCAT(billing_date, '-20'), '$now') AS late")->where('billing_date',$request->periode)->whereNull('pay_date')->get();
        }

        // dd($request,$paid_bill,$unpaid_bill);

        return view('pages.report.index',[
            'filters'   => $month_arr,
            'paid'      => $paid_bill,
            'unpaid'    => $unpaid_bill,
        ]);
    }
}
