@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edit Management'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form role="form" method="post" action="{{ route('user.update', $user->encrypted_id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="fw-bold">Name</label>
                                <input class="form-control" value="{{ $user->name }}" name="name" type="text" placeholder="Name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Email</label>
                                <input class="form-control" value="{{ $user->email }}" name="email" type="email" placeholder="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="" disabled selected>Choose One</option>
                                    <option value="m">Male</option>
                                    <option value="f">Female</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Password</label>
                                <input class="form-control" value="" :class="{ 'is-invalid': errors.password }" name="password" type="password" placeholder="Password"  @if($user->id != auth()->user()->id) readonly @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="fw-bold">Repeat Password</label>
                                <input class="form-control" value="" :class="{ 'is-invalid': errors.password_confirmation }" name="repeat" type="password" placeholder="Repeat Password" @if($user->id != auth()->user()->id) readonly @endif>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-bold">Role</label>
                        <br>
                        @foreach ($roles as $role)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="{{ $role->name }}" name="roles" id="{{ $role->id }}" @if(count($user->roles)) @if($user->roles[0]->id == $role->id) checked @endif @endif>
                                <label class="form-check-label" for="{{ $role->id }}">{{ $role->name }}</label>
                            </div>
                        @endforeach
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">UPDATE</button>
                            <button class="btn btn-warning shadow-sm rouned-sm ms-3" type="reset">RESET</button>
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
