@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Buat Billing'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form role="form" method="post" action="{{ route('billing.store',$unique_id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Nama</label>
                                <input class="form-control" value="{{ $customer[0]->name }}" name="name" type="text" placeholder="Name" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">No.</label>
                                <input class="form-control" value="{{ $customer[0]->house_no }}" name="house_no" type="text" placeholder="Name" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="fw-bold">Alamat</label>
                                <input class="form-control" value="{{ $customer[0]->address }}" name="address" type="number" placeholder="Address" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="fw-bold">Periode</label>
                                        <select class="form-control" name="periode">
                                            @foreach ($month_arr as $month)
                                                <option value="{{ $month->key }}" {{ $selected == $month->key ? 'selected' : '' }}>{{ $month->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- {{ $customer }} --}}
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="fw-bold">Pemakaian Terakhir</label>
                                        <input class="form-control" value="{{ $customer[0]->billings[0]->usage ?? 0 }}" name="last_usage" id="lat_usage" type="number" readonly>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="fw-bold">Hasil baca Water Meter</label>
                                        <input class="form-control" value="" name="usage" id="usage" type="number" placeholder="Usage" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="billings">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
                            <button class="btn btn-success shadow-sm rounded-sm" type="submit">Simpan</button>
                            <button class="btn btn-warning shadow-sm rouned-sm ms-3" type="reset">Reset</button>
                        </div>
                    </div>
                </form>
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
        var billing_arr = <?php echo json_encode($billings); ?>;
        $(document).ready(function(){
            $("#usage").keyup(function(){
                var a = '';
                var b = '';
                var total = 0;
                var usage = $("#usage").val();
                var last_usage = $("#lat_usage").val();
                var inputString = usage - last_usage;
                var minimal = 0;
                const formatter = new Intl.NumberFormat('en');
                // var total = document.getElementById('usage');
                for(var i = 0;i < billing_arr.length; i++){
                    if(inputString > (billing_arr[billing_arr.length - 1].minimal) - 1){
                        if(billing_arr[i].minimal > 0){
                            minimal = billing_arr[i].minimal - 1;
                        }
                        if(inputString > billing_arr[i].minimal) {
                            if(inputString > billing_arr[i].maximal){
                                a += '<label>'+billing_arr[i].minimal+'-'+billing_arr[i].maximal+' <br> &nbsp'+(billing_arr[i].maximal - minimal) +'x'+ formatter.format(billing_arr[i].price)+' = Rp'+formatter.format((billing_arr[i].maximal - minimal) * billing_arr[i].price)+'</label> <br>';
                                total += (billing_arr[i].maximal - minimal) * billing_arr[i].price;
                            }
                            else {
                                a += '<label> >'+billing_arr[i].minimal+' <br> &nbsp'+(inputString - (billing_arr[i].minimal - 1)) +'x'+ formatter.format(billing_arr[i].price)+' = Rp'+formatter.format((inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price)+'</label> <br>';
                                total += (inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price;
                            }
                        } else {
                            a += '<label> >'+billing_arr[i].minimal+' <br> &nbsp'+(inputString - (billing_arr[i].minimal - 1)) +'x'+ formatter.format(billing_arr[i].price)+' = Rp'+formatter.format((inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price)+'</label> <br>';
                            total += (inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price;
                        }
                    } else {
                        if(billing_arr[i].billing_option == 'static'){
                            if(billing_arr[i].minimal > 0){
                                minimal = billing_arr[i].minimal - 1;
                            }
                            a += '<label> '+billing_arr[i].minimal+'-'+billing_arr[i].maximal+' <br> &nbsp'+(billing_arr[i].maximal - minimal) +'x'+ formatter.format(billing_arr[i].price)+' = Rp'+formatter.format((billing_arr[i].maximal - minimal)  * billing_arr[i].price)+'</label> <br>';
                            total += (billing_arr[i].maximal - minimal) * billing_arr[i].price;
                        } else {
                            if(inputString > (billing_arr[i].minimal - 1)) {
                                if(inputString > billing_arr[i].maximal){
                                    a += '<label>'+billing_arr[i].minimal+'-'+billing_arr[i].maximal+' <br> &nbsp' + (billing_arr[i].maximal - (billing_arr[i].minimal -1)) + 'x'+ formatter.format(billing_arr[i].price)+' = Rp'+formatter.format((billing_arr[i].maximal - (billing_arr[i].minimal -1)) * billing_arr[i].price)+'</label> <br>';
                                    total += (billing_arr[i].maximal - (billing_arr[i].minimal -1)) * billing_arr[i].price;
                                }
                                else {
                                    a += '<label> '+billing_arr[i].minimal+'-'+billing_arr[i].maximal+' <br> &nbsp'+(inputString - (billing_arr[i].minimal - 1)) +'x'+ formatter.format(billing_arr[i].price)+' = Rp'+formatter.format((inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price)+'</label> <br>';
                                    total += (inputString - (billing_arr[i].minimal - 1)) * billing_arr[i].price;
                                }
                            }
                        }
                    }
                }
                b = a+'<br> Total = Rp. '+formatter.format(total);
                if(!inputString){
                    b = '';
                }
                document.getElementById('billings').innerHTML = b;
                // console.log(a);
            });

        });
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
