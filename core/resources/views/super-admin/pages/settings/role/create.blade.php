@extends('super-admin.layout')

@section('title') Create New Role @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Create New Role</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('sa/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('settings/role/index') }}">All Role</a></li>
                        <li class="breadcrumb-item active">User Role</li>
                        <li class="breadcrumb-item active">Create New Role</li>
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
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{ route('settings/role/store') }}" method="post">
                                @csrf
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="agency_name" class="form-label float-end">Role Name<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-sm @error('role_name') is-invalid @enderror" id="role_name" name="role_name" required value="{{ old('role_name') }}">
                                        @error('role_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-soft-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
