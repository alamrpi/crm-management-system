@extends('admin.layout')

@section('title') Dashboard | Admin @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div class="card-body border-bottom">
                        <div class="col-md-4">
                            <form action="">
                                <select name="project" id="filterProjectStatusChart" class="form-select border-0 border-bottom border-secondary" onchange="dashboard.randerprojectTasksStatusChart(this.value)">
                                    @foreach($projects as $project)
                                        <option value="{{$project->id}}">{{ $project->project_name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="card-body border-end h-100 d-flex flex-column">
                            <div class="d-flex">
                                <h4 class="card-title mb-0 col">Project Status</h4>
                                <div class="col-auto">
                                    <label for="" class="flex-grow-1 text-end p-1 m-0"><strong>SORT BY : </strong></label>
                                    <input type="month" class="form-control-sm float-end border-0 w-50 p-1" value="{{date('Y-m')}}" onchange="dashboard.randerprojectTasksStatusChart(document.getElementById('filterProjectStatusChart').value, this.value)"/>
                                </div>
                            </div><!-- end card header -->
                            <div class="flex-grow-1" id="columnChartHolder">
                                <div class="w-100 d-flex justify-content-center align-items-center h-100">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div>
                    <div class="col-md-4 h-100">
                        <div class="h-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Project Summary</h4>
                            </div>
                            <div class="card-body fs-12">
                                <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">ID: <span class="text-muted">{{ count($projects) ? $projects[0]->id : 0 }}</span></h5>
                                <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Project Name: <span class="text-muted">{{  count($projects) ? $projects[0]->project_name : '' }}</span></h5>
                                <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Tasks: <span class="text-muted">{{ count($projects) ? \App\Utility\ProjectTaskHelper::getTasksByProjectId( $projects[0]->id , \App\Constants\TaskStatus::COMPlETE)->count() : 0 }} / {{ count($projects) ? \App\Utility\ProjectTaskHelper::getTasksByProjectId( $projects[0]->id)->count() : 0 }}</span></h5>

                                <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Hours: <span class="text-muted">{{ count($projects) ?  \App\Utility\ProjectTaskHelper::tasksHourByProjectId($projects[0]->id, \App\Constants\TaskStatus::COMPlETE ) : 0 }} / {{ count($projects) ? \App\Utility\ProjectTaskHelper::tasksHourByProjectId($projects[0]->id) : 0 }}</span></h5>

                                <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Project Timeline: <span class="text-muted">{{ count($projects) ? \Carbon\Carbon::parse($projects[0]->created_at)->format('d/m/Y') : '' }} – {{ count($projects) ? \Carbon\Carbon::parse($projects[0]->deadline)->format('d/m/Y') : '' }} </span></h5>

                                <div class="progress mt-4" style="height: 14px;">
                                    <div class="progress-bar bg-success fs-12" role="progressbar" style="width: {{ \App\Utility\ProjectTaskHelper::getTaskCompleteRatioByTaskId(count($projects) ? $projects[0]->id : 0) }}%;" aria-valuenow="{{ \App\Utility\ProjectTaskHelper::getTaskCompleteRatioByTaskId(count($projects) ? $projects[0]->id : 0) }}" aria-valuemin="0" aria-valuemax="100">{{ \App\Utility\ProjectTaskHelper::getTaskCompleteRatioByTaskId(count($projects) ? $projects[0]->id : 0) }}%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="row">
                <div class="col-12">
                    <div class="card pb-3">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Revision Tasks <span class="badge bg-danger">{{ count($revision_tasks) }}</span></h4>
                        </div>
                        @foreach ($revision_tasks as $task)
                        <div class="card-body py-0">
                            <div class="card card-animate border border-1 mb-1">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="fs-14 fw-semibold">{{ $task->task_id }} - {{ $task->task_name }}</h5>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-3 fs-12">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Complete Date</p>
                                            {{ date('m/d/Y', strtotime($task->completed_time)) }}
                                        </div>
                                        <div class="col-3 fs-12">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Submit Date</p>
                                            {{ date('m/d/Y', strtotime($task->submitted_date)) }}
                                        </div>
                                        <div class="col-3 fs-12">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Review Date</p>
                                            {{ date('m/d/Y', strtotime($task->review_time)) }}
                                        </div>
                                        <div class="col-3 fs-12">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Return To Revision Date</p>
                                            {{ date('m/d/Y', strtotime($task->return_revision_date)) }}
                                        </div>
                                    </div>
                                    <div class="row mt-n2">
                                        <div class="col-12 fs-12">
                                            Project: <span class="text-muted">{{ $task->project_name }}</span> |
                                            Dept: <span class="text-muted">{{ $task->dept_name }}</span> |
                                            Service: <span class="text-muted">{{ $task->service_name }}</span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card pb-3">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Over Due Tasks <span class="badge bg-danger" id="overDueCount">...</span></h4>
                        </div>

                        <div id="overDueTaskHolder">
                            <div class="card-body py-0">
                                <div class="card card-animate border border-1 mb-1">
                                    <div class="card-body">
                                        <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 50px">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card pb-3">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Next Due Tasks <span class="badge bg-warning" id="nextDueCount">...</span></h4>
                        </div>
                        <div id="nextDueTasksHolder">
                            <div class="card-body py-0">
                                <div class="card card-animate border border-1 mb-1">
                                    <div class="card-body">
                                        <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 50px">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Upcoming Meeting</h4>
                        </div>
                        <div class="card-body">
                            <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                                <img class="img-fluid w-60" src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/sitting-girl-with-laptop-dark.png" alt="Card girl image">
                            </div>
                            <h4 class="mb-2 pb-1">Upcoming Meeting</h4>
                            <p class="small">Meeting title will go hare.</p>
                            <div class="row mb-3 g-3">
                                <div class="col-5">
                                    <div class="d-flex">
                                        <div class="avatar flex-shrink-0 me-2">
                                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar-exclamation bx-sm"></i></span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                                            <small>22:00</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar-group">
                                            <div class="avatar-group-item">
                                                <div class="avatar-xs">
                                                    <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="avatar-group-item">
                                                <div class="avatar-xs">
                                                    <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="avatar-group-item">
                                                <div class="avatar-xs">
                                                    <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="avatar-group-item">
                                                <div class="avatar-xs">
                                                    <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="avatar-group-item">
                                                <div class="avatar-xs">
                                                    <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                </div>
                                            </div>
                                            <div class="avatar-group-item">
                                                <div class="avatar-xs">
                                                    <div class="avatar-title rounded-circle bg-light text-primary">
                                                        +10
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="btn btn-primary w-100">Join the Meeting</a>
                            <div class="mt-3">
                                <table class="table table-borderless table-responsive align-middle">
                                    <tbody>
                                    <tr>
                                        <td>Meeting Subject</td>
                                        <td>10/01/2024</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                                +10
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Meeting Subject</td>
                                        <td>10/01/2024</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                                +10
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Meeting Subject</td>
                                        <td>10/01/2024</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="avatar-group">
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                        </div>
                                                    </div>
                                                    <div class="avatar-group-item">
                                                        <div class="avatar-xs">
                                                            <div class="avatar-title rounded-circle bg-light text-primary">
                                                                +10
                                                            </div>
                                                        </div>
                                                    </div>
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
                <div class="col-12">
                    <div class="card">
                        <div class="pb-3">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Tasks: Waiting for Review <span class="badge bg-warning">..</span></h4>
                            </div>

                            @for($i=0; $i<3; $i++)
                                <div class="card-body py-0">
                                    <div class="card card-animate border border-1 mb-1">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="fs-14 fw-semibold">Task - UI/UX design & database design</h5>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6 fs-12">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Request Date</p>
                                                    {{ date('m/d/Y') }}
                                                </div>
                                                <div class="col-6 fs-12">
                                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Requested By</p>
                                                    <span><a href="#">User Name</a></span>
                                                </div>
                                            </div>
                                            <div class="row mt-n2">
                                                <div class="col-12 fs-12">
                                                    Project: <span class="text-muted">CRM Development</span>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endfor

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pages.project.task.details-modal')
@endsection

@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('core/resources/js/Dashboard.js') }}"></script>
    <script src="{{ asset('core/resources/js/Task.js') }}"></script>
    <script>
        const dashboard = new Dashboard({{ auth()->user()->id, 'employee' }})
        dashboard.loadManagerDahsboard();
        dashboard.randerprojectTasksStatusChart({{ count($projects) ? $projects[0]->id : 0 }});
    </script>
@endsection
