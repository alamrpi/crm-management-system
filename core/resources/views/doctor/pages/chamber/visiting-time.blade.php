@extends('doctor.layout')

@section('title') Visiting Time @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">All Chamber</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                        <li class="breadcrumb-item active">Chamber</li>
                        <li class="breadcrumb-item active">All Chamber</li>
                        <li class="breadcrumb-item active">Visiting Time</li>
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
                        <li class="nav-item">
                            <a class="nav-link active">
                                <i class="far fa-user"></i>
                                Visiting Time (Elahi Homeo Healing Center)
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">

                    <form action="">
                        <div class="row">
                            <div class="col">
                                <select class="form-select">
                                    <option value="">-- Select --</option>
                                    <option value="Sat">Sat</option>
                                    <option value="Sun">Sun</option>
                                    <option value="Mon">Mon</option>
                                    <option value="Tue">Tue</option>
                                    <option value="Wed">Wed</option>
                                    <option value="Thu">Thu</option>
                                    <option value="Fri">Fri</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input type="time" class="form-control" id="exampleInputtime">
                                    <span class="input-group-text">To</span>
                                    <input type="time" class="form-control" id="exampleInputtime">
                                </div>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </form>

                    <br>

                    <div class="">
                        <table class="table table-sm table-nowrap mb-0 table-bordered">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">#SL</th>
                                <th scope="col">Day</th>
                                <th scope="col">Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="fw-medium text-center">1</td>
                                <td>Sat</td>
                                <td>
                                    <table class="table table-sm table-nowrap mb-0">
                                        <tr>
                                            <td>10:00 AM - 12:00 PM</td>
                                            <td>
                                                <a href=""><span class="badge border border-primary text-primary">Edit</span></a> |
                                                <a href=""><span class="badge border border-danger text-danger">Delete</span></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>04:00 PM - 09:00 PM</td>
                                            <td>
                                                <a href=""><span class="badge border border-primary text-primary">Edit</span></a> |
                                                <a href=""><span class="badge border border-danger text-danger">Delete</span></a>
                                            </td>
                                        </tr>
                                    </table>
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
