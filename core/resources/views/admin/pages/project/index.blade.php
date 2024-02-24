@extends('admin.layout')

@section('title')
    All Project
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Project</li>
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
                    @include('admin.pages.project._menu')
                </div>
                <div class="card-body p-2">
                    @include('admin.shared.alert-template')
                    <form action="{{ route('admin/project/index') }}" method="get" class="mb-3 mt-2">
                        <div class="row g-1">
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="project_name"
                                       id="project_name" value="{{ request()->input('project_name') }}"
                                       placeholder="Project Name">
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm" name="client_id" id="client_id">
                                    <option value="">-- All Client --</option>
                                    @foreach($clients as $row)
                                        <option value="{{ $row->id }}" {{ request()->input('client_id') == $row->id ? 'selected' : ''}}>{{ $row->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" name="priority" id="priority">
                                    <option value="">-- All Priority --</option>
                                    @foreach(\App\Constants\Priority::GetPriorities() as $value => $type)
                                        <option value="{{ $value }}" {{ request()->input('priority') == $value ? 'selected' : ''}}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" name="status" id="pr_status">
                                    <option value="">-- All Status --</option>
                                    @foreach(\App\Constants\ProjectStatus::GetStatuses() as $value => $type)
                                        <option value="{{ $value }}" {{ request()->input('status') == $value ? 'selected' : ''}}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        @foreach($rows as $row)
                            <div class="col-xxl-3 col-md-4 col-sm-6 project-card">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="p-3 mt-n3 mx-n3 bg-info-subtle rounded-top">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    <h5 class="mb-1 fs-14">
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_OVERVIEW)
                                                        <a href="{{ route('admin/project/overview', ['id' => $row->id]) }}"
                                                           class="text-body">{{ $row->project_name }}</a>
                                                        @else
                                                            {{ $row->project_name }}
                                                        @endcan
                                                    </h5>
                                                    <p class="text-muted mb-0">
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_ALL)
                                                        <a href="{{ route('admin/client/index', ['name' => $row->client_name]) }}"
                                                           target="_blank">{{ $row->client_name }}
                                                            , {{ $row->client_address }}</a>
                                                        @else
                                                            {{ $row->client_name }}
                                                            , {{ $row->client_address }}
                                                        @endcan
                                                    </p>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div class="d-flex gap-1 align-items-center my-n2">
                                                        @if($row->status != \App\Constants\ProjectStatus::CANCELED)
                                                            <div class="dropdown">
                                                                <button class="btn btn-link text-muted p-1 mt-n1 py-0 text-decoration-none fs-15"
                                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="true">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                         height="24" viewBox="0 0 24 24" fill="none"
                                                                         stroke="currentColor" stroke-width="2"
                                                                         stroke-linecap="round" stroke-linejoin="round"
                                                                         class="feather feather-more-horizontal icon-sm">
                                                                        <circle cx="12" cy="12" r="1"></circle>
                                                                        <circle cx="19" cy="12" r="1"></circle>
                                                                        <circle cx="5" cy="12" r="1"></circle>
                                                                    </svg>
                                                                </button>

                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_OVERVIEW)
                                                                    <a class="dropdown-item"
                                                                       href="{{ route('admin/project/overview', ['id'=> $row->id]) }}"><i
                                                                                class="ri-eye-fill align-bottom me-2 text-muted"></i>Overview</a>
                                                                    @endcan
                                                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_EDIT)
                                                                    <a class="dropdown-item"
                                                                       href="{{ route('admin/project/edit', ['id' => $row->id]) }}"><i
                                                                                class="ri-pencil-fill align-bottom me-2 text-muted"></i>Edit</a>
                                                                    @endcan
                                                                    <div class="dropdown-divider"></div>
                                                                    <form action="{{ route('admin/project/cancel', ['id' => $row->id]) }}"
                                                                          id="cancel_form_{{ $row->id }}" method="post">
                                                                        @csrf
                                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_CANCEL)
                                                                        <button class="dropdown-item" type="button"
                                                                                onclick="common.confirmAlertForForm('#cancel_form_{{ $row->id }}', 'Are you sure want to cancel?')">
                                                                            <i class="ri-close-line align-bottom me-2 text-muted"></i>Cancel
                                                                        </button>
                                                                        @endcan
                                                                    </form>
                                                                    <form action="{{ route('admin/project/remove', ['id' => $row->id]) }}"
                                                                          id="remove_form_{{ $row->id }}" method="post">
                                                                        @csrf
                                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_REMOVE)
                                                                        <button type="button" class="dropdown-item"
                                                                                onclick="common.confirmAlertForForm('#remove_form_{{ $row->id }}', 'Are you sure want to remove?')">
                                                                            <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Remove
                                                                        </button>
                                                                        @endcan
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="py-3">
                                            <div class="row gy-3">
                                                <div class="col-3">
                                                    <div>
                                                        <p class="text-muted mb-1">Status</p>
                                                        <div class="badge {{ \App\Constants\ProjectStatus::GetColorClassName($row->status) }} fs-12 dropdown">
                                                            <span type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                            {{ \App\Constants\ProjectStatus::ConvertNumberToText($row->status) }}
                                                            </span>
                                                            <ul class="dropdown-menu dropdown-menu-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(119px, -653px);" data-popper-placement="top-start">

                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="project.chngeProjectStatus('{{ route('admin/project/status', [$row->id]) }}', 1)">
                                                                        <i class="ri-radio-button-line me-2 align-bottom text-secondary"></i>
                                                                        NEW
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="project.chngeProjectStatus('{{ route('admin/project/status', [$row->id]) }}', 2)">
                                                                        <i class="ri-radio-button-line me-2 align-bottom text-warning"></i>
                                                                        IN PROGRESS
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="dropdown-item" href="javascript:void(0);" onclick="project.chngeProjectStatus('{{ route('admin/project/status', [$row->id]) }}', 3)">
                                                                        <i class="ri-radio-button-line me-2 align-bottom text-success"></i>
                                                                        COMPLETE
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div>
                                                        <p class="text-muted mb-1 text-nowrap">Priority</p>
                                                        <div class="badge {{ \App\Constants\Priority::GetColorName($row->priority) }} fs-12">{{ \App\Constants\Priority::ConvertNumberToText($row->priority) }}</div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div>
                                                        <h5 class="text-muted mb-1 fs-14">
                                                            Target: {{ \App\Utility\Helpers::ConvertDateFormat($row->target) }}</h5>
                                                        <h5 class="text-muted fs-14">
                                                            Deadline: {{ \App\Utility\Helpers::ConvertDateFormat($row->deadline) }}</h5>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex align-items-center mt-3">
                                                <p class="text-muted mb-0 me-2">Team :</p>
                                                <div class="avatar-group">
                                                    @foreach($row->teams as $member)
                                                        <a href="javascript: void(0);" class="avatar-group-item"
                                                           data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                           data-bs-placement="top"
                                                           data-bs-original-title="{{ $member->name }}">
                                                            <div class="avatar-xxs">
                                                                @if($member->photo == 'uploads/users/photo/default.png')
                                                                    <div class="avatar-title rounded-circle bg-primary">
                                                                        {{ \App\Utility\Helpers::GetFirstChar($member->name) }}
                                                                    </div>
                                                                @else
                                                                    <img src="{{ asset($member->photo) }}" alt=""
                                                                         class="rounded-circle img-fluid">
                                                                @endif
                                                            </div>
                                                        </a>
                                                    @endforeach
                                                    <a href="{{ route('admin/project/team/index', ['id' => $row->id]) }}"
                                                       target="_blank" class="avatar-group-item"
                                                       data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                       data-bs-placement="top" data-bs-original-title="View">
                                                        <div class="avatar-xxs">
                                                            <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                                <i class="bx bx-list-check"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mt-3">
                                                <p class="text-muted mb-0 me-2">Tasks: <a target="_blank" href="{{ route('admin/project/task/index', ['id'=> $row->id]) }}?v=l">{{ ProjectTaskHelper::getCompleteTaskByUser(0, $row->id) }}/{{ ProjectTaskHelper::getTotalTaskByUser(0, $row->id) }}</a></p>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="d-flex mb-2">
                                                <div class="flex-grow-1">
                                                    <div>Progress</div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <div>{{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser(0, $row->id) }}%</div>
                                                </div>
                                            </div>
                                            <div class="progress progress-sm animated-progress">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                     aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"
                                                     style="width: {{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser(0, $row->id) }}%;">
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mt-3">
                                                <p class="text-muted mb-0 me-2">Documents:
                                                    @foreach($row->documents as $i => $document)
                                                        <a href="javascript:void(0)" onclick="common.openFileViewModel('{{ asset($document->file_path) }}', '{{ $document->document_name }}')">{{ $document->document_name }}</a>{{ $i != count($row->documents) - 1 ? ',' : ' ' }}
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                {{ $rows->links() }}
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ asset('core/resources/js/Project.js') }}"></script>
    <script>
        const project = new Project();
    </script>
@endsection
