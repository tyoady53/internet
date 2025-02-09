<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\CustomerGroup;
use App\Models\MasterBilling;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomerImport implements ToModel
{

    protected $area;
    protected $package;

    public function __construct()
    {
        $this->area = CustomerGroup::get()->toArray();
        $this->package = MasterBilling::get()->toArray();
    }
    // $area = CustomerGroup::get()->toArray();

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if($row[0] && $row[2]) {
            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['2'])->format('Y-m-d');
            $current_area = '-';
            $current_package = '-';
            foreach($this->area as $area_) {
                if(strtoupper($area_['group_name']) == strtoupper($row[5])){
                    $current_area = $area_['id'];
                }
            }
            foreach($this->package as $package_) {
                if($package_['package'] == $row[3]){
                    $current_package = $package_['id'];
                }
            }

            $exist = Customer::where('name',$row[0])->where('join_date', $date)->where('group_id', $current_area)->first();
            // dd($exist,$row[0],$current_area);
            if(!$exist) {
                return new Customer([
                    'name' => $row[0],
                    'address' => ($row[1] ? $row[1] : '-'),
                    'join_date' => ($row[2] ? $date : '0000-00-00'),
                    'group_id' => $current_area,
                    'discount' => ($row[4] ? $row[4] : 0),
                    'billing_id' => $current_package,
                    'quantity' => 1,
                    'is_active' => 1,
                    'encrypted_id' => md5($row[0].Carbon::now()),
                ]);
            }
        }
        }
}
