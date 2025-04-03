<?php

namespace App\Exports\PDF;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;

class areaReport implements FromView
{
    protected $data;

    function __construct($data) {
            $this->data = $data;
    }

    public function view(): View
    {
        return view('export.PDF.areaReport', [
            'datas' => $this->data
        ]);
    }
}
