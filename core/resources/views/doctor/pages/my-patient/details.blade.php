@extends('doctor.layout')

@section('title') Patient Details @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 text-primary">Patient Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Patient</li>
                        <li class="breadcrumb-item active">Patient Details</li>
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
                    <div class="card-head bg-primary-subtle p-3 pb-0">
                        <div class="row mb-3">
                            <div class="col-md">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-auto">
                                        <div class="avatar-md">
                                            <div class="avatar-title bg-white rounded-circle">
                                                <img src="{{ asset('assets/images/brands/slack.png') }}" alt="" class="avatar-xs">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div>
                                            <h4 class="fw-bold">Umme Umara</h4>
                                            <div class="hstack gap-3 flex-wrap">
                                                <div>Female</div>
                                                <div class="vr"></div>
                                                <div>3.5 Y</div>
                                                <div class="vr"></div>
                                                <div>S#5, R#5/A, H#19, Dhaka</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @include('doctor.pages.my-patient._details-menu')

                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">MRN :</th>
                                                    <td class="text-muted">20231</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Patient Name :</th>
                                                    <td class="text-muted">Umme Umara</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Gender :</th>
                                                    <td class="text-muted">Female</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Age :</th>
                                                    <td class="text-muted">3.5 Y</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Address :</th>
                                                    <td class="text-muted">S#5, R#5/A, H#19, Dhaka</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Email :</th>
                                                    <td class="text-muted">ummeumara@gmail.com</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Mobile :</th>
                                                    <td class="text-muted">01729018639</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Drug History :</th>
                                                    <td class="text-muted">
                                                        <span class="badge bg-primary-subtle text-primary">Drug1</span>
                                                        <span class="badge bg-primary-subtle text-primary">Drug2</span>
                                                        <span class="badge bg-primary-subtle text-primary">Drug3</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Disease History :</th>
                                                    <td class="text-muted">
                                                        <span class="badge bg-danger-subtle text-danger">Disease1</span>
                                                        <span class="badge bg-danger-subtle text-danger">Disease2</span>
                                                        <span class="badge bg-danger-subtle text-danger">Disease3</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">Last Treatment Date :</th>
                                                    <td class="text-muted">10/10/2022</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
@endsection
