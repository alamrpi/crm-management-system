@extends('super-admin.layout')

@section('title') Create New Agency @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Create New Agency</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('sa/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sa/agency/index') }}">Agency</a></li>
                        <li class="breadcrumb-item active">Create Agency Admin</li>
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
                            <a class="nav-link" href="{{ route('sa/agency/index') }}">
                                <i class="fas fa-home"></i>
                                All Agency
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sa/agency/createAdmin', ['id' => $agency->id]) }}">
                                <i class="far fa-user"></i>
                                Create Agency Admin
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-9">
                            <form action="{{ route('sa/agency/storeAdmin', ['id' => $agency->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label float-end">Name<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name') }}">
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="email" class="form-label float-end">Email<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email') }}">
                                        @error('email')
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
