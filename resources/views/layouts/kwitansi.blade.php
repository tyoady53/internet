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
    </head>
    <body>
        <div class=row>
            <div class="col-4">
                <div>
                    <h6>PERUSAHAAN AIR MINUM<br>TIRTA KOTA ALAM CAGAK LESTARI</h6>
                </div>
            </div>
            <div class="col-4">
                <div class="text-center pt-1">
                    <h6>KWITANSI</h6>
                </div>
            </div>
            <div class="col-4"></div>
        </div>
        <div class="mx-3">
            <table style="width: 100%">
                <tr>
                    <td>
                        BULAN
                    </td>
                    <td colspan="3">
                        : {{ $billing_date }}
                    </td>
                </tr>
                <tr>
                    <td>
                        NO. PELANGGAN
                    </td>
                    <td colspan="3">
                        : {{ $data->customer_number }}
                    </td>
                </tr>
                <tr>
                    <td>
                        NAMA
                    </td>
                    <td colspan="3">
                        : {{ $data->name }}
                    </td>
                </tr>
                <tr>
                    <td>
                        ALAMAT
                    </td>
                    <td colspan="3">
                        : {{ $data->house_no }}
                    </td>
                </tr>
                <tr><td colspan="4"><div class="text-center">STAND METER (M3)</div></td></tr>
                <tr>
                    <td>
                        PEMAKAIAN BULAN INI
                    </td>
                    <td>
                        : {{ $data->billings[0]->usage }} m<sup>3</sup>
                    </td>
                    <td rowspan="2" style="width: 20%">
                        PEMAKAIAN YANG DI TAGIHKAN
                    </td>
                    <td rowspan="2">
                        : {{ $data->billings[0]->usage - (int)$data->billings[0]->water_meter_count }} m<sup>3</sup>
                    </td>
                </tr>
                <tr>
                    <td>
                        PEMAKAIAN BULAN LALU
                    </td>
                    <td colspan="3">
                        : {{ $data->billings[0]->water_meter_count }} m<sup>3</sup>
                    </td>
                </tr>
                <tr>
                    <td>
                        BIAYA PEMAKAIAN
                    </td>
                    <td colspan="3">
                        : Rp. {{ number_format($data->billings[0]->price_total) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        ADMINISTRASI
                    </td>
                    <td colspan="3">
                        : Rp. {{ number_format($data->billings[0]->administration_fees) }}
                    </td>
                </tr>
                {{-- <tr>
                    <td>
                        RETRIBUSI
                    </td>
                    <td colspan="3">
                        : 0
                    </td>
                </tr> --}}
                <tr>
                    <td>
                        DENDA
                    </td>
                    <td colspan="3">
                        : Rp. {{ number_format($data->billings[0]->fines) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        JUMLAH TAGIHAN
                    </td>
                    <td colspan="3">
                        : Rp. {{ number_format($data->billings[0]->price_total + $data->billings[0]->administration_fees + $data->billings[0]->fines) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        STATUS PEMBAYARAN
                    </td>
                    <td>
                        : {{ ($data->billings[0]->pay_date) ? "LUNAS" : "Belum Bayar" }}
                    </td>
                    <td>
                        JAM CETAK:
                    </td>
                    <td>
                        : {{ now()->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        Bayarlah Semua Tagihan Anda TEPAT WAKTU.
                    </td>
                    <td>
                        REFF:
                    </td>
                    <td>
                        : {{ $data->billings[0]->billing_number }}
                    </td>
                </tr>
            </table>
            <hr>
            <div class="row">
                <div class="text-center col-6">
                    Tanda Tangan Pelanggan
                </div>
                <div class="text-center col-6">
                    Tanda Tangan Petugas
                </div>
            </div>
        </div>
    </body>
    <script>
        $(document).ready(function($) {
            window.print();
        })
    </script>
</html>
