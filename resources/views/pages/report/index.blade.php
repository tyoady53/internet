@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan'])
    <div class="mx-4 mt-8" id="user_info">
        <div class="row mt-4">
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4" onclick="show('bill-rep')">
                <div class="card hover">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8 my-auto">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan Billing</p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-primary shadow-primary text-center rounded-circle p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="20" height="20" viewBox="0 0 256 256" xml:space="preserve">
                                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;" transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)" >
                                            <path d="M 67.245 21.439 c -1.104 0 -2 -0.896 -2 -2 V 2.136 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 17.303 C 69.245 20.543 68.35 21.439 67.245 21.439 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 2 71.518 c -1.104 0 -2 -0.896 -2 -2 V 2.136 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 67.382 C 4 70.622 3.104 71.518 2 71.518 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 77.622 89.864 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 c 3.931 0 7.237 -2.721 8.137 -6.377 H 67.245 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 H 88 c 1.104 0 2 0.896 2 2 C 90 84.312 84.447 89.864 77.622 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 67.245 79.487 c -1.104 0 -2 -0.896 -2 -2 V 53.169 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 24.318 C 69.245 78.592 68.35 79.487 67.245 79.487 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 12.377 89.864 C 5.553 89.864 0 84.312 0 77.487 v -7.97 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 7.97 c 0 4.619 3.758 8.377 8.377 8.377 c 1.104 0 2 0.896 2 2 S 13.482 89.864 12.377 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 77.622 89.864 H 12.377 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 65.245 c 1.104 0 2 0.896 2 2 S 78.727 89.864 77.622 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 12.377 89.864 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 c 4.619 0 8.377 -3.758 8.377 -8.377 c 0 -1.104 0.896 -2 2 -2 h 44.49 c 1.104 0 2 0.896 2 2 s -0.896 2 -2 2 H 24.593 C 23.635 85.364 18.521 89.864 12.377 89.864 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 41.739 52.07 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 25.863 c 1.104 0 2 0.896 2 2 S 42.844 52.07 41.739 52.07 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 71.038 40.392 c -1.073 0 -1.949 -0.845 -1.998 -1.906 c -1.061 -0.049 -1.906 -0.925 -1.906 -1.998 c 0 -1.104 0.896 -2 2 -2 c 2.153 0 3.904 1.751 3.904 3.904 C 73.038 39.496 72.143 40.392 71.038 40.392 z M 69.134 38.487 h 0.01 H 69.134 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 67.245 31.748 c -1.104 0 -2 -0.896 -2 -2 V 27.39 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.358 C 69.245 30.852 68.35 31.748 67.245 31.748 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 69.134 38.487 h -3.778 c -2.153 0 -3.904 -1.751 -3.904 -3.904 v -2.931 c 0 -2.153 1.751 -3.904 3.904 -3.904 h 3.778 c 2.153 0 3.904 1.751 3.904 3.904 c 0 1.104 -0.896 2 -2 2 c -1.072 0 -1.948 -0.844 -1.998 -1.904 h -3.589 v 2.74 h 3.683 c 1.104 0 2 0.896 2 2 S 70.238 38.487 69.134 38.487 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 67.245 47.586 c -1.104 0 -2 -0.896 -2 -2 v -2.358 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.358 C 69.245 46.69 68.35 47.586 67.245 47.586 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 69.134 45.228 h -3.778 c -2.153 0 -3.904 -1.751 -3.904 -3.904 c 0 -1.104 0.896 -2 2 -2 c 1.072 0 1.948 0.844 1.998 1.904 h 3.589 v -2.836 c 0 -1.104 0.896 -2 2 -2 s 2 0.896 2 2 v 2.932 C 73.038 43.476 71.287 45.228 69.134 45.228 z M 65.451 41.323 h 0.01 H 65.451 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 54.271 64.202 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 38.395 c 1.104 0 2 0.896 2 2 S 55.375 64.202 54.271 64.202 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 59.09 11.045 c -0.46 0 -0.92 -0.158 -1.293 -0.474 l -6.863 -5.814 l -6.862 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 l -6.863 -5.814 l -6.863 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 l -6.863 -5.814 l -6.862 5.814 c -0.746 0.632 -1.84 0.632 -2.586 0 L 0.707 3.662 C -0.136 2.948 -0.24 1.686 0.474 0.843 C 1.188 -0.001 2.45 -0.104 3.293 0.61 l 6.863 5.814 l 6.862 -5.814 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 L 33.33 0.61 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 l 6.862 -5.814 c 0.746 -0.632 1.84 -0.632 2.586 0 l 6.863 5.814 l 6.862 -5.814 c 0.843 -0.713 2.104 -0.61 2.819 0.233 c 0.714 0.843 0.609 2.105 -0.233 2.819 l -8.155 6.909 C 60.01 10.887 59.55 11.045 59.09 11.045 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 67.245 55.169 c -10.402 0 -18.865 -8.463 -18.865 -18.865 s 8.463 -18.865 18.865 -18.865 c 10.401 0 18.864 8.463 18.864 18.865 S 77.646 55.169 67.245 55.169 z M 67.245 21.439 c -8.196 0 -14.865 6.668 -14.865 14.865 s 6.669 14.865 14.865 14.865 S 82.109 44.5 82.109 36.304 C 82.109 28.107 75.441 21.439 67.245 21.439 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 34.69 39.939 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 H 34.69 c 1.104 0 2 0.896 2 2 S 35.794 39.939 34.69 39.939 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path d="M 41.739 27.808 H 15.876 c -1.104 0 -2 -0.896 -2 -2 s 0.896 -2 2 -2 h 25.863 c 1.104 0 2 0.896 2 2 S 42.844 27.808 41.739 27.808 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(255, 255, 255); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4" onclick="show('pay-rep')">
                <div class="card hover">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8 my-auto">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan Pembayaran</p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-calendar-grid-58 text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4" onclick="show('omzet')">
                <div class="card hover">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8 my-auto">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan Omzet</p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-primary shadow-primary shadow-success text-center rounded-circle">
                                    {{-- <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i> --}}
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
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

        .hover:hover{
            background: blue;
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
            new DataTable('#example1', {
                order: [[4, 'asc'],[2, 'asc']]
            });
        })

        function show(param){
            var baseUrl = window.location;
            window.location.href = '/report/'+param+'/show'
        }
    </script>

@endsection
