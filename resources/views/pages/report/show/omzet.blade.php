@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan Omzet'])
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
                        <button class="btn btn-primary input-group-text" type="button" id="load-data"> <i class="fa fa-search me-2"></i> Filter</button>
                    </div>
                </div>
                <div id="loading" class="loader" style="display:none;">
                </div>
                <table class="table table-striped table-bordered" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"> NAMA </th>
                            <th scope="col" class="text-center"> NO. RUMAH </th>
                            <th rowspan="2" class="text-center">
                                TANGGAL BILLING
                             </th>
                            <th rowspan="2" class="text-center">
                                UANG AIR
                             </th>
                             <th rowspan="2" class="text-center">
                                BIAYA ADM
                             </th>
                             <th rowspan="2" class="text-center">
                                DENDA
                             </th>
                             <th rowspan="2" class="text-center">
                                JUMLAH
                             </th>
                             <th rowspan="2" class="text-center">
                                PEMBAYARAN
                             </th>
                             <th rowspan="2" class="text-center">
                                BELUM DIBAYAR
                            </th>
                        </tr>
                    </thead>
                    <tbody id="data-container">
                        {{-- @foreach ($paid as $u)
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
                        @endforeach --}}
                    </tbody>
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
            $('#load-data').on('click', function() {
                const formatter = new Intl.NumberFormat('en');
                var periode = document.getElementById("periode").value;
                console.log('/api/get_data_omzet/'+periode);
                $.ajax({
                    url: '/api/get_data_omzet/'+periode,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        let dataContainer = $('#data-container');
                        dataContainer.empty(); // Clear previous data
                        $.each(response.data, function(index, item) {
                            let details = ''; let adm = ''; let denda = ''; let tanggal = '';
                            $.each(item.detail, function(detailIndex, detailItem) {
                                tanggal += detailItem.billing.billing_date + '<br>';
                                details += 'Rp. '+formatter.format(detailItem.price) + '<br>';
                                adm += 'Rp. '+formatter.format(detailItem.administration_fee) + '<br>';
                                denda += 'Rp. '+formatter.format(detailItem.fines) + '<br>';
                            });
                            dataContainer.append('<tr><td class="align-middle">'+item.customer.name
                                +'</td><td class="text-center align-middle">'+item.customer.house_no
                                +'</td><td class="text-center align-middle">'+tanggal
                                +'</td><td class="text-end align-middle">'+details
                                +'</td><td class="text-end align-middle">'+adm
                                +'</td><td class="text-end align-middle">'+denda
                                +'</td><td class="text-end align-middle">'+'Rp. '+formatter.format(item.total)
                                +'</td><td class="text-end align-middle">'+'Rp. '+formatter.format(item.paid)
                                +'</td><td class="text-end align-middle">'+'Rp. '+formatter.format(item.total - item.paid)
                                +'</td></tr>');
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        $("#loading").ajaxStart(function () {
            $(this).show();
        });

        $("#loading").ajaxStop(function () {
            $(this).hide();
        });

        // function search_data(){
        //     var periode = document.getElementById("periode").value;
        //     console.log('/api/get_data_omzet/'+periode);
        //     axios({
        //     method: 'get',
        //     url: '/api/get_data_omzet/'+periode
        //     })
        //     .then(function (response) {
        //         let dataContainer = $('#data-container');
        //         dataContainer.empty(); // Clear previous data
        //         $.each(response.data, function(index, item) {
        //             // <th scope="col" class="text-center"> NAMA </th>
        //             //         <th scope="col" class="text-center"> NO> RUMAH </th>
        //             //         <th rowspan="2" class="text-center">
        //             //             UANG AIR
        //             //          </th>
        //             //          <th rowspan="2" class="text-center">
        //             //              BIAYA ADM
        //             //          </th>
        //             //          <th rowspan="2" class="text-center">
        //             //              DENDA
        //             //          </th>
        //             //          <th rowspan="2" class="text-center">
        //             //              JUMLAH
        //             //          </th>
        //             //          <th rowspan="2" class="text-center">
        //             //             SUDAH DIBAYAR
        //             //         </th>
        //             dataContainer.append('<td class="align-middle">'+item.customer.name
        //                 +'</td><td class="align-middle">'+item.customer.house_no
        //                 +'</td><td class="align-middle">'+item.detail.array.forEach(element => {
        //                     element.price+'<br>';
        //                 });
        //                 +'</td><td scope="col">'+item.customer.name
        //                 +'</td><td scope="col">'+item.customer.name
        //                 +'</td><td scope="col">'+item.customer.name
        //                 +'</td><td scope="col">'+item.customer.name
        //                 +'</td>');
        //         });
        //     });
        // };
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

        .table-bordered-last tbody tr:last-child {
            border-bottom: 1px solid #dee2e6;
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
