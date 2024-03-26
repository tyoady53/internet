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
                    size: A5 landscape;
                    margin: 0;
                }

                body {
                    margin: 0;
                }
            }
        </style>
        {{-- <style>@page { size: A5 landscape;margin: 0;
        }</style> --}}
    </head>
    <body class="A5 landscape">
        <div class="row ms-2 mt-1">
            <div class="col-2 mt-1">
                <img src="{{ asset('img/logo-bk.png') }}" style="height: 60px;">
            </div>
            <div class="col-10">
                <strong>PERUSAHAAN AIR MINUM<br>TIRTA KOTA ALAM CAGAK LESTARI</strong><br>Jl. Raya Ciseuti Ds.Jalancagak Kec.Jalancagak
            </div>
        </div>
        <br>
        <div class="text-center align-middle">
            <h6>BUKTI PEMBAYARAN</h6>
        </div>
        <div class="row ms-2 me-2">
            <div class="col-8">
                <div class="row">
                    <div class="col-4">
                        Nama
                    </div>
                    <div class="col-8">
                        {{ $data->customer->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        Alamat
                    </div>
                    <div class="col-8">
                        {{ $data->customer->house_no }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        ID Pelanggan
                    </div>
                    <div class="col-8">
                        {{ $data->customer->id }}
                    </div>
                </div>
            </div>
            <div class="col-4">

            </div>
        </div>
        <div class="ms-2 me-2">
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
                    <td class="text-end bottom"><strong>{{ number_format($totalSum) }}</strong></td>
                </tr>
            </table>
        </div>
        <div class="row ms-2 me-2">
            <div class="col-6">
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
                PT.ROSADI ABADI JAYA
            </div>
            <div class="col-6 text-center">
                <br>
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
