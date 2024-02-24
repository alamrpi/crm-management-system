@extends('super-admin.layout')

@section('title') All Agency @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">All Agency</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('sa/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Agency</li>
                        <li class="breadcrumb-item"><a href="{{ route('sa/agency/index') }}">All Agency</a></li>
                        <li class="breadcrumb-item active">Details</li>
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
                            <a class="nav-link" href="{{ route('sa/agency/details', ['id' => $agency->id]) }}">
                                <i class="far fa-user"></i>
                                Agency Details
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="card-body p-2">

                </div>
            </div>
        </div>
    </div>
@endsection
