@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form>
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <form role="form" method="get" action="{{ route('report.index') }}">
                                <button class="btn btn-primary input-group-text" type="button" id="fetch"> Fetch <i class="fa fa-recycle ms-2"></i></button>
                                <select class="form-control input-group-text mb-3" name="periode">
                                @foreach ($filters as $filter)
                                    <option value="{{ $filter->key }}" {{ request('periode') == $filter->key ? 'selected' : '' }}>{{ $filter->value }}</option>
                                @endforeach
                                </select>
                                <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center" style="width:5%"> No </th>
                            <th scope="col" class="text-center"> Nama </th>
                            <th scope="col" class="text-center"> Alamat </th>
                            <th scope="col" class="text-center"> Paket </th>
                            <th scope="col" class="text-center"> Status Pembayaran </th>
                            <th scope="col" class="text-center"> Tanggal Dibayar </th>
                            <th scope="col" style="width:10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($user as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->address }}</td>
                            <td>{{ $u->house_no }}</td>
                            <td>{{ $u->water_meter_no }}</td>
                            <td class="text-center">
                                @if($u->status == '1')
                                    Aktif
                                @else
                                    Tidak Aktif
                                @endif
                            </td>
                            <td>
                                @if(count($u->billings))
                                    {{ $u->billings[0]->billing_date }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if(count($u->billings))
                                    {{ $u->billings[0]->usage }} m<sup>3</sup>
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ './create/'.$u->encrypted_id }}" class="btn btn-primary btn-sm me-2"><i class="fa fa-plus-circle me-2"></i> Buat Billing</a>\
                            </td>
                        </tr>
                        @endforeach --}}
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
                pageLength: 100,
                // order: [[4, 'asc'],[2, 'asc']]
            });

            $("#fetch").click(function(){
                var periode = document.getElementsByName('periode');
                alert("Akan Fetching data billing "+periode[0]?.value);
            });
        })
    </script>

@endsection
