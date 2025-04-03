@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Laporan'])
    <div class="card shadow-lg mx-4 mt-8" id="report">
        <div class="card-body p-3">
            <div class="row gx-4">
                <div class="accordion" id="accordionExample">
                    @foreach ($datas as $month => $files)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $month }}">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $month }}" aria-expanded="true" aria-controls="collapse{{ $month }}">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('M Y') }}
                                </button>
                            </h2>
                            <div id="collapse{{ $month }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $month }}" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="text-center">File Name</th>
                                                <th scope="col" class="text-center">File Size (KB)</th>
                                                <th scope="col" class="text-center">Created Date</th>
                                                <th scope="col" class="text-center">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($files as $file)
                                                <tr>
                                                    <td>{{ $file['file_name'] }}</td>
                                                    <td class="text-center">{{ number_format($file['file_size'] / 1024, 2) }} KB</td>
                                                    <td class="text-center">{{ $file['file_created'] }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ asset("storage/reports/{$month}/" . $file['file_name']) }}" class="btn btn-primary btn-sm" download>
                                                            <i class="fa fa-download me-1"></i> Download
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
@endsection
