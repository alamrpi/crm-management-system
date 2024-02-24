@extends('doctor.layout')

@section('title') Professional Details @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Professional Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                        <li class="breadcrumb-item active">Professional Details</li>
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
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Dr Regi No</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Designation</label>
                                <input type="email" class="form-control" id="emailInput">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="phonenumberInput" class="form-label">Medical</label>
                                <select class="form-select" name="role">
                                    <option value="">-- Select --</option>
                                </select>
                            </div>
                        </div>
                        <!--end col-->

                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="websiteInput1" class="form-label">Specialist</label>
                                <input type="text" class="form-control" id="websiteInput1">
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
