<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
    <title>
    TIRTA KOTA ALAM CAGAK LESTARI
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/dist/perfect-scrollbar.min.js "></script>
    <link href=" https://cdn.jsdelivr.net/npm/perfect-scrollbar@1.5.5/css/perfect-scrollbar.min.css " rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
   <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>PRINT</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            @media print {
                @page {
                    margin: 0;
                }

           body {
                    margin: 0;
                }
            }
        </style>
        {{-- <style>@page { size: A5 landscape;margin: 0px;
        }</style> --}}
    </head>
    <body class="p-4 mt-2">
        <div>
            <div class="row ms-2">
                <div class="col-2 pt-3">
                    <img src="{{ asset('img/logo-bk.png') }}" style="height: 60px;">
                </div>
                <div class="col-10">
                    <strong>PERUSAHAAN AIR MINUM<br>TIRTA KOTA ALAM CAGAK LESTARI</strong><br>Jl. Raya Ciseuti Ds.Jalancagak Kec.Jalancagak
                </div>
            </div>
        </div>

        <hr>
        <div class="text-center align-middle">
            <strong>BUKTI PEMBAYARAN</strong>
        </div>
        <div class="row ms-2 me-2">
            <div class="col-8">
                <div class="row">
                    <div class="col-2">
                        Nama
                    </div>
                    <div class="col-10">
                        {{ $data->customer->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-4">
                                Alamat
                            </div>
                            <div class="col-8">
                                {{ $data->customer->house_no }}
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-8">
                                ID Pelanggan
                            </div>
                            <div class="col-4">
                                {{ $data->customer->billing_number ? $data->customer->billing_number : '-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ms-2 me-2 mt-2">
            <table class="table table-bordered table-bordered-last">
                <tr>
                    <th rowspan="2" class="text-center align-middle">
                        BULAN/TAHUN
                    </th>
                    <th colspan="2" class="text-center align-middle">
                        ANGKA WM
                    </th>
                    <th rowspan="2" class="text-center align-middle">
                        Volume M<sup>3</sup>
                    </th>
                    <th rowspan="2" class="text-center align-middle">
                       UANG AIR
                    </th>
                    <th rowspan="2" class="text-center align-middle">
                        BIAYA ADM
                    </th>
                    <th rowspan="2" class="text-center align-middle">
                        DENDA
                    </th>
                    <th rowspan="2" class="text-center align-middle">
                        JUMLAH
                    </th>
                </tr>
                <tr>
                    <th class="text-center align-middle">
                        AWAL
                    </th>
                    <th class="text-center align-middle">
                        AKHIR
                    </th>
                </tr>
                <tr>
                    <td>
                        @foreach ($data->detail as $billing)
                            {{ $billing->billing->billing_date }}<br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($data->detail as $billing)
                            {{ $billing->billing->water_meter_count }}<br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($data->detail as $billing)
                            {{ $billing->billing->usage }}<br>
                        @endforeach
                    </td>
                    <td class="text-center">
                        @foreach ($data->detail as $billing)
                            {{ $billing->billing->usage - (int)$billing->billing->water_meter_count }}<br>
                        @endforeach
                    </td>
                    <td class="text-end">
                        @foreach ($data->detail as $billing)
                            {{ number_format($billing->price) }}<br>
                        @endforeach
                    </td>
                    <td class="text-end">
                        @foreach ($data->detail as $billing)
                            {{ number_format($billing->administration_fee) }}<br>
                        @endforeach
                    </td>
                    <td class="text-end">
                        @foreach ($data->detail as $billing)
                            {{ number_format($billing->fines) }}<br>
                        @endforeach
                    </td>
                    <td class="text-end">
                        @foreach ($data->detail as $billing)
                            {{ number_format($billing->total) }}<br>
                        @endforeach
                    </td>
                </tr>
                <?php
                // Initialize the sum variable
                $totalSum = 0;

                // Iterate over each object in the $data array
                foreach ($data->detail as $item) {
                    // Assuming each object has a property detail->total
                    // Add the total value to the sum
                    $totalSum += $item->total;
                }
                ?>
                <tr class="bottom" style="border-bottom: 3pt solid black;">
                    <td colspan="7" class="text-center bottom"><strong>Jumlah</strong></td>
                    <td class="text-end bottom"><strong>{{ number_format($data->total) }}</strong></td>
                </tr>
                @if(count($data->pays) > 0)
                {{-- <tr class="bottom" style="border-bottom: 3pt solid black;" rowspan="{{ count($data->pays) }}">
                    <td colspan="3" class="text-center bottom"><strong>Pembayaran</strong></td>
                </tr> --}}
                @foreach ($data->pays as $payment)
                    <tr class="bottom" style="border-bottom: 3pt solid black;">
                        <td colspan="7" class="text-center bottom"><strong>{{ date_format($payment->created_at,"d-m-Y") }}</strong></td>
                        <td class="text-end">{{ number_format($payment->payment_amount) }}</td>
                    </tr>
                @endforeach
                @endif
                <tr class="bottom" style="border-bottom: 3pt solid black;">
                    <td colspan="7" class="text-center bottom"><strong>Sisa</strong></td>
                    <td class="text-end bottom"><strong>{{ number_format($data->total - $data->paid) }}</strong></td>
                </tr>
            </table>
        </div>
        <div class="row ms-2 me-2">
            <div class="col-4" style="font-size:10px;">
                <ul>
                    <li>
                        Membayar Rekening Air Tepat waktu
                    </li>
                    <li>
                        Hematlah pemakaian air seperlunya
                    </li>
                    <li>
                        Batas pembayaran sampai Tgl 20
                    </li>
                </ul>

                <div>
                    PT.ROSADI ABADI JAYA<br>
                    Tanggal Cetak : {{ Carbon\Carbon::now()->format('d-M-Y H:i') }}
                </div>
            </div>
            <div class="col-4">
                @if ($data->total - $data->paid == 0)
                <div style="max-height:75px;">
                    <svg version="1.0" xmlns="http://www.w3.org/2000/svg"
                        width="153.000000pt" height="75.000000pt" viewBox="0 0 153.000000 75.000000"
                        preserveAspectRatio="xMidYMid meet">

                        <g transform="translate(0.000000,75.000000) scale(0.100000,-0.100000)"
                        fill="#000000" stroke="none">
                        <path d="M1307 733 c-13 -12 -7 -23 12 -23 54 0 69 -25 97 -152 11 -55 23 -88
                        31 -88 7 0 13 3 13 6 0 8 -20 83 -28 104 -3 8 -4 19 -3 24 1 4 -3 14 -10 22
                        -6 7 -8 17 -5 22 3 5 -3 17 -14 27 -11 10 -17 22 -14 27 3 4 -10 15 -30 23
                        -41 17 -40 17 -49 8z"/>
                        <path d="M1138 698 c-81 -20 -115 -38 -69 -38 39 0 201 42 195 51 -7 12 -26
                        11 -126 -13z"/>
                        <path d="M1315 683 c11 -3 26 -10 33 -15 8 -7 12 -7 12 0 0 12 -25 22 -48 21
                        -13 -1 -12 -3 3 -6z"/>
                        <path d="M1258 673 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M1218 663 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M949 655 c-2 -1 -105 -26 -229 -54 -643 -145 -632 -142 -617 -157 3
                        -3 36 1 74 10 37 9 199 46 358 81 160 36 292 70 293 75 2 6 8 7 14 4 10 -6
                        181 26 174 33 -5 6 -63 13 -67 8z"/>
                        <path d="M1178 653 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1128 643 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1038 623 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M998 613 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M958 603 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1165 598 c-28 -16 -35 -28 -35 -64 0 -35 16 -52 78 -83 43 -22 54
                        -47 26 -58 -10 -4 -20 0 -26 10 -13 23 -48 22 -48 -1 0 -28 32 -52 68 -52 39
                        0 73 39 66 77 -7 38 -10 41 -63 68 -27 13 -51 31 -55 40 -8 22 24 32 39 12 7
                        -10 20 -14 33 -10 27 7 27 15 5 41 -23 25 -62 34 -88 20z"/>
                        <path d="M908 593 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M868 583 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M818 573 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M778 563 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M738 553 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M963 553 c-22 -4 -23 -8 -23 -134 0 -129 0 -130 23 -127 14 2 23 11
                        25 24 5 35 62 42 62 8 0 -15 18 -18 38 -6 9 6 6 23 -15 70 -15 34 -33 62 -40
                        62 -7 0 -10 6 -7 14 4 12 -31 99 -39 95 -1 -1 -12 -4 -24 -6z m42 -119 c19
                        -45 19 -54 1 -54 -17 0 -26 22 -26 61 0 38 7 37 25 -7z"/>
                        <path d="M688 543 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M518 503 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M764 478 c4 -18 10 -49 12 -68 5 -34 4 -33 -32 23 -37 57 -68 74 -80
                        42 -3 -8 6 -66 20 -128 26 -109 28 -114 50 -110 24 5 24 5 10 65 -8 34 -13 63
                        -10 65 2 2 19 -21 37 -51 25 -40 40 -56 56 -56 12 0 24 4 27 8 2 4 -7 60 -22
                        125 -24 110 -27 117 -50 117 -22 0 -24 -3 -18 -32z"/>
                        <path d="M468 493 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M428 483 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M388 473 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M338 463 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M298 453 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M533 452 c-10 -6 -8 -27 8 -92 22 -93 22 -125 -1 -125 -14 0 -59 135
                        -60 183 0 23 -7 26 -33 16 -17 -6 -16 -14 9 -132 17 -78 31 -98 71 -108 31 -8
                        77 23 81 55 5 34 -38 211 -51 211 -7 0 -18 -4 -24 -8z"/>
                        <path d="M258 443 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M64 414 c-15 -22 -16 -30 -5 -61 7 -19 15 -56 17 -82 7 -92 41 -204
                        69 -228 27 -24 55 -30 55 -13 0 6 -11 15 -23 19 -27 10 -39 37 -62 131 -33
                        139 -40 201 -26 228 17 32 -5 37 -25 6z"/>
                        <path d="M208 433 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M168 423 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1450 390 c0 -45 -23 -75 -65 -86 -33 -8 -23 -23 12 -16 55 9 94 71
                        78 122 -11 34 -25 22 -25 -20z"/>
                        <path d="M115 410 c-3 -6 1 -7 9 -4 18 7 21 14 7 14 -6 0 -13 -4 -16 -10z"/>
                        <path d="M102 360 c0 -19 2 -27 5 -17 2 9 2 25 0 35 -3 9 -5 1 -5 -18z"/>
                        <path d="M227 383 c-3 -5 7 -61 21 -125 30 -131 26 -127 108 -107 33 9 44 16
                        44 31 0 17 -5 18 -43 13 l-43 -7 -18 84 c-10 45 -22 91 -27 101 -10 17 -34 23
                        -42 10z"/>
                        <path d="M1396 344 c-11 -8 -16 -14 -10 -14 13 0 39 18 34 24 -3 2 -14 -2 -24
                        -10z"/>
                        <path d="M111 304 c0 -11 3 -14 6 -6 3 7 2 16 -1 19 -3 4 -6 -2 -5 -13z"/>
                        <path d="M1258 303 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1218 293 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1280 278 c-14 -5 -34 -11 -45 -13 -130 -22 -165 -30 -165 -37 0 -5
                        -10 -6 -21 -3 -15 5 -19 4 -15 -4 4 -6 15 -11 24 -11 30 0 257 54 260 62 2 5
                        9 5 15 1 7 -3 8 -2 4 2 -11 13 -29 14 -57 3z"/>
                        <path d="M1128 273 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1078 263 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M1038 253 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M988 243 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M948 233 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M131 214 c0 -11 3 -14 6 -6 3 7 2 16 -1 19 -3 4 -6 -2 -5 -13z"/>
                        <path d="M908 223 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M858 213 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M935 204 c-27 -8 -62 -16 -76 -19 -14 -2 -64 -13 -111 -24 -47 -12
                        -93 -21 -101 -21 -8 0 -17 -5 -19 -11 -2 -6 -26 -13 -53 -14 -71 -4 -140 -24
                        -127 -37 7 -7 25 -6 59 5 26 9 73 20 103 26 106 19 155 31 158 40 2 5 11 7 21
                        4 25 -6 203 36 221 53 12 12 12 14 -5 13 -11 0 -42 -7 -70 -15z"/>
                        <path d="M818 203 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M768 193 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M728 183 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M688 173 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M598 153 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M152 130 c0 -14 2 -19 5 -12 2 6 2 18 0 25 -3 6 -5 1 -5 -13z"/>
                        <path d="M548 143 c6 -2 18 -2 25 0 6 3 1 5 -13 5 -14 0 -19 -2 -12 -5z"/>
                        <path d="M508 133 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M468 123 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M418 113 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M378 103 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M288 83 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M248 73 c7 -3 16 -2 19 1 4 3 -2 6 -13 5 -11 0 -14 -3 -6 -6z"/>
                        <path d="M293 58 c-46 -12 -83 -25 -83 -30 0 -5 12 -7 28 -4 128 24 191 40
                        186 47 -8 13 -40 10 -131 -13z"/>
                        </g>
                    </svg>
                </div>
                @else
               <br><br><br>
                @endif
            </div>
            <div class="col-4 text-center">
                Bendahara/Kasir
                <br><br><br>
                {{ $setup->cashier_name }}
            </div>
        </div>
    </body>
    <style>
        .table-bordered tbody tr {
            border: 3px solid black;
        }

        .bottom {
            border: 3px solid black;
        }

        /* tr {
            border-bottom: 3pt solid black;
        } */

        /* .table-bordered tbody tr td {
            border: 3px solid black;
        } */

        .table-bordered thead tr {
            border: 3px solid black;
        }

        .table-bordered thead tr th {
            border: 3px solid black;
        }
    </style>
    <script>
        $(document).ready(function($) {
            window.print();
        })
    </script>
    <style>
        /* Define border for last row */
        .table-bordered-last tbody tr:last-child {
            border-bottom: 1px solid #dee2e6;
        }
    </style>
</html>
