@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Roles'])
    <div class="card shadow-lg mx-4 mt-8" id="user_info">
        <div class="card-body p-3">
            <div class="row gx-4">
                <form role="form" method="post" action="{{ route('role.update',$role->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label class="fw-bold">Role Name</label>
                        <input class="form-control" value="{{ $role->name }}" name="name" type="text" placeholder="Role Name">
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label class="fw-bold">Permissions</label>
                        <br>
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <th class="text-center"> Permission Name </th> <th class="text-center"> Access </th>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr v-for="(permission, index) in permissions">
                                    <td>
                                        @if (str_contains('{{ $permission->name }}', 'index'))
                                        <div>
                                            <strong>
                                                <label class="form-check-label" for="{{ $permission->name }}">{{ $permission->name }}</label>
                                            </strong>
                                        </div>
                                        @else
                                        <div>
                                            <label class="form-check-label" for="{{ $permission->name }}">{{ $permission->name }}</label>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" id="{{ $permission->name }}" name="permissions[]" @if(in_array($permission->id, $permission_array)) checked @endif>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-primary shadow-sm rounded-sm" type="submit">UPDATE</button>
                            <button class="btn btn-warning shadow-sm rounded-sm ms-3" type="reset">RESET</button>
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
        @include('layouts.footers.auth.footer')
    </div>
@endsection
