@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pelanggan'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                {{-- {{ dd(session()->all()); }} --}}
                <form>
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="input-group mb-3">
                                {{-- <a href="/customer/create" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</a> --}}
                                <a href="" data-bs-toggle="modal" data-bs-target="#modal_add" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</a>
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
                                                    <a href=""
                                                        data-customer_id="{{ $customer['encrypted_id'] }}"
                                                        data-customer_name="{{ $customer['name'] }}"
                                                        data-customer_address="{{ $customer['address'] }}"
                                                        data-customer_area="{{ $customer['group_id'] }}"
                                                        data-customer_paket="{{ $customer['billing_id'] }}"
                                                        data-customer_pasang="{{ $customer['join_date'] }}"
                                                        data-customer_diskon="{{ $customer['discount'] }}"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modal_edit"
                                                        class="btn btn-success btn-sm me-2">
                                                        <i class="fa fa-pencil me-1"></i>
                                                        EDIT
                                                    </a>
                                                    {{-- <a href="{{ './edit/'.$customer['encrypted_id'] }}" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</a> --}}
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

    <div class="modal fade" id="modal_add" tabindex="-1" aria-labelledby="UserDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserDetailsModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="form_content">
                    <div class="modal-body">
                        <form  method="post" action="{{ route('customer.store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Name</label>
                                        <input class="form-control" value="{{ old('name') }}" name="name" type="text" placeholder="Nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Alamat</label>
                                        <input class="form-control" value="{{ old('address') }}" name="address" type="text" placeholder="Alamat">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Area</label>
                                <select class="form-control" name="group" required>
                                    <option value="">Pilih</option>
                                    @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Paket</label>
                                <select class="form-control" name="package" required>
                                    <option value="">Pilih</option>
                                    @foreach ($billings as $billing)
                                    <option value="{{ $billing->id }}">{{ $billing->billing_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Tanggal Pasang</label>
                                        <input class="form-control" value="{{ old('join_date') }}" name="join_date" type="date" placeholder="Tanggal Pasang" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Diskon (%)</label>
                                        <input class="form-control" value="{{ old('dicount') }}" name="dicount" type="number" max="100" placeholder="Diskon">
                                    </div>
                                </div>
                            </div>
                            * Kosongkan Discount jika tidak ada, dan Tanggal Pasang jika di input di hari yang sama dengan tanggal pasang
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_edit" tabindex="-1" aria-labelledby="UserDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserDetailsModalLabel">Tambah Pelanggan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="form_content">
                    <div class="modal-body">
                        <form method="post">
                            @csrf
                            {{-- @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Name</label>
                                        <input class="form-control" name="edit_name" type="text" placeholder="Nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Alamat</label>
                                        <input class="form-control" name="edit_address" type="text" placeholder="Alamat">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Area</label>
                                <select class="form-control" name="edit_group" required>
                                    <option value="">Pilih</option>
                                    @foreach ($groups as $group)
                                    <option value="{{ $group->id }}">{{ $group->group_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="fw-bold">Paket</label>
                                <select class="form-control" name="edit_package" required>
                                    <option value="">Pilih</option>
                                    @foreach ($billings as $billing)
                                    <option value="{{ $billing->id }}">{{ $billing->billing_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Tanggal Pasang</label>
                                        <input class="form-control" name="edit_join_date" type="date" placeholder="Tanggal Pasang" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="fw-bold">Diskon (%)</label>
                                        <input class="form-control" name="edit_dicount" type="number" max="100" placeholder="Diskon">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Update
                                </button>
                            </div>
                        </form>
                    </div>
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
                order: [[4, 'asc'],[2, 'asc']]
            });
            // new DataTable('#example');
        })

        $("#modal_edit").on("show.bs.modal", function (e) {
            var button = $(e.relatedTarget);
            var customerName = button.data('customer_name');
            var customerAddress = button.data('customer_address');
            var customerArea = button.data('customer_area');
            var customerPaket = button.data('customer_paket');
            var customerPasang = button.data('customer_pasang');
            var customerDiskon = button.data('customer_diskon');
            var customerId = button.data('customer_id');

            // Now set values in the form fields inside the modal
            $(this).find('input[name="edit_name"]').val(customerName);
            $(this).find('input[name="edit_address"]').val(customerAddress);
            $(this).find('select[name="edit_group"]').val(customerArea);
            $(this).find('select[name="edit_package"]').val(customerPaket);
            $(this).find('input[name="edit_join_date"]').val(customerPasang);
            $(this).find('input[name="edit_dicount"]').val(customerDiskon);

            var formAction = `/customer/update/${customerId}`;

            $(this).find('form').attr('action', formAction);
        });
    </script>

@endsection
