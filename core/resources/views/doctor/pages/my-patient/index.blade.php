@extends('doctor.layout')

@section('title') My Patient @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">My Patient</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Patient</li>
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
                <div class="card-header p-3">
                    <form action="">
                        <div class="row g-1">
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" placeholder="MRN">
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" placeholder="Patient name">
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" placeholder="Mobile">
                            </div>
                            <div class="col">
                                <input class="form-control form-control-sm" type="text" placeholder="Email">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-sm btn-light">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-3">
                    <div class="">
                        <table class="table table-sm table-nowrap mb-0 table-bordered">
                            <thead class="table-light">
                            <tr>
                                <th scope="col" class="text-center">#SL</th>
                                <th scope="col" class="text-center">MRN</th>
                                <th scope="col">Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Age</th>
                                <th scope="col">Address</th>
                                <th scope="col">Mobile</th>
                                <th scope="col">Last Treatment Date</th>
                                <th scope="col" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="fw-medium text-center">1</td>
                                <td class="text-center"><a href="{{ route('doctor/myPatient/details', ['id'=>1]) }}">20231</a></td>
                                <td><a href="{{ route('doctor/myPatient/details', ['id'=>1]) }}">Umme Umara</a></td>
                                <td>Female</td>
                                <td>3.5 Y</td>
                                <td>S#5, R#5/A, H#19, Dhaka</td>
                                <td>01729018639</td>
                                <td>10/10/2022</td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <a class="text-reset dropdown-btn show" href="#" data-bs-toggle="dropdown">
                                            <span class="text-muted fs-18"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 42px, 0px);">
                                            <a class="dropdown-item" href="{{ route('doctor/myPatient/details', ['id'=>1]) }}">Details</a>
                                            <a class="dropdown-item" href="#">Last Prescription</a>
                                            <a class="dropdown-item" href="#">New Prescription</a>
                                            <a class="dropdown-item" href="#">Previous Prescriptions</a>
                                            <a class="dropdown-item" href="#">Test Reports</a>
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
