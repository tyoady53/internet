@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Customers'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                {{-- {{ dd(session()->all()); }} --}}
                <form>
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="input-group mb-3">
                                <a href="/customer/create" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</a>
                            </div>
                        </div>
                        <div>
                            <div class="input-group mb-3">
                                <a href="/customer/fetch" class="btn btn-primary input-group-text me-1"> <i class="fa fa-recycle me-2"></i> Fetch</a>
                                <button type="button" class="btn btn-primary mr-5" data-bs-toggle="modal" data-bs-target="#importExcel">
                                    <i class="fa fa-upload me-2"></i>
                                    Import
                                </button>
                                {{-- <a href="/customer/create" class="btn btn-primary input-group-text"> Import</a> --}}
                            </div>
                        </div>
                    </div>
                </form>
                {{-- {{ dd($cust_groups) }} --}}
                <div class="accordion" id="accordionExample">
                    @foreach ($cust_groups as $idx=>$group)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $group['id'] }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $group['id'] }}" aria-expanded="false" aria-controls="collapse{{ $group['id'] }}">
                                {{ $group['group_name'] }} ({{ count($group['customers']) }})
                            </button>
                        </h2>
                        <div id="collapse{{ $group['id'] }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $group['id'] }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="example{{ $group['id'] }}">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center"> Nama </th>
                                                <th scope="col" class="text-center"> Alamat </th>
                                                <th scope="col" class="text-center"> Tanggal Pasang </th>
                                                <th scope="col" class="text-center"> Paket </th>
                                                <th scope="col" class="text-center"> Status</th>
                                                <th scope="col" style="width:10%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($group['customers'] as $customer)
                                            <tr>
                                                <td>{{ $customer['name'] }}</td>
                                                <td>{{ $customer['address'] }}</td>
                                                <td>{{ $customer['join_date'] }}</td>
                                                <td>{{ $customer['package']['billing_name'] }}</td>
                                                <td class="text-center">
                                                    @if($customer['is_active'] == '1')
                                                        Active
                                                    @else
                                                        Not Active
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ './edit/'.$customer['encrypted_id'] }}" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div><!-- accordion end -->
            </div>
        </div>
    </div>
    <div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="/customer/import_excel" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="form-group">
                            <input type="file" name="file" required="required">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
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
                order: [[4, 'asc'],[2, 'asc']]
            });
            // new DataTable('#example');
        })
    </script>

@endsection
