@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'User Management'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form>
                    <div class="input-group mb-3">
                        <a href="/user/create" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</a>
                        {{-- <input type="text" class="form-control input-group-text mb-3" placeholder="search by user name . . .">

                        <button class="btn btn-primary input-group-text" type="submit"> <i class="fa fa-search me-2"></i> SEARCH</button> --}}
                    </div>
                </form>
                <table class="table table-striped table-bordered table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center"> Name </th>
                            <th scope="col" class="text-center"> Role </th>
                            <th scope="col" style="width:10%" class="text-center"> Actions </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td class="text-center">
                                @if(count($u->roles))
                                    <span class="badge bg-primary shadow border-0 ms-2 mb-2">
                                        {{ $u->roles[0]->name }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                {{-- <form method="post" action="{{ route('user.reset_password', $u->encrypted_id ) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary btn-sm me-2"><i class="fa fa-sync-alt me-1"></i> Reset Password</button> --}}
                                    {{-- <input class="form-control" value="{{ $u->encrypted_id }}" name="permission_name" type="hidden" placeholder="Permission Name"> --}}
                                    {{--  --}}
                                {{-- </form> --}}
                                <a href="{{ './reset_pass/'.$u->encrypted_id }}" class="btn btn-primary btn-sm me-2"><i class="fa fa-sync-alt me-1"></i> Reset Password</a>
                                <a href="{{ './edit/'.$u->encrypted_id }}" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</a>
                                    {{-- <a href="{{ route('user.edit', $u->slug) }}" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</a> --}}
                            </td>
                        </tr>
                        @endforeach
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
            new DataTable('#example');
        })
    </script>

@endsection
