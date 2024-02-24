@extends('admin.layout')

@section('title') Service - Project Name @endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body pb-0 px-4">
                    <x-pr-top-view/>
                    @include('admin.pages.project._details-menu')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('admin.shared.alert-template')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-2">

            <div class="align-items-center d-flex">
                <div class="flex-grow-1 show">
                    <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav">
                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_ALL)
                        <li class="nav-item">
                            <a class="nav-link fw-semibold" href="{{ route('admin/project/service/gridView', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
                                <i class="ri-layout-grid-fill mt-1 position-relative" style="top: 2px;"></i> Grid
                            </a>
                        </li>
                        <li>
                            <a class="nav-link fw-semibold" href="{{ route('admin/project/service/tableView', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
                                <i class="ri-table-2 mt-1 position-relative" style="top: 2px;"></i> Table
                            </a>
                        </li>
                        @endcan
                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_ADD)
                        <li>
                            <a class="nav-link fw-semibold" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#serviceAdd">
                                <i class="ri-add-box-line mt-1 position-relative" style="top: 2px;"></i> Add Service
                            </a>
                        </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="row gy-2 gx-3">
        @foreach($services->groupBy('department_id') as $services)
        <div class="col-sm-4">
            <div class="card mb-1">
                <div class="card-body">
                    <a class="d-flex align-items-center collapsed" data-bs-toggle="collapse" href="#needsIdentified{{ $services[0]->id }}" role="button" aria-expanded="false" aria-controls="needsIdentified3">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('assets/images/brands/dribbble.png') }}" alt="" class="avatar-sm rounded-circle">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fs-14 mb-1">{{ $services[0]->department_name }}</h6>
                            <span class="text-muted fs-12" style="left: 170px;position: absolute;top: 18px;">{{ ProjectTaskHelper::tasksByDepartmentId($services[0]->department_id, \App\Constants\TaskStatus::COMPlETE, $services[0]->project_id) }} /{{ ProjectTaskHelper::tasksByDepartmentId($services[0]->department_id, 0,  $services[0]->project_id) }}</span>
                            <div class="progress progress-sm my-2" style="width: 100px;">
                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ \App\Utility\ProjectTaskHelper::taskCompleteRatioByDepartmentId($services[0]->department_id,  $services[0]->project_id) }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="text-muted mb-0">Total {{ $services->sum('total_hour') }} Hours</p>
                        </div>
                    </a>
                </div>
                <div class="border-top border-top-dashed collapse show" id="needsIdentified{{ $services[0]->id }}" style="">
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 mb-0">
                            @foreach($services as $service)
                            <li>
                                <div class="d-flex">
                                    <div class="flex-shrink-0 avatar-xxs text-muted">
                                        <i class="ri-shopping-bag-3-line"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="align-items-center d-flex">
                                            <h6 class="mb-0 flex-grow-1">
                                                {{ $service->service_name }}
                                                <br>
                                                <small class="text-muted">{{ $service->total_hour }} Hours</small>
                                            </h6>
                                            <div class="flex-shrink-0">
                                                <div class="dropdown">
                                                    <a class="text-reset dropdown-btn show" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <span class="text-muted fs-16"><i class="mdi mdi-dots-horizontal align-middle"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end" data-popper-placement="top-end" style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(0px, -41px);">
                                                        <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i> Details</a>
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_EDIT)
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-pencil-outline"></i> Edit</a>
                                                        @endcan
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_DELETE)
                                                            <a class="dropdown-item" href="#"><i class="mdi mdi-trash-can-outline"></i> Delete</a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
{{--                    <div class="card-footer hstack gap-2">--}}
{{--                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_ADD)--}}
{{--                        <button class="btn btn-soft-success btn-sm w-100"><i class="ri-add-line align-bottom me-1"></i> Add Service</button>--}}
{{--                        @endcan--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal -->
    <div class="modal fade" id="serviceAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="serviceAddLabel" aria-hidden="true">
        @include('admin.pages.project.service.add')
    </div>
@endsection

@section('script')
    <script src="{{ asset('core/resources/js/Project.js') }}"></script>
    <script>
        const project = new Project();
    </script>
@endsection

@section('styles')
    <style>
        .custom-sub-nav .nav-link {
            color: #2A2E34;
            border-radius: 6px;
            padding: 0 6px 6px 6px;
            margin-right: 10px;
        }
        .custom-sub-nav .nav-item:hover .custom-sub-nav .nav-item .nav-link {
            color: red;
            background: #e9ebec;
        }
        .custom-sub-nav .nav-item .nav-link.active {
            color: #2A2E34;
            background: transparent;
        }
    </style>
@endsection
