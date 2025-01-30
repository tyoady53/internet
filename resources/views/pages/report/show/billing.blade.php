@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan Billing'])
    <div class="card mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div>
                    <div class="input-group mb-3">
                        <select class="form-control input-group-text mb-3" name="periode" id="periode">
                        @foreach ($filters as $filter)
                            <option value="{{ $filter->key }}" {{ $last_month == $filter->key ? 'selected' : '' }}>{{ $filter->value }}</option>
                        @endforeach
                        </select>
                        <button class="btn btn-primary input-group-text" type="submit" onclick="search_data()"> <i class="fa fa-search me-2"></i> Filter</button>
                    </div>
                </div>

                <table class="table table-striped table-bordered table-hover" id="example">
                    {{-- <thead>
                        <tr>
                            <th scope="col" class="text-center"> Nama </th>
                            <th scope="col" class="text-center"> No. Rumah </th>
                            <th scope="col" class="text-center"> Water Meter </th>
                            <th scope="col" class="text-center"> Tanggal Billing Terakhir </th>
                            <th scope="col" class="text-center"> Pemakaian Terakhir </th>
                            <th scope="col" class="text-center"> Tanggal Bayar </th>
                            <th scope="col" class="text-center"> No. Billing </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($paid as $u)
                        <tr>
                            <td>{{ $u->customer->name }}</td>
                            <td class="text-center">{{ $u->customer->house_no }}</td>
                            <td class="text-center">{{ $u->customer->water_meter_no }}</td>
                            <td class="text-center">
                                @if($u->billing_date)
                                    {{ $u->billing_date }}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if($u->usage)
                                    {{ $u->usage }} m<sup>3</sup>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($u->pay_date)->format('d M Y') }}</td>
                            <td class="text-center">{{ $u->billing_number }}</td>
                        </tr>
                        @endforeach
                    </tbody> --}}
                </table>
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
    <script>
        $(document).ready(function() {
            search_data();
        });

        function search_data(){
            var periode = document.getElementById("periode").value;
            console.log(periode);
        };
    </script>
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
@endsection
