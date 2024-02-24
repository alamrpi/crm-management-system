@extends('client.layout')

@section('title') Work Status - {{ $current_project['project_name'] }} @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Work Status -  {{ $current_project['project_name'] }} </h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('clientarea/project/dashboard', ['slug'=>$current_project['slug']]) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Project</li>
                        <li class="breadcrumb-item active">Work Status</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            @include('client.shared._message')

            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Time Overview</h4>
                                    <div id="project_task_hour_status_holder">
                                        <div class="w-100 d-flex justify-content-center align-items-center h-100">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-md-3">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <h4 class="card-title mb-0">Task Overview</h4>
                                    <div id="simple_pie_chartHolder">
                                        <div class="w-100 d-flex justify-content-center align-items-center h-100">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                        <div class="col-md-3">
                            <div class="card card-height-100">
                                <div class="card-body">
                                    <h4 class="card-title">Department Overview  <span class="badge bg-light text-dark">{{ $allTasks->groupBy('department_name')->count() }}</span></h4>

                                    <div class="vstack gap-2">
                                        @foreach($allTasks->groupBy('department_name') as $key => $department)
                                            <div class="form-check card-radio">
                                                <input id="listGroupRadioGrid1" name="listGroupRadioGrid" type="radio" class="form-check-input">
                                                <label class="form-check-label" for="listGroupRadioGrid1">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0">
                                                            <div class="avatar-xs">
                                                                <div class="avatar-title bg-info-subtle text-success fs-18 rounded">
                                                                    <img style="width: 100%;height: auto;padding: 5px;" src="{{ asset('uploads/department/icon/wb_20231104_9250ed8a-21f8-4ce4-8b39-a82ba19c11bc.png') }}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="mb-1">{{ $key }}</h6>
                                                            <div class="progress" style="height: 16px;border-radius: 8px;">
                                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ round(ProjectTaskHelper::getCompletedTasksByDepartmentId($department[0]->department_id, \App\Constants\TaskStatus::COMPlETE) / $department->count() * 100 , 2, PHP_ROUND_HALF_DOWN) }}%;" aria-valuenow="{{ round(ProjectTaskHelper::getCompletedTasksByDepartmentId($department[0]->department_id, \App\Constants\TaskStatus::COMPlETE) / $department->count() * 100 , 2, PHP_ROUND_HALF_DOWN) }}" aria-valuemin="0" aria-valuemax="100">{{ round(ProjectTaskHelper::getCompletedTasksByDepartmentId($department[0]->department_id, \App\Constants\TaskStatus::COMPlETE) / $department->count() * 100 , 2, PHP_ROUND_HALF_DOWN) }}%</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                        @endforeach
                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                    </div>
                        <div class="col-md-3">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Project Summary</h4>
                                </div>
                                <div class="card-body fs-12">
                                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">ID: <span class="text-muted"> {{ $current_project['id'] }} </span></h5>

                                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Project Name: <span class="text-muted"> {{ $current_project['project_name'] }} </span></h5>

                                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Tasks: <span class="text-muted">{{ ProjectTaskHelper::getTasksByProjectId($current_project['id'], \App\Constants\TaskStatus::COMPlETE)->count() }} / {{ ProjectTaskHelper::getTasksByProjectId($current_project['id'])->count() }}</span></h5>

                                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Hours: <span class="text-muted">{{ ProjectTaskHelper::getCompleteTaskByUser(0, $current_project['id'], 'hour') }} / {{ ProjectTaskHelper::getTotalTaskByUser(0, $current_project['id'], 'hour') }}</span></h5>

                                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Project Timeline: <span class="text-muted">{{ \App\Utility\Helpers::ConvertDateFormat($current_project['target']) }} – {{ \App\Utility\Helpers::ConvertDateFormat($current_project['deadline']) }}</span></h5>

                                    <div class="progress mt-4" style="height: 14px;">
                                        <div class="progress-bar bg-success fs-12" role="progressbar" style="width:{{ ProjectTaskHelper::getRatioByValue(ProjectTaskHelper::getTasksByProjectId($current_project['id'])->count(), ProjectTaskHelper::getTasksByProjectId($current_project['id'], \App\Constants\TaskStatus::COMPlETE)->count()) }}%;" aria-valuenow="{{ ProjectTaskHelper::getRatioByValue(ProjectTaskHelper::getTasksByProjectId($current_project['id'])->count(), ProjectTaskHelper::getTasksByProjectId($current_project['id'], \App\Constants\TaskStatus::COMPlETE)->count()) }}" aria-valuemin="0" aria-valuemax="100">{{ ProjectTaskHelper::getRatioByValue(ProjectTaskHelper::getTasksByProjectId($current_project['id'])->count(), ProjectTaskHelper::getTasksByProjectId($current_project['id'], \App\Constants\TaskStatus::COMPlETE)->count()) }} %</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8" id="tasks-placeholder">
                            
                        </div>
                        <div class="col-md-4">

                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header border-bottom-dashed align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">Team Members</h4>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown card-header-dropdown">
                                                <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <span class="text-muted"><i class="ri-filter-3-line align-middle me-1 fs-15"></i>Filter</span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end" style="">
                                                    <a class="dropdown-item" href="#">All Member</a>
                                                    <a class="dropdown-item" href="#">Manager</a>
                                                    <a class="dropdown-item" href="#">Executive</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive table-card">
                                            <table class="table table-borderless table-nowrap align-middle mb-0">
                                                <thead class="table-light text-muted">
                                                <tr>
                                                    <th scope="col">Member</th>
                                                    <th scope="col">Tasks</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($teamMembers as $member)
                                                    <tr>
                                                        <td class="d-flex">
                                                            <img src="{{ asset($member->photo) }}" alt="" class="avatar-xs rounded-3 me-2">
                                                            <div>
                                                                <h5 class="fs-13 mb-0">{{ $member->name }}</h5>
                                                                <p class="fs-12 mb-0 text-muted">{{ $member->designation }}</p>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            {{ ProjectTaskHelper::getTotalTaskByUser($member->user_id, $current_project['id']) }}
                                                        </td>
                                                        <td>
                                                            <div class="progress mt-4" style="height: 14px;">
                                                                <div class="progress-bar bg-success fs-12" role="progressbar" style="width: {{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser($member->user_id, $current_project['id']) }}%;" aria-valuenow="{{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser($member->user_id, $current_project['id']) }}" aria-valuemin="0" aria-valuemax="100">{{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser($member->user_id, $current_project['id']) }} %</div>
                                                            </div>
                                                        </td>
                                                    </tr><!-- end tr -->
                                                @endforeach
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div>

                                    </div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <!-- Task details modal -->
    <div class="modal" id="taskModal">
       
    </div>

    <!-- ajax call urls -->
    <input type="hidden" id="hdnLoadTasksUrl" value="{{ route('clientarea/project/workStatus/getTasks', ['slug' => App\Utility\Helpers::getParamValue('slug')]) }}">
    <input type="hidden" id="hdnOpenTaskDetailModal" value="{{ route('clientarea/project/workStatus/taskDetails', ['slug' => App\Utility\Helpers::getParamValue('slug'), 'id' => '--task_id--']) }}">
    <input type="hidden" id="hdnLoadCommentsUrl" value="{{ route('clientarea/project/workStatus/loadComments', ['slug' => App\Utility\Helpers::getParamValue('slug'), 'id' => '--task_id--']) }}">
    <input type="hidden" id="hdnStoreCommentUrl" value="{{ route('clientarea/project/workStatus/storeComments', ['slug' => App\Utility\Helpers::getParamValue('slug'), 'id' => '--task_id--']) }}">
    <input type="hidden" id="hdnLoadSubmissionCommentsUrl" value="{{ route('clientarea/project/workStatus/loadSubmissionComment', ['slug' => App\Utility\Helpers::getParamValue('slug'), 'id' => '--task_id--']) }}">
    <input type="hidden" id="hdnChangeAcceptanceStatusUrl" value="{{ route('clientarea/project/workStatus/changeAcceptanceStatus', ['slug' => App\Utility\Helpers::getParamValue('slug'), 'id' => '--task_id--']) }}">

@endsection

@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('core/resources/js/client/Dashboard.js') }}"></script>
    <script src="{{ asset('core/resources/js/client/workStatus.js') }}"></script>
    <script>
        const dashboard = new Dashboard("{{ route('clientarea/api/base_url') }}");
        dashboard.projectTaskStatusChart();
        dashboard.projectTaskhourStatusChart();

        const workStatus = new WorkStatus();
    </script>

    <script src="{{ asset('assets/libs/chart.js/chart.umd.js') }}"></script>
    <script>
        const pieChartTimeOverView = document.getElementById('pieChartTimeOverView');
        new Chart(pieChartTimeOverView, {
            type: 'pie',
            data: {
                labels: ['Completed', 'Due'],
                datasets: [
                    {
                        data: [60,40],
                        backgroundColor: [
                            '#41cbed',
                            '#ff9696'
                        ]
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    title: {
                        display: true,
                        text: 'Total Time: 50 Hours',
                        align: 'start'
                    }
                }
            }
        });

    </script>
@endsection
