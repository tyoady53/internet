@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing '.$data->name])
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
                        @foreach ($data->billings as $u)
                        {{-- {{ $u }} --}}
                        <tr>
                            <td>{{ $u->billing_date }}</td>
                            <td>{{ $u->late }} Bulan</td>
                            <td class="text-end">{{ number_format($u->late*$setup->fine_fee) }}</td>
                            <td class="text-center">
                                @if($u->pay_date == null)
                                    Belum Dibayar
                                @else
                                    Terbayar
                                @endif
                            </td>
                            <td class="text-center">{{ $u->water_meter_count }} m3</td>
                            <td class="text-center">{{ $u->usage }} m3</td>
                            <td class="text-center">{{ $u->usage - $u->water_meter_count }} m3</td>
                            <td class="text-end">{{ number_format(($u->price_total) + ($u->late*$setup->fine_fee)) }}</td>
                            <td class="text-center">
                                @if($u->pay_date == null)
                                    <a href="{{ 'print/'.$data->encrypted_id.'/'.$u->billing_date }}" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> Cetak</a>
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
        })
    </script>

@endsection
