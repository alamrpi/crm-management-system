@extends('doctor.layout')

@section('title') All Degree @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">All Degree</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                        <li class="breadcrumb-item active">Degree</li>
                        <li class="breadcrumb-item active">All Degree</li>
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
                            <a class="nav-link" href="{{ route('doctor/degree/index') }}">
                                <i class="fas fa-home"></i>
                                All Degree
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('doctor/degree/add') }}">
                                <i class="far fa-user"></i>
                                Add Degree
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="">
                        <table class="table table-sm table-nowrap mb-0 table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#SL</th>
                                <th scope="col">Degree</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="fw-medium text-center">01</td>
                                <td>Implement new UX</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="text-reset dropdown-btn show" href="#" data-bs-toggle="dropdown">
                                            <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 42px, 0px);">
                                            <a class="dropdown-item" href="#">Edit</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
