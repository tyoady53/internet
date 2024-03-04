@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pembayaran '])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form>
                    <div class="input-group mb-3">
                        {{-- <a href="/public/customer/create" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</a> --}}
                        {{-- <input type="text" class="form-control input-group-text mb-3" placeholder="search by user name . . .">

                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button> --}}
                    </div>
                </form>
                <h5></h5>
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"> Nama </th>
                            <th scope="col" class="text-center"> Tanggal Billing </th>
                            <th scope="col" class="text-center"> Terlambat </th>
                            <th scope="col" class="text-center"> Denda </th>
                            <th scope="col" class="text-center"> Status </th>
                            <th scope="col" class="text-center"> Pemakaian Sebelumnya </th>
                            <th scope="col" class="text-center"> Hasil Water Meter </th>
                            <th scope="col" class="text-center"> Pemakaian </th>
                            <th scope="col" class="text-center"> Total </th>
                            <th scope="col" class="text-center"> Aksi </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $u)
                        {{-- {{ $u }} --}}
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>
                                @foreach ($u->billings as $billing)
                                    {{ $billing->billing_date }}<br>
                                @endforeach
                            </td>
                            <td>
                                @foreach ($u->billings as $billing)
                                    {{ $billing->late }} Bulan<br>
                                @endforeach
                            </td>
                            <td class="text-end">
                                @foreach ($u->billings as $billing)
                                    {{ number_format($billing->late*$setup->fine_fee) }}<br>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @if($u->pay_date == null)
                                    Belum Dibayar
                                @else
                                    Terbayar
                                @endif
                            </td>
                            <td class="text-center">
                                @foreach ($u->billings as $billing)
                                    {{ $billing->water_meter_count }} m<sup>3</sup> <br>
                                @endforeach

                            </td>
                            <td class="text-center">
                                @foreach ($u->billings as $billing)
                                    {{ $billing->usage }} m<sup>3</sup><br>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @foreach ($u->billings as $billing)
                                    {{ $billing->usage - (int)$billing->water_meter_count }} m<sup>3</sup> <br>
                                @endforeach
                            </td>
                            <td class="text-end">
                                @foreach ($u->billings as $billing)
                                    {{ number_format(($billing->price_total) + ($billing->late*$setup->fine_fee)) }}<br>
                                @endforeach
                            </td>
                            <td class="text-center">
                                @if($u->pay_date == null)
                                    {{-- <a href="{{ 'print/'.$data->encrypted_id.'/'.$u->billing_date }}" onclick="window.open(this.href, 'new', 'popup'); return false;" class="btn btn-primary btn-sm me-2"><i class="fa fa-print me-1"></i> Cetak</a> --}}
                                    {{-- <a onclick="open_in_new_tab_and_reload('./payment/'.$data->encrypted_id.'/'.$u->billing_date)" href="#" class="btn btn-success btn-sm me-2"><i class="fa fa-money me-1"></i> Bayar</a> --}}
                                    <a href="{{ 'payment/'.$u->encrypted_id }}" onclick="window.open(this.href, 'new', 'popup'); return false;" class="btn btn-success btn-sm me-2"><i class="fa fa-money me-1"></i> Bayar</a>
                                @else
                                    <span class="badge bg-success shadow border-0 ms-2 mb-2">
                                        Lunas
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <div id="alert">
        @include('components.alert')
    </div>
    <div class="container-fluid py-4" id="question">
        <div class="row">

        </div>
        @include('layouts.footers.auth.footer')
    </div>

    <style>
        .fixed {
            position: fixed;
            top: 0;
            right: 0;
            left: 17rem;
            margin-top: 15px;
            margin-right: 1.5rem;
            z-index: 99;
        }

        .additionalDiv {
            margin-top: 22.5rem;
        }

        @media(max-width: 1199px){
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 22rem;
            }
        }

        @media(max-width: 910px){
            .card.card-profile-bottom{
                margin-top: 15rem;
            }
            .py-4{
                padding-top: 1rem !important;
            }
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 22rem;
            }
        }

        @media(max-width: 501px){
            .card.card-profile-bottom{
                margin-top: 12rem;
            }
            .py-4{
                padding-top: 1rem !important;
            }
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 20rem;
            }
        }

        @media(max-width: 464px){
            .card.card-profile-bottom{
                margin-top: 12rem;
            }
            .py-4{
                padding-top: 0.55rem !important;
            }
            .fixed {
                position: fixed;
                top: 0;
                right: 0;
                left: 0;
                margin-top: 15px;
                z-index: 99;
            }

            .additionalDiv {
                margin-top: 20rem;
            }
        }
    </style>
    <script>
        $(document).ready(function($) {
            new DataTable('#example', {
                order: [0, 'desc']
            });
        });

        function reload(){
            window.location.reload;
        }

        function open_in_new_tab_and_reload(url){
            console.log(url);
            //Open in new tab
            window.open(url, '_blank');
            //focus to thet window
            window.focus();
            //reload current page
            location.reload();
        }
    </script>

@endsection
