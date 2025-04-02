<?php

namespace App\Http\Controllers;

use App\Models\BenchMarkGroup;
use App\Models\BenchMarkQuestion;
use App\Models\Customer;
use App\Models\CustomerBilling;
use App\Models\CustomerGroup;
use App\Models\Payment;
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
        $os_name = php_uname('s');
        if($os_name == 'Linux') {
            $serial = shell_exec("sudo dmidecode -s baseboard-serial-number 2>/dev/null");
        } else {
            $serial = shell_exec("wmic baseboard get serialnumber");
        }
        dd(trim(str_replace('SerialNumber', '', $serial)));
        // Dashboard
        $rolename = '';
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();
        $now = Carbon::now(); // Keep it as a Carbon instance
        $filter = [];
        $return = [];
        $label = [];
        $sudahBayar = [];
        $belumBayar = [];

        // Loop to get last 5 months including the current one
        for ($i = 4; $i >= 0; $i--) { // Reverse order for correct sorting
            $date = $now->copy()->subMonths($i);
            $filter[$i] = $date->format('Y-m');
            array_push($label, $date->format('F Y'));

            // Example values (replace with real data)
            $sudahBayar[] = CustomerBilling::where('billing_date',$date->format('Y-m'))->whereNotNull('pay_date')->count();
            $belumBayar[] = CustomerBilling::where('billing_date',$date->format('Y-m'))->whereNull('pay_date')->count();;  // Replace with actual values
        }

        $return['labels'] = $label;
        $return['datasets'] = [
            [
                'label' => 'Sudah Bayar',
                'backgroundColor' => "rgba(54, 162, 235, 0.5)",
                'borderColor' => "rgba(54, 162, 235, 1)",
                'borderWidth' => 1,
                'data' => $sudahBayar
            ],
            [
                'label' => 'Belum Bayar',
                'backgroundColor' => "rgba(255, 99, 132, 0.5)",
                'borderColor' => "rgba(255, 99, 132, 1)",
                'borderWidth' => 1,
                'data' => $belumBayar
            ]
        ];

        // $rolenames = $user->getRoleNames();
        // if(count($rolenames)){
        //     $rolename = $rolenames[0];
        // }
        return view('pages.dashboard',[
            'role'      => $rolename,
            'filters'   => $filter,
            'chart'     => $return
        ]);
    }

    public function report(Request $request)
    {
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

        return view('pages.report.index',[
            'filters'   => $month_arr,
        ]);
    }

    public function get_report($date) {
        $get = CustomerGroup::with(['customers.package', 'customers.billing' => function ($query) use ($date) {
            $query->where('billing_date', $date);
        }])->get();

        $data = [];

        foreach ($get as $d) {
            $filteredCustomers = $d['customers']->map(function ($customer) {
                if (count($customer['billing']) > 0) {
                    $customerData = [
                        'name' => $customer->name,
                        'address' => $customer->address,
                        'paket' => $customer['package']['billing_name'],
                        'billing_number' => $customer['billing'][0]['billing_number'],
                        'tanggal_billing' => $customer['billing'][0]['billing_date'],
                        'tanggal_bayar' => $customer['billing'][0]['pay_date'] ? $customer['billing'][0]['pay_date'] : '-',
                        'jumlah' => $customer['billing'][0]['price'],
                        'diskon' => $customer['billing'][0]['discount'],
                        'total' => $customer['billing'][0]['total'],
                    ];

                    return [
                        'customer' => $customerData,
                        'status' => $customer['billing'][0]['pay_date'] ? 'sudah_bayar' : 'belum_bayar',
                    ];
                }
                return null;
            })->filter()->values(); // Reset array keys

            if ($filteredCustomers->isNotEmpty()) {
                $sudahBayar = $filteredCustomers->where('status', 'sudah_bayar')->pluck('customer')->toArray();
                $belumBayar = $filteredCustomers->where('status', 'belum_bayar')->pluck('customer')->toArray();

                $totalPaid = collect($sudahBayar)->sum('total');
                $totalNotPaid = collect($belumBayar)->sum('total');
                $totalAmount = collect($sudahBayar)->sum('total') + collect($belumBayar)->sum('total');

                $data[$d->group_name] = [
                    'sudah_bayar' => $sudahBayar,
                    'belum_bayar' => $belumBayar,
                    'total_dibayar'=> $totalPaid,
                    'total_belum_bayar'=> $totalNotPaid,
                    'total_group' => $totalAmount, // Sum of all `total` values in the group
                ];
            }
        }

        return response()->json([
            'status'    => 200,
            'message'   => 'Fetch data '.$date.' success',
            'data'      => $data
        ]);
    }

    public function get_stand_usage($year) {
        $months_num = 12;
        $data = array();
        for($i=0; $i<$months_num; $i++) {
            if($i<9) {
                $current = '0'.$i+1;
            } else {
                $current = $i;
            }
            $cur_data = CustomerBilling::where('billing_date', $year.'-'.$current)->get();
            $data[$i] = $cur_data->sum('usage');
        }

        dd($data);
    }
}
