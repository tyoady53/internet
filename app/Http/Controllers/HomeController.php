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
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Facades\Storage;

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
            $serial = shell_exec("lsblk -d -o SERIAL | sed -n '2p'");
        } else {
            $serial = trim(shell_exec("wmic diskdrive get SerialNumber | findstr /V SerialNumber"));
        }

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
            'message'   => 'Laporan pembayaran '.$date,
            'data'      => $data
        ]);
    }

    // composer require barryvdh/laravel-dompdf
    public function export_report($date) {
        // Format the $date to 'M Y' format, like 'Jan 2025'
        $formattedDate = Carbon::parse($date)->format('M Y');

        $get = CustomerGroup::with(['customers.package', 'customers.billing' => function ($query) use ($date) {
            $query->where('billing_date', $date);
        }])->get();

        $areaData = [];
        $rekapData = [];

        foreach ($get as $d) {

            // Filter customer berdasarkan status pembayaran
            $filteredCustomers = $d['customers']->map(function ($customer) {
                if (count($customer['billing']) > 0) {
                    return [
                        'name' => $customer->name,
                        'address' => $customer->address,
                        'paket' => $customer['package']['billing_name'],
                        'billing_number' => $customer['billing'][0]['billing_number'],
                        'tanggal_billing' => $customer['billing'][0]['billing_date'],
                        'tanggal_bayar' => $customer['billing'][0]['pay_date'] ?? '-',
                        'total' => $customer['billing'][0]['total'],
                    ];
                }
                return null;
            })->filter()->values();

            // Jika ada data customer
            if ($filteredCustomers->isNotEmpty()) {
                $sudahBayar = $filteredCustomers->where('tanggal_bayar', '!=', '-')->pluck('total')->sum();
                $belumBayar = $filteredCustomers->where('tanggal_bayar', '-')->pluck('total')->sum();
                $totalAmount = $sudahBayar + $belumBayar;

                // Menambahkan data untuk laporan per area
                $areaData[$d->group_name] = [
                    'sudah_bayar' => $filteredCustomers->where('tanggal_bayar', '!=', '-')->toArray(),
                    'belum_bayar' => $filteredCustomers->where('tanggal_bayar', '-')->toArray(),
                ];

                // Menambahkan data untuk rekap
                $rekapData[] = [
                    'group_name' => $d->group_name,
                    'sudah_bayar' => $sudahBayar,
                    'belum_bayar' => $belumBayar,
                    'jumlah' => $totalAmount,
                ];
            }
        }

        // Buat PDF per area dan simpan sebagai file terpisah
        foreach ($areaData as $area => $data) {
            // Add $formattedDate in the file name for each area
            $fileName = strtoupper($area) . " ({$formattedDate}).pdf";

            // Generate PDF untuk setiap area, pass $formattedDate to the view for title
            $pdfArea = FacadePdf::loadView('Export.PDF.areaReport', [
                'areaData' => [$area => $data],
                'date' => $formattedDate, // Pass the formatted $date to the view
            ])->setPaper('a4');

            // Simpan ke storage
            Storage::put("public/reports/{$date}/" . $fileName, $pdfArea->output());
        }

        // Buat PDF untuk laporan rekap keseluruhan
        $rekapFileName = "_Rekap ({$formattedDate}).pdf";

        // Generate PDF untuk rekap keseluruhan, pass $formattedDate to the view for title
        $pdfRekap = FacadePdf::loadView('Export.PDF.rekapReport', [
            'rekapData' => $rekapData,
            'date' => $formattedDate, // Pass the formatted $date to the view
        ])->setPaper('a4');

        // Simpan ke storage
        Storage::put("public/reports/{$date}/" . $rekapFileName, $pdfRekap->output());

        return response()->json([
            'status' => 200,
            'message' => 'Laporan berhasil dibuat',
            // 'laporan_area' => asset('storage/reports/' . $fileName),
            // 'laporan_rekap' => asset('storage/reports/' . $rekapFileName)
        ]);
    }

    public function lists() {
        // Define the base directory
        $dir = storage_path('app/public/reports');

        // Get all subdirectories
        $directories = glob($dir . '/*', GLOB_ONLYDIR);

        usort($directories, function ($a, $b) {
            return strcmp(basename($b), basename($a)); // Compare directory names in descending order
        });

        $data = [];

        // Loop through each directory and get files inside
        foreach ($directories as $directory) {
            $directoryName = basename($directory);  // Get the directory name

            // Get all files inside the directory
            $files = glob($directory . '/*'); // You can modify this pattern to match specific file types

            // Prepare an array to hold file details for the current directory
            $fileDetails = [];

            // Loop through files and gather details
            foreach ($files as $filePath) {
                $file_name = basename($filePath);
                $fileDetails[] = [
                    'file_name'   => $file_name,
                    'file_size'   => filesize($filePath),
                    'file_created' => date("Y-m-d H:i:s", filectime($filePath)),
                ];
            }

            // If there are files in the directory, add them to the data array
            if (count($fileDetails) > 0) {
                $data[$directoryName] = $fileDetails;
            }
        }

        // return response()->json($data);
        // Return the data in a structured format (you can also return as JSON if needed)
        return view('pages.report.show',[
            'datas'   => $data,
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
