@extends('doctor.layout')

@section('title') Add Chamber @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add Chamber</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                        <li class="breadcrumb-item active">Chamber</li>
                        <li class="breadcrumb-item active">Add Chamber</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-3">
            @include('doctor.pages.my-account._menu')
        </div>
        <div class="col-sm-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('doctor/chamber/index') }}">
                                <i class="fas fa-home"></i>
                                All Chamber
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('doctor/chamber/add') }}">
                                <i class="far fa-user"></i>
                                Add Chamber
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phonenumberInput" class="form-label">Chamber Type</label>
                                <select class="form-select" name="role">
                                    <option value="">-- Select --</option>
                                    <option value="own">Own Chamber</option>
                                    <option value="cum">Chamber Under Medical</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Chamber Name</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Address</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>

                            <div class="mb-3">
                                <label for="phonenumberInput" class="form-label">Medical</label>
                                <select class="form-select" name="role">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Mobile/Hotline (<small>For Serial</small>)</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>

                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
