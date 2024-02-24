@extends('admin.layout')

@section('title') Dashboard | Admin @endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-md-4">
                    <div class="card-body">
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
                    <div class="col-md-12">
                        <div class="card-body h-100 d-flex flex-column border-top">
                                <div class="d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Project Status</h4>
                                    <div class="d-flex flex-grow-1">
                                        <label for="" class="flex-grow-1 text-end p-1 m-0"><strong>SORT BY : </strong></label>
                                        <input type="month" class="form-control-sm float-end border-0 w-50 p-1" value="{{date('Y-m')}}" onchange="dashboard.randerprojectTasksStatusChart(document.getElementById('filterProjectStatusChart').value, this.value)"/>
                                    </div>
                                </div><!-- end card header -->
                            <div class="flex-grow-1" id="columnChartHolder">
                                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                                    <div class="spinner-border" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </div>
                            </div><!-- end card-body -->
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Time Tracker</h6>
                </div>
                <div class="card-body">
                    <div class="w-100 mb-3">
                        <div class="alert alert-success" id="timerSection" style="border-radius: 10px; border: 2px solid #88cfe7; background: #e0f3ff; display: none;" role="alert">
                            <p class="text-dark fx-14 mb-1"><strong class="text">Current  Session: </strong> <span id="taskName"></span></p>
                            <p class="fs-18 text-secondary mb-0"><strong id="timer">00:00:00</strong></p>
                        </div>
                    </div>

                    <div class="w-100">
                        <select class="form-select mb-3" aria-label="Default select example" id="project_id" onchange="timeTracker.getTasksByProject(this.value, '{{ route('admin/project/task/task-by-project', ['id' => 'PROJECT_ID']) }}')">
                            <option value="0" selected>Select Project</option>
                            @foreach($user_projects as $user_project)
                                <option value="{{ $user_project->id }}"> {{  $user_project->project_name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-100">
                        <select class="form-select mb-3" id="task_id" aria-label="Default select example" onchange="timeTracker.changeTask(this.value)">
                            <option selected>Select Task</option>
                        </select>
                    </div>

                    <div class="w-100 mb-4" id="trackerCoontroller">
                        <button type="button" class="w-100 fs-16 btn btn-danger waves-effect waves-light" onclick="timeTracker.startTimerHandler()"><i  class="mdi mdi-play"></i> Start</button>
                        {{-- <i class="mdi mdi-stop"></i> Stop --}}
                    </div>

                    <div class="w-100 mt-1">
                        <div class="alert alert-info p-4 border-0" style="border-radius: 10px; background: #f3f6f9;" role="alert">
                            <p class="m-0 fs-18"><strong class="text-muted">Today's Total: <span class="text-dark">{{ sprintf('%02d h %02d m', (int) $todayCompletedHour, fmod($todayCompletedHour, 1) * 60) }}</span></strong> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-8">

            <div class="row">
                <div class="col-12">
                    <div class="card pb-3">
                        <div class="card-header">
                            <div class="d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Today Tasks <span class="badge bg-warning" id="todayDueCount">..</span></h4>
                                <div class="d-flex justify-content-end">
                                    <select class="form-select form-select-sm border-0" aria-label="Default select example" onchange="dashboard.getTodayDueTasks(this.value)">
                                        <option selected value="0">All Projects</option>
                                        @foreach($projects as $project) <option value="{{$project->id}}">{{ $project->project_name }}</option> @endforeach
                                    </select>
                                </div>
                            </div><!-- end card header -->
                        </div>

                        <div id="todayDueTasksHolder">
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
                        <div class="card-header">
                            <div class="d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Next Due Tasks <span class="badge bg-warning" id="nextDueCount">..</span></h4>
                                <div class="d-flex justify-content-end flex-grow-0">
                                    <select class="form-select form-select-sm border-0" aria-label="Default select example" onchange="dashboard.getNextDueTasks(this.value)">
                                        <option selected value="0">All Projects</option>
                                        @foreach($projects as $project) <option value="{{$project->id}}">{{ $project->project_name }}</option> @endforeach
                                    </select>
                                </div>
                            </div><!-- end card header -->
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
                            <h4 class="card-title mb-0 flex-grow-1">Work Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive bg-white">
                                <table class="table table-sm table-borderless">
                                    <thead>
                                    <tr class="table-light">
                                        <th scope="col">Project</th>
                                        <th scope="col">Task</th>
                                        <th scope="col">Hour</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(ProjectTaskHelper::tasksByEmolpyeeId(auth()->user()->id, 0, 1)->groupBy('project_name') as $key => $row)

                                        <tr>
                                            <td>
                                                <span class="">{{ $key }}</span>
                                            </td>
                                            <td>
                                                <span class="">{{ ProjectTaskHelper::tasksByEmolpyeeId(auth()->user()->id, \App\Constants\TaskStatus::COMPlETE) }}</span>/
                                                <span class="">{{ $row->count('id') }}</span>
                                            </td>
                                            <td>
                                                <span class="">{{ \App\Utility\ProjectTaskHelper::tasksByEmolpyeeId(auth()->user()->id, \App\Constants\TaskStatus::COMPlETE, 'hour') }}</span>/
                                                <span class="">{{ $row->sum('assigned_hour') }}</span>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Next Day Tasks</h4>
                        </div>
                        <div class="card-body" id="nextDayTasksHolder">
                            <div class="w-100 d-flex justify-content-center align-items-center h-100">
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

    <input type="hidden" id="hdnNextDayTasksPath" value="{{ route('admin/dashboard/next-day-tasks', auth()->user()->id) }}">
    <input type="hidden" id="hdnStartTimerUrl" value="{{ route('admin/project/task/start-timer', ['id' => 'PROJECT_ID', 'task_id' => 'TASK_ID']) }}">
    <input type="hidden" id="hdnLoadActivitiesUrl" value="{{ route('admin/project/task/activities', ['id' => 'PROJECT_ID', 'task_id' => 'TASK_ID']) }}">
    <input type="hidden" id="hdnCheckTimeTracker" value="{{ route('admin/check-time-tracker', ['user_id' => auth()->user()->id]) }}">
    <input type="hidden" id="hdnStopTimerUrl" value="{{ route('admin/project/task/stop-timer', ['id' => 'PROJECT_ID', 'task_id' => 'TASK_ID']) }}">
    @include('admin.pages.project.task.details-modal')
    <!-- Modal -->
    <div class="modal fade" id="modal-stop-timer-note" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Confirmation!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" onsubmit="timeTracker.stopTimerHandler()">
                        <div class="form-group">
                            <textarea name="tracker_note" class="form-control" required id="tracker_note" cols="30" rows="10" placeholder="Note.."></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-success float-end">Ok</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('core/resources/js/Dashboard.js') }}"></script>
    <script src="{{ asset('core/resources/js/Task.js') }}"></script>
    <script src="{{ asset('core/resources/js/TimeTracker.js') }}"></script>
    <script>
        const timeTracker = new TimeTracker();
        const dashboard = new Dashboard({{ auth()->user()->id, 'manager' }})
        dashboard.loadExecutiveDashboard();
        dashboard.getNextDayTasks();
        dashboard.randerprojectTasksStatusChart({{count($projects) ?  $projects[0]->id : 0}});
    </script>
@endsection
