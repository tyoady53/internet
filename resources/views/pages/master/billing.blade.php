@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Master Billing'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form>
                    <div class="input-group mb-3">
                        <a href="/role/create" class="btn btn-primary input-group-text"> <i class="fa fa-plus-circle me-2"></i> NEW</a>
                    </div>
                </form>
                <table class="table table-striped table-bordered table-hover" id="example">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Minimal Usage</th>
                            <th scope="col" class="text-center">Maximal Usage</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" style="width:20%" class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $u)
                        <tr>
                            <td>{{ $u->minimal }}</td>
                            <td>{{ $u->maximal }}</td>
                            <td>{{ $u->price }}</td>
                            <td class="text-center">
                                <a href="{{ './edit/'.$u->id }}" class="btn btn-success btn-sm me-2"><i class="fa fa-pencil-alt me-1"></i> EDIT</a>
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
        @include('layouts.footers.auth.footer')
    </div>
    <script>
        $(document).ready(function($) {
            new DataTable('#example');
        })
    </script>
@endsection
