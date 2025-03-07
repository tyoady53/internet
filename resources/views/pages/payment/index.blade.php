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
                                <select class="form-control input-group-text mb-3 me-1" name="periode">
                                @foreach ($filters as $filter)
                                    <option value="{{ $filter->key }}" {{ request('periode') == $filter->key ? 'selected' : '' }}>{{ $filter->value }}</option>
                                @endforeach
                                </select>
                                <select class="form-control input-group-text mb-3 me-1" name="group">
                                @foreach ($groups as $group)
                                    <option value="{{ $group->id }}" {{ request('group') == $group->id ? 'selected' : '' }}>{{ $group->group_name }}</option>
                                @endforeach
                                </select>
                                <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> Filter</button>
                            </form>
                        </div>
                    </div>
                </form>
                <section id="loading" style="display: none;">
                    <div id="loading-content"></div>
                </section>
                <div class="accordion" id="accordionExample">
                    @foreach ($datas as $idx=>$data)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ str_replace(' ', '', $idx)  }}">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ str_replace(' ', '', $idx) }}" aria-expanded="false" aria-controls="collapse{{ str_replace(' ', '', $idx)  }}">
                                {{ $idx }} ({{ count($datas[$idx]) }})
                            </button>
                        </h2>
                        <div id="collapse{{ str_replace(' ', '', $idx)  }}" class="accordion-collapse collapse" aria-labelledby="heading{{ str_replace(' ', '', $idx)  }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="example{{ str_replace(' ', '', $idx)  }}">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center"> Nama </th>
                                                <th scope="col" class="text-center"> paket </th>
                                                <th scope="col" class="text-center"> Tanggal Billing </th>
                                                <th scope="col" class="text-center"> No. Billing </th>
                                                <th scope="col" class="text-center"> Total </th>
                                                <th scope="col" class="text-center"> Tanggal Bayar </th>
                                                <th scope="col" style="width:10%" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $customer)
                                            <tr>
                                                <td>{{ $customer['name'] }}</td>
                                                <td class="text-end">{{ $customer['paket'] }}</td>
                                                <td class="text-center">{{ $customer['tanggal_billing'] }}</td>
                                                <td>{{ $customer['billing_number'] }}</td>
                                                <td class="text-end">{{ number_format($customer['total'], 0, ',', '.') }}</td>
                                                <td>{{ $customer['tanggal_bayar'] }}</td>
                                                <td class="text-center">
                                                    @if($idx == 'Belum Bayar')
                                                    <a type="button" data-bs-toggle="modal"
                                                    data-billing-number="{{ $customer['billing_number'] }}"
                                                    data-jumlah="{{ $customer['jumlah'] }}"
                                                    data-discount="{{ $customer['diskon'] }}"
                                                    data-total="{{ $customer['total'] }}"
                                                    data-customer="{{ $customer['name'] }}"
                                                    data-bs-target="#modal_bayar" class="btn btn-success btn-sm me-2">
                                                    <i class="fa fa-money me-1"></i> Bayar</a>
                                                    @else
                                                    <a href="/payment/print/receipt/{{ $customer['billing_number'] }}" target="_blank" class="btn btn-primary"> <i class="fa fa-print" aria-hidden="true"></i> Print </a>
                                                    {{-- Print Ulang --}}
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
                    @endforeach
                </div><!-- accordion end -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_bayar" tabindex="-1" aria-labelledby="UserDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UserDetailsModalLabel">Konfirmasi Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="form_content">
                    <div class="modal-body">
                        <table>
                            <tr>
                                <td><strong>Customer</strong></td>
                                <td><strong>: </strong> <span id="customer"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Billing Number</strong></td>
                                <td><strong>: </strong> <span id="modal_billing_number"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah:</strong></td>
                                <td><strong>: </strong> <span id="modal_jumlah"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Discount:</strong></td>
                                <td><strong>: </strong> <span id="modal_discount"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Grand Total:</strong></td>
                                <td><strong>: </strong> <span id="modal_total"></span></td>
                            </tr>
                        </table>
                        {{-- <span id="modal_billing_number"></span></p>
                         <span id="modal_jumlah"></span></p>
                         <span id="modal_discount"></span></p>
                        </p> --}}
                        <div class="modal-footer">
                            <button type="button" onclick="payment()" class="btn btn-success" id="modal_bayar_button">
                                <i class="fa fa-money me-1"></i> Bayar
                            </button>
                        </div>
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
        window.trx_id = '';
        $(document).ready(function() {
            new DataTable('#example', {
                order: [1, 'asc']
            });
            new DataTable('#example1', {
                order: [0, 'desc']
            });

            $("#modal_bayar").on("show.bs.modal", function (e) {
                window.trx_id = '';
                var button = $(e.relatedTarget); // Button that triggered the modal
                var billingNumber = button.data('billing-number'); // Extract the data-* attributes
                var jumlah = button.data('jumlah');
                var discount = button.data('discount');
                var total = button.data('total');
                var customer = button.data('customer');

                console.log(button);
                // Set the values inside the modal
                $('#modal_billing_number').text(billingNumber);
                $('#modal_jumlah').text(formatNumber(jumlah));
                $('#modal_discount').text(formatNumber(discount));
                $('#modal_total').text(formatNumber(total));
                $('#customer').text(customer);

                // Optionally, set a default value for the input field
                // $('#pay_amount').val(total - discount);
                window.trx_id = billingNumber;
                console.log("Global trx_id Set:", window.trx_id);
                // $('#modal_bayar_button').attr('href', './pay/' + billingNumber);
            });
        });

        function formatNumber(number) {
            const formatter = new Intl.NumberFormat('en');
            var total = parseInt(number);
            return formatter.format(total);
        }

        function reload(){
            window.location.reload;
        }

        function payment(){
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            console.log("trx_id before payment:", window.trx_id);

            if (!window.trx_id) {
                Swal.fire({
                    title: 'Error!',
                    text: "Transaction ID is missing!",
                    icon: 'warning'
                });
                return;
            }
            axios({
                method: 'post',
                url: '/payment/pay/' + window.trx_id,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(function (response) {
                if(response.data.status == 200){
                    window.open('/payment/print/receipt/' + response.data.data, '_blank');
                    setTimeout(() => {
                        window.location.reload();
                    }, 500)
                    // this.print(encrypt);
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
            if(base_url.includes('demo')){
                base_url = base_url + 'public/';
            }
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
