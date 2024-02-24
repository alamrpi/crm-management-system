@extends('doctor.layout')

@section('title') Patient Test Reports @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 text-primary">Patient Test Reports</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Patient</li>
                        <li class="breadcrumb-item active">Test Reports</li>
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
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0 table-bordered table-sm">
                                        <thead class="table-light">
                                        <tr>
                                            <th scope="col" class="text-center">#SL</th>
                                            <th scope="col" class="text-nowrap">Test Name</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">LAB</th>
                                            <th scope="col">Report Details</th>
                                            <th scope="col" class="text-center">View</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>USG</td>
                                            <td class="text-nowrap">Oct 15, 2021</td>
                                            <td>Popular Diagnostic Center, Uttara Branch</td>
                                            <td>It will be as simple as occidental in fact, it will be Occidental. To an English person, it will seem like simplified English, as a skeptical Cambridge friend of mine told me what Occidental is</td>
                                            <td class="text-center"><a href="#"><i class="ri-eye-fill align-bottom"></i></a></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
@endsection
