@extends('client.layout')

@section('title') All Project @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">All Project</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('clientarea/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Project</li>
                        <li class="breadcrumb-item active">All Project</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            @include('client.shared._message')
            <div class="card">
                <div class="card-header p-2">
                    <form action="{{ route('admin/department/index') }}" method="get">
                        <div class="row g-1">
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ request()->input('name') }}" placeholder="Project Name">
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" name="" id="">
                                    <option value="">-- Status --</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-soft-primary btn-sm waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        @for($i=0; $i<12; $i++)
                            <div class="col-xxl-3 col-sm-6 project-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-3 mt-n3 mx-n3 bg-info-subtle rounded-top">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1 fs-14"><a href="{{ route('clientarea/project/workStatus', ['slug'=>'project-name']) }}" class="text-body">Multipurpose landing template</a></h5>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="d-flex gap-1 align-items-center my-n2">
                                                        <div class="dropdown">
                                                            <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                            </button>

                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item" href="{{ route('clientarea/project/workStatus', ['slug'=>'project-name']) }}"><i class=" ri-line-chart-line align-bottom me-2 text-muted"></i>Work Status</a>
                                                                <a class="dropdown-item" href="#"><i class="ri-pencil-fill align-bottom me-2 text-muted"></i>Edit</a>
                                                                <div class="dropdown-divider"></div>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-close-line align-bottom me-2 text-muted"></i>Cancel</a>
                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#removeProjectModal"><i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="py-3">
                                            <div class="row gy-3">
                                                <div class="col-3">
                                                    <div>
                                                        <p class="text-muted mb-1">Status</p>
                                                        <div class="badge bg-warning-subtle text-warning fs-12">Inprogress</div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div>
                                                        <p class="text-muted mb-1">Priority</p>
                                                        <div class="badge bg-danger-subtle text-danger fs-12">High</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        <h5 class="text-muted fs-14">Deadline: 30 Nov, 2023</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mt-3">
                                                <p class="text-muted mb-0 me-2">Team :</p>
                                                <div class="avatar-group">
                                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Donna Kline">
                                                        <div class="avatar-xxs">
                                                            <div class="avatar-title rounded-circle bg-primary">
                                                                D
                                                            </div>
                                                        </div>
                                                    </a>
                                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Lee Winton" data-bs-original-title="Lee Winton">
                                                        <div class="avatar-xxs">
                                                            <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </a>
                                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Johnny Shorter" data-bs-original-title="Johnny Shorter">
                                                        <div class="avatar-xxs">
                                                            <img src="{{ asset('assets/images/users/avatar-6.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </a>
                                                    <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" data-bs-original-title="Add Members">
                                                        <div class="avatar-xxs">
                                                            <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                                +
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mt-3">
                                                <p class="text-muted mb-0 me-2">Tasks: <a href="#">11/45</a></p>
                                            </div>

                                        </div>
                                        <div>
                                            <div class="d-flex mb-2">
                                                <div class="flex-grow-1">
                                                    <div>Progress</div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div>50%</div>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm animated-progress">
                                                <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mt-3">
                                                <p class="text-muted mb-0 me-2">Documents: <a href="#">File1</a>, <a href="#">File2</a>, <a href="#">File3</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>


                </div>
                <div class="card-footer text-center">
                    <ul class="pagination pagination-separated justify-content-center mb-sm-0">
                        <li class="page-item disabled">
                            <a href="#" class="page-link">Previous</a>
                        </li>
                        <li class="page-item active">
                            <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item ">
                            <a href="#" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">4</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">5</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">Next</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
