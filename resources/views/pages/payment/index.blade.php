@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Pembayaran '])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form>
                    <div class="input-group mb-3">
                        <div class="input-group mb-3">
                            <form role="form" method="get" action="{{ route('report.index') }}">
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
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <p><h3 style="color:white">Pilih setidaknya 1 billing yang akan di bayar.</h3></p>
                        {{-- <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul> --}}
                    </div>
                @endif
                @if (auth()->user()->getRoleNames()[0] == 'superadmin')
                <div>
                    <button onclick="sync()"><i class="fa fa-sync"></i>&nbsp Sync</button>
                </div>
                @endif
                <div class="table-responsive">
                    <h5>TAGIHAN BELUM DI BAYAR</h5>
                <table class="table table-striped table-bordered table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"> Nama </th>
                            <th scope="col" class="text-center"> No. Rumah </th>
                            <th scope="col" class="text-center"> Tanggal Billing </th>
                            <th scope="col" class="text-center"> Terlambat </th>
                            <th scope="col" class="text-center"> Denda </th>
                            {{-- <th scope="col" class="text-center"> Status </th> --}}
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
                            <form action="{{ 'payment/'.$u->encrypted_id }}" method="POST">
                                @csrf
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->house_no }}</td>
                                <td>
                                    @foreach ($u->billings as $billing)
                                        <input type="checkbox" name="billing_id[]" value="{{ $billing->id }}" checked>
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
                                        {{ number_format(1  *$setup->fine_fee) }}<br>
                                    @endforeach
                                </td>
                                {{-- <td class="text-center">
                                    @if($u->pay_date == null)
                                        Belum Dibayar
                                    @else
                                        Terbayar
                                    @endif
                                </td> --}}
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
                                        {{ number_format(($billing->price_total) + (1*$setup->fine_fee)) }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-success btn-sm me-2" type="submit">
                                        {{-- <i class="fa fa-money me-1"></i>  --}}
                                        <i class="fa fa-solid fa-file-invoice-dollar"></i>
                                        &nbsp Buat Kwitansi
                                    </button>
                                    {{-- @if($u->pay_date == null)
                                        <a href="{{ 'payment/'.$u->encrypted_id }}" class="btn btn-success btn-sm me-2"><i class="fa fa-money me-1"></i> Bayar</a>
                                    @else
                                        <span class="badge bg-success shadow border-0 ms-2 mb-2">
                                            Lunas
                                        </span>
                                    @endif --}}
                                </td>
                            </form>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <hr>
                {{-- {{ $paid }} --}}
                <div class="table-responsive">
                    <h5>TAGIHAN SUDAH DI BAYAR</h5>
                    <table class="table table-striped table-bordered table-hover" id="example1">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center"> Nama </th>
                                <th scope="col" class="text-center"> No. Rumah </th>
                                <th scope="col" class="text-center"> Tanggal Billing </th>
                                <th scope="col" class="text-center"> Terlambat </th>
                                <th scope="col" class="text-center"> Denda </th>
                                <th scope="col" class="text-center"> Tanggal Bayar </th>
                                <th scope="col" class="text-center"> Pemakaian Sebelumnya </th>
                                <th scope="col" class="text-center"> Hasil Water Meter </th>
                                <th scope="col" class="text-center"> Pemakaian </th>
                                <th scope="col" class="text-center"> Total </th>
                                <th scope="col" class="text-center"> Aksi </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paid as $u)
                            <tr>
                                <td>{{ $u->customer->name }}</td>
                                <td>{{ $u->customer->house_no }}</td>
                                <td>
                                    @foreach ($u->detail as $billing)
                                        {{ $billing->billing->billing_date }}<br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($u->detail as $billing)
                                        {{ $billing->late }} Bulan<br>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    @foreach ($u->detail as $billing)
                                        {{ number_format($billing->billing->fines) }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    {{ $u->payment }}
                                </td>
                                <td class="text-center">
                                    @foreach ($u->detail as $billing)
                                        {{ $billing->billing->water_meter_count }} m<sup>3</sup> <br>
                                    @endforeach

                                </td>
                                <td class="text-center">
                                    @foreach ($u->detail as $billing)
                                        {{ $billing->billing->usage }} m<sup>3</sup><br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($u->detail as $billing)
                                        {{ $billing->billing->usage - (int)$billing->billing->water_meter_count }} m<sup>3</sup> <br>
                                    @endforeach
                                </td>
                                <td class="text-end">
                                    @foreach ($u->detail as $billing)
                                        {{ number_format(($billing->billing->price_total) + (1*$setup->fine_fee)) }}<br>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a type="button" data-bs-toggle="modal" data-target-id="{{ $u->encrypted_id }}" data-bs-target="#modal_bayar" class="btn btn-success btn-sm me-2"><i class="fa fa-money me-1" href="#"></i>&nbsp Bayar</a>
                                    {{-- <a href="{{ 'print/'.$u->encrypted_id }}" onclick="window.open(this.href, 'new', 'popup'); return false;" class="btn btn-success btn-sm me-2"><i class="fa fa-print me-1"></i> Cetak</a> --}}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_bayar" tabindex="-1" aria-labelledby="UserDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserDetailsModalLabel">Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="form_content">

                </div>
                {{-- <form  method="get" action="{{ route('billing.store',$unique_id) }}">
                    <div class="modal-body">
                        <div id="payment_encrypted"></div>
                        <div id="content"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form> --}}
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
        $(document).ready(function() {
            new DataTable('#example', {
                order: [1, 'asc']
            });
            new DataTable('#example1', {
                order: [0, 'desc']
            });

            $("#modal_bayar").on("show.bs.modal", function (e) {
                var id = $(e.relatedTarget).data('target-id');
                var inner = '';
                // inner += '<form  method="get" action="print/'+id+'">';
                inner += '<div class="modal-body">';
                inner += '<input class="form-control" name="payment_encrypted" id="payment_encrypted" value="'+id+'" type="hidden" readonly>';
                // $('#pass_id').val(id);
                axios({
                method: 'get',
                url: '/payment/get/'+id
                })
                .then(function (response) {
                    const formatter = new Intl.NumberFormat('en');
                    var total = response.data.data.total;
                    var paid = response.data.data.paid;
                    var diff = total-paid;
                    inner += '<input class="form-control" name="token" id="token" value="'+response.data.token_+'" type="text" readonly>';
                    inner += '<p><strong>Total          : </strong><span>'+formatter.format(total)+'</span></p>';
                    inner += '<p><strong>Sudah DIbayar  : </strong><span>'+formatter.format(paid)+'</span></p>';
                    inner += '<p><strong>Kurang         : </strong><span>'+formatter.format(diff)+'</span></p>';
                    if(response.data.data.pays.length > 0){
                        inner += '<p><strong>Detail Pembayaran</p><ul>';
                            for(var i = 0;i < response.data.data.pays.length; i++){
                                let objectDate = new Date(response.data.data.pays[i].created_at);
                                let day = objectDate.getDate();
                                console.log(day); // 23

                                let month = objectDate.getMonth();
                                console.log(month + 1); // 8

                                let year = objectDate.getFullYear();
                                console.log(year); // 2022
                                inner += '<li><p><strong>'+day+'-'+month+'-'+year+'</strong>:<span>'+formatter.format(response.data.data.pays[i].payment_amount)+'</span></p></li>';
                            }
                        inner += '</ul>';
                    }

                    inner +='Jumlah Dibayar<input class="form-control" name="pay_amount" id="pay_amount" type="number">';
                    inner +='<div class="modal-footer"><button type="submit"class="btn btn-success btn-sm me-2" data-bs-dismiss="modal" onclick="payment()"><i class="fa fa-print me-1"></i> Print</button></div>';
                    inner +='</div>';
                    // inner +='</form>';
                    document.getElementById("form_content").innerHTML = inner;
                });
            });
        });

        function reload(){
            window.location.reload;
        }

        function payment(){
            var amount = document.getElementById("pay_amount").value;
            var encrypt = document.getElementById("payment_encrypted").value;
            var token = document.getElementById("token").value;
            // alert(_token);
            axios({
                method: 'post',
                url: '/payment/pays/'+encrypt,
                data: {
                    _token: token,
                    amount: amount
                }
            })
            .then(function (response) {
                if(response.data.status == 200){
                    this.print(encrypt);
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: "failed to save",
                        icon: 'warning'
                    });
                }
            });
        }

        function print(encrypt){
            var base_url = window.location.origin;
            window.open(base_url+'/payment/print/'+encrypt, 'new', 'popup');
        }

        function sync(){
            axios({
            method: 'get',
            url: '/payment/sync'
            })
            .then(function (response) {
                Swal.fire({
                    title: response.data.title,
                    text: response.data.text,
                    icon: response.data.icon
                });
                console.log(response);
            });
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
