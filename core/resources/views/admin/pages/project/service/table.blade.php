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
                        <li>
                        @endcan
                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_ADD)
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

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm fs-14 table-borderless table-hover table-striped">
                            <thead class="text-muted fs-12">
                            <tr class="table-light">
                                <th>SERVICE</th>
                                <th>DEPARTMENT</th>
                                <th>HOURS</th>
                                <th>TASKS</th>
                                <th>TEAM MEMBERS</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td class="align-middle">
                                        <a href="#" class="me-2">{{ $service->service_name }}</a>
                                    </td>
                                    <td>{{ $service->department_name }}</td>
                                    <td>{{ ProjectTaskHelper::tasksByDepartmentServiceId($service->id, \App\Constants\TaskStatus::COMPlETE, $service->project_id, 'hour') }}/{{ $service->total_hour }}</td>
                                    <td class="d-inline-flex">
                                        <div class="progress progress-sm my-2" style="width: 100px;">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ \App\Utility\ProjectTaskHelper::taskCompleteRatioByDepartmentServiceId($service->id, $service->project_id) }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        {{ ProjectTaskHelper::tasksByDepartmentServiceId($service->id , \App\Constants\TaskStatus::COMPlETE, $service->project_id) }}/{{ \App\Utility\ProjectTaskHelper::tasksByDepartmentServiceId($service->id,0, $service->project_id) }}
                                    </td>
                                    <td>
                                        <div class="avatar-group">
                                            @foreach(ProjectTaskHelper::teamMemberbyDepartmentService($service->id) as $member)
                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="{{ $member->name }}" data-bs-original-title="{{ $member->name }}">
                                                    <img src="{{ asset($member->photo) }}" alt="" class="rounded-circle avatar-xxs">
                                                </a>
                                            @endforeach
                                        </div>
                                    </td>

                                    <td class="text-center">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="ri-more-fill fs-17"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-eye-outline"></i> Details</a>
                                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_EDIT)
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-pencil-outline"></i> Edit</a>
                                            @endcan
                                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_DELETE)
                                            <a class="dropdown-item" href="#"><i class="mdi mdi-trash-can-outline"></i> Delete</a>
                                            @endcan
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
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
