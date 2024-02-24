@extends('doctor.layout')

@section('title') Register New Patient @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Register New Patient</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Patient</li>
                        <li class="breadcrumb-item active">Register New Patient</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-3">
            @include('doctor.pages.my-patient._menu')
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Patient Name</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>
                            <div class="mb-3">
                                <label for="phonenumberInput" class="form-label">Gender</label>
                                <select class="form-select" name="role">
                                    <option value="">-- Select --</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Age (Year)</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Address</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Email</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="firstnameInput">
                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Drug History</label>
                                <input type="text" class="form-control" id="firstnameInput">
                                <div class="form-text">Separate each drug by comma (,) </div>
                            </div>

                            <div class="mb-3">
                                <label for="firstnameInput" class="form-label">Disease History</label>
                                <input type="text" class="form-control" id="firstnameInput">
                                <div class="form-text">Separate each disease by comma (,) </div>
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
