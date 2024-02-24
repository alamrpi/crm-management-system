@extends('admin.layout')

@section('title') Change Password @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Change Password</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @include('admin.pages.my-account._menu')
                </div>
                <div class="card-body p-2">
                    @include('admin.shared.alert-template')
                    <div class="col-md-8 mx-auto">
                        <div class="border p-4 rounded">
                            <form action="{{ route('admin/changePassword/update') }}" method="post" class="wid">
                                @csrf
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label float-end">Old Password <span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control form-control-sm" id="current_password" name="current_password" required>
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="email" class="form-label float-end">New Password <span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control form-control-sm" id="new_password" name="new_password" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="photo" class="form-label float-end">Confirm Password <span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="password" class="form-control form-control-sm" id="new_password_confirmation" name="new_password_confirmation" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-11">
                                        <button type="submit" class="btn btn-primary btn-sm float-end">  <i class="ri ri-key-2-line"></i> Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
