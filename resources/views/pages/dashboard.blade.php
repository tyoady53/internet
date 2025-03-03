@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="mt-7">
            <h1>
                {{ auth()->user()->name }} ({{ auth()->user()->getRoleNames()[0] }})
            </h1>
        </div>
        {{-- <div class="row mt-4">
            <div class="col-xl-3 col-sm-6 mb-xl-0">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Pemakaian Stand Mater</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-4">
                                            Tahun
                                        </div>
                                        <div class="col-8">
                                            <select class="form-control input-group-text mb-3" name="periode" id="periode">
                                            @foreach ($filters as $filter)
                                                <option value="{{ $filter }}">{{ $filter }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-success shadow-sm rounded-sm" type="submit">Generate Chart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Tagihan yang Sudah Dibayar</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-4">
                                            Tahun
                                        </div>
                                        <div class="col-8">
                                            <select class="form-control input-group-text mb-3" name="periode" id="periode">
                                                @foreach ($filters as $filter)
                                                <option value="{{ $filter }}">{{ $filter }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-success shadow-sm rounded-sm" type="submit">Generate Chart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Tagihan yang Belum Dibayar</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-4">
                                            Tahun
                                        </div>
                                        <div class="col-8">
                                            <select class="form-control input-group-text mb-3" name="periode" id="periode">
                                                @foreach ($filters as $filter)
                                                <option value="{{ $filter }}">{{ $filter }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <button class="btn btn-success shadow-sm rounded-sm" type="submit">Generate Chart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row mt-4">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Rekap Penjualan</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
    <script>
        var chartData = @json($chart);
        var ctx1 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        new Chart(ctx1, {
            type: "bar",
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
