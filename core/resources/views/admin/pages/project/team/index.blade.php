@extends('admin.layout')

@section('title') Team - Project Name @endsection

@section('content')

    <!-- end page title -->

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
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <form action="{{ route('admin/project/team/index', ['id'=>$project_id]) }}" method="get">
                                <div class="row g-2 mb-3">
                                    <div class="col">
                                        <div class="position-relative">
                                            <input type="text" class="form-control form-control-sm" name="emp_name" placeholder="Search member" value="{{ request()->input('emp_name') }}">
                                        </div>
                                    </div><!-- end col -->
                                    <div class="col">
                                        <select name="employee_type_id" id="" class="form-select form-select-sm">
                                            <option>All</option>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->employee_type }}" {{ $role->employee_type==request()->input('employee_type_id') ? 'selectd' : '' }}> {{ \App\Constants\EmployeeTypes::ConvertNumberToText($role->employee_type) }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-auto">
                                        <button type="submit" class="btn btn-sm btn-success"><span class="d-none d-sm-inline-block me-2"><i class="ri-filter-3-line align-bottom"></i> Filter</span></button>
                                    </div><!-- end col -->
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6">
                            <div class="text-end">
                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TEAM_ASSIGN_MEMBER)
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#teamAdd"><i class="ri-add-line align-bottom"></i> Assign Member</button>
                                @endcan
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive table-card">
                        <table class="table table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" style="width: 80px;">Photo</th>
                                <th scope="col">Member</th>
                                <th scope="col">Department</th>
                                <th scope="col">
                                    Tasks
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Completed Tasks / Total Tasks" data-bs-placement="top">
                                      <sup><i class="las la-info"></i></sup>
                                    </span>
                                </th>
                                <th scope="col">
                                    Hours
                                    <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Completed Hours / Total Hours" data-bs-placement="top">
                                      <sup><i class="las la-info"></i></sup>
                                    </span>
                                </th>
                                <th scope="col" style="width: 200px;">Status</th>
                                <th class="text-center">Favourite</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($teams as $team)
                                <tr>
                                    <td><img src="{{ asset($team->photo) }}" alt="Photo" class="avatar-xs rounded-3 me-2"></td>
                                    <td>
                                        <div>
                                            <h5 class="fs-13 mb-0"><a href="{{ route('admin/employee/details', ['id'=>$team->user_id]) }}" target="_blank">{{ $team->name }}</a></h5>
                                            <p class="fs-12 mb-0 text-muted">{{ $team->designation }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $team->dept_name }}
                                    </td>
                                    <td>
                                        {{ ProjectTaskHelper::getCompleteTaskByUser($team->user_id, $project_id) }} / {{ ProjectTaskHelper::getTotalTaskByUser($team->user_id, $project_id) }}
                                    </td>
                                    <td>{{ ProjectTaskHelper::getCompleteTaskByUser($team->user_id, $project_id, 'hour') }} / {{ ProjectTaskHelper::getTotalTaskByUser($team->user_id, $project_id, 'hour') }} Hrs</td>
                                    <td>
                                        <div class="progress" style="height: 25px; border-radius: 15px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser($team->user_id, $project_id,) }}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser($team->user_id, $project_id,) }}%</div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn fs-16 p-0 favourite-btn">
                                            <i class="ri-star-fill"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="ri-more-fill fs-17"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" style="">
                                            <li><a class="dropdown-item" href="{{ route('admin/employee/details', ['id'=>$team->user_id]) }}" target="_blank"><i class="ri-eye-fill text-muted me-2 align-bottom"></i>View Profile</a></li>
                                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TEAM_ACTIVITIES)
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);"><i class="ri-history-line text-muted me-2 align-bottom"></i>Activities</a>
                                            </li>
                                            @endcan
                                            @if(ProjectTaskHelper::getTotalTaskByUser($team->user_id, $project_id) == 0)
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TEAM_REMOVE)
                                                <li>
                                                    <form action="{{ route('admin/project/team/remove-member', ['id'=>$project_id,'access_id'=>$team->id]) }}" method="post" id="remove-momber-form-{{ $team->id }}">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="button" class="dropdown-item" href="javascript:void(0);" onclick="common.confirmAlertForForm('#remove-momber-form-{{ $team->id }}')"><i class="ri-delete-bin-5-fill text-muted me-2 align-bottom"></i>Remove</button>
                                                    </form>
                                                </li>
                                                @endcan
                                            @endif
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row g-0 text-center text-sm-start align-items-center mt-4">
                        <div class="col-sm-6">
                            <div>
                                <p class="mb-sm-0"><div class="text-muted">Showing <span class="fw-semibold">{{ $teams->firstItem() }} - {{ $teams->lastItem() }}</span> of <span class="fw-semibold">{{ $teams->total() }}</span> Members
                                </div></p>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            {{ $teams->links() }}
                        </div><!-- end col -->
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="modal" id="teamAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="teamAddLabel" aria-hidden="true">
        @include('admin.pages.project.team.add')
    </div>

@endsection

@section('script')
    <script src="{{ asset('core/resources/js/Project.js') }}"></script>
    <script>
        const project = new Project();
    </script>
@endsection
