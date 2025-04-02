@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Billing'])
    <div class="card shadow-lg mx-4 mt-8" id="billing">
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
                                <button class="btn btn-primary input-group-text" type="button"  id="filter"> <i class="fa fa-search me-2"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                </form>

                <div id="loading" style="display: none">
                    <div id="loading-content" class="loading-content"></div>

                </div>
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
                            {{-- <th scope="col" style="width:10%" class="text-center">Aksi</th> --}}
                        </tr>
                    </thead>
                    <tbody id="table_content">
                        {{-- <div>

                        </div> --}}
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
                $('#loading').show();
                var periode = document.getElementsByName('periode');
                axios({
                    method: 'get',
                    url: '/billing/fetch/'+periode[0]?.value
                    })
                    .then(function (response) {
                        if(response.data.status == 200) {
                            Swal.fire({
                                title: "Success!",
                                text: response.data.message,
                                icon: "success",
                                confirmButtonText: "OK"
                            }).then(() => {
                                get_data(periode[0]?.value); // Call function correctly
                            });
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: "Fetch data gagal",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                        // alert(response.data.status);
                    })
                // alert("Akan Fetching data billing "+periode[0]?.value);
            });

            $("#filter").click(function(){
                // window.showLoading()
                $('#loading').show();
                var periode = document.getElementsByName('periode');
                get_data(periode[0]?.value);
            });
        })

        function get_data(date) {
            var inner = '';
            axios({
                method: 'get',
                url: '/billing/get/'+date
                })
                .then(function (response) {
                    // window.hideLoading()
                    $('#loading').hide();
                    if(response.data.status == 200) {
                        var inner = "";
                        var data = response.data.data; // This is an object, not an array

                        // Loop through group names (keys)
                        Object.keys(data).forEach((groupName, i) => {
                            var current_data = data[groupName]; // Array of customers under this group
                            console.log(data);
                            console.log(groupName);

                            inner += '<tr>';
                            inner += '<td colspan="6">';
                            inner += groupName + ' (' + current_data.length + ')';
                            inner += '</td>';
                            inner += '</tr>';

                            // Loop through customers in this group
                            current_data.forEach((customer, j) => {
                                inner += '<tr>';
                                inner += '<td>' + (j + 1) + '</td>';
                                inner += '<td>' + customer.name + '</td>';
                                inner += '<td>' + customer.address + '</td>';
                                inner += '<td>' + customer.paket + '</td>'; // Fixed package name reference
                                inner += '<td class="text-center">';
                                inner += customer.tanggal_bayar !== '-'
                                    ? `<span class="badge bg-success shadow border-0 ms-2 mb-2">Sudah Dibayar</span>`
                                    : `<span class="badge bg-danger shadow border-0 ms-2 mb-2">Belum Dibayar</span>`;
                                inner += '</td>';
                                inner += '<td>' + (customer.tanggal_bayar !== '-' ? customer.tanggal_bayar : "") + '</td>';
                                inner += '</tr>';
                            });
                        });
                            // for(var i =0; i < response.data.data.length; i++) {
                            //     current_data = response.data.data[i];
                            //     inner += '<tr>';
                            //     inner += '<td colspan="6">';
                            //     inner += current_data.group_name + ' ('+current_data.customers.length+')';
                            //     inner += '</td>';
                            //     inner += '</tr>';
                            //     for(var j = 0; j< current_data.customers.length; j ++){
                            //         current_ = current_data.customers[j];
                            //         console.log(current_.billing.length)
                            //         if(current_.billing.length > 0) {
                            //             inner += '<tr>';
                            //             inner += '<td>';
                            //             inner += parseInt(j) + 1;
                            //             inner += '</td>';
                            //             inner += '<td>';
                            //             inner += current_.name;
                            //             inner += '</td>';
                            //             inner += '<td>';
                            //             inner += current_.address;
                            //             inner += '</td>';
                            //             inner += '<td>';
                            //             inner += current_.package.billing_name;
                            //             inner += '</td>';
                            //             inner += '<td class="text-center">';
                            //             inner += current_.billing[0].pay_date ? `<span class="badge bg-success shadow border-0 ms-2 mb-2">Sudah Dibayar</span>` : `<span class="badge bg-danger shadow border-0 ms-2 mb-2">Belum Dibayar</span>`;
                            //             inner += '</td>';
                            //             inner += '<td>';
                            //             inner += current_.billing[0].pay_date ? current_.billing[0].pay_date : "";
                            //             inner += '</td>';
                            //             inner += '</tr>';
                            //         }
                            //     }
                            // }
                        document.getElementById("table_content").innerHTML = inner;
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Get data gagal",
                            icon: "error",
                            confirmButtonText: "OK"
                        });
                    }
                })
                console.log(inner)
            // alert('get data here @'+date);
        }
    </script>

@endsection
