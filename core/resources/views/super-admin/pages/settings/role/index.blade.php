@extends('super-admin.layout')

@section('title') All Role @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">All Role</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('sa/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                        <li class="breadcrumb-item active">User Role</li>
                        <li class="breadcrumb-item active">All Role</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('settings/role/index') }}">
                                <i class="fas fa-home"></i>
                                All Role
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('settings/role/create') }}">
                                <i class="far fa-user"></i>
                                New Role
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="card-body p-2">
                    @include('super-admin.shared._message')
                    <form action="{{ route('settings/role/index') }}" method="get" class="mb-2 mt-3">
                        <div class="row g-1">
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="role_name" id="role_name" value="{{ request()->input('role_name') }}" placeholder="Role name...">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-soft-primary btn-sm waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-">
                        <table class="table table-borderless table-sm align-middle mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" class="text-center">#SL</th>
                                <th scope="col" class="text-center"><i class="mdi mdi-dots-vertical align-middle"></i></th>
                                <th scope="col">Role Name</th>
                                <th scope="col">Created Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown">
                                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('settings/role/edit', ['id' => $row->id]) }}">Edit</a>
                                                <a class="dropdown-item confirm-alert" href="{{ route('settings/role/delete', ['id' => $row->id]) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $row->role_name }}</td>
                                    <td>{{ date('d/m/y', strtotime($row->created_at)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    {{ $rows->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
