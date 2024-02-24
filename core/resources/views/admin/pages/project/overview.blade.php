@extends('admin.layout')

@section('title') Overview - Project Name @endsection

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
        <div class="col-lg-12">
            <div class="tab-content text-muted">
                <div class="tab-pane fade active show" id="project-overview" role="tabpanel">
                    <div class="row">
                        <div class="col-xl-8 col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-muted">
                                        <h4 class="card-title text-uppercase border-bottom pb-2 mb-3">Summary</h4>
                                        {!! $project->description !!}

                                        <div class="pt-3 mt-4">
                                            <h4 class="card-title text-uppercase border-bottom pb-2 mb-3">Documents</h4>
                                            <div class="row">

                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p class="mb-2 fw-medium">Total Document</p>
                                                        <h5 class="fs-15 mb-0">{{ $project->document_count['total'] }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p class="mb-2 fw-medium">Project Document</p>
                                                        <h5 class="fs-15 mb-0">{{ $project->document_count['project'] }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p class="mb-2 fw-medium">Research Document :</p>
                                                        <h5 class="fs-15 mb-0">{{ $project->document_count['research'] }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p></p>
                                                        @can(\App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_DOCUMENT_ALL)
                                                        <a href="{{ route('admin/project/document/index', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}" class="btn btn-soft-primary waves-effect waves-light btn-sm">View Details</a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-3 mt-4">
                                            <h4 class="card-title text-uppercase border-bottom pb-2 mb-3">Team Members</h4>
                                            <div class="row">

                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p class="mb-2 fw-medium">Total</p>
                                                        <h5 class="fs-15 mb-0">{{ $project->team_member_count['total'] }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p class="mb-2 fw-medium">Manager</p>
                                                        <h5 class="fs-15 mb-0">{{ $project->team_member_count['manager'] }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p class="mb-2 fw-medium">Executive</p>
                                                        <h5 class="fs-15 mb-0">{{ $project->team_member_count['executive'] }}</h5>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="text-center">
                                                        <p></p>
                                                        @can(\App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TEAM_ALL)
                                                        <a href="{{ route('admin/project/team/index', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}" class="btn btn-soft-primary waves-effect waves-light btn-sm">View Details</a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Last 10 activities</h4>
                                    <div class="flex-shrink-0">
                                        @can(\App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACTIVITIES_VIEW)
                                        <a href="{{ route('admin/project/activity/index',['id' => \App\Utility\Helpers::getParamValue('id')]) }}" class="btn btn-soft-primary btn-sm">View All Activities</a>
                                        @endcan
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="acitivity-timeline py-3">
                                        @foreach($project->activities as $activity)
                                            <div class="acitivity-item d-flex">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset($activity->photo) }}" alt="" class="avatar-xs rounded-circle acitivity-avatar">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-1">{{ $activity->created_user_name }} <span class="badge bg-primary-subtle text-primary align-middle">New</span></h6>
                                                    <p>
                                                        {!! \App\Utility\Helpers::replaceUserName($activity->activity, $activity->created_by, $activity->created_user_name) !!}
                                                    </p>
                                                    <small class="mb-0 text-muted">{{ \App\Utility\Helpers::DateHumanReadable($activity->created_at) }}</small>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- ene col -->
                        <div class="col-xl-4 col-lg-4">

                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Project Status</h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div id="project_status_pie_chart" data-colors='["--vz-primary", "--vz-primary-rgb, 0.85", "--vz-primary-rgb, 0.70", "--vz-primary-rgb, 0.55", "--vz-primary-rgb, 0.40"]' class="apex-charts" dir="ltr"></div>
                                </div><!-- end card-body -->
                            </div><!-- end card -->

                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h4 class="card-title mb-0 flex-grow-1">Department & Services</h4>
                                    <div class="flex-shrink-0">
                                        <a href="{{ route('admin/project/service/gridView', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}" class="btn btn-soft-primary btn-sm">View Details</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <x-pr-services from="o"/>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header align-items-center d-flex border-bottom-dashed">
                                    <h4 class="card-title mb-0 flex-grow-1">In-progress Tasks</h4>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm">
                                        <thead class="bg-light text-muted">
                                        <tr>
                                            <th>ID</th>
                                            <th>Task</th>
                                            <th>Assigned To</th>
                                            <th>Due Date</th>
                                            <th>Priority</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($project->in_reviewTasks as $task)
                                            <tr>
                                                <td><a href="#">{{ $task->task_id }}</a></td>
                                                <td>{{ $task->task_name }}</td>
                                                <td>
                                                    <div class="avatar-group">
                                                        @foreach(\App\Utility\ProjectTaskHelper::teamMemberbyTask($task->id) as $member)
                                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="{{ $member->name }}" data-bs-original-title="{{ $member->name }}">
                                                                <img src="{{ asset($member->photo) }}" alt="" class="rounded-circle avatar-xxs">
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </td>
                                                <td>{{ \App\Utility\Helpers::ConvertDateFormat($task->due_date, 'd M, Y') }}</td>
                                                <td><span class="badge {{ \App\Constants\Priority::getBgColor($task->priority) }} text-uppercase">{{ \App\Constants\Priority::ConvertNumberToText($task->priority) }}</span></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

@endsection

@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [{{ ProjectTaskHelper::tasksByProjectId($project->id, \App\Constants\TaskStatus::COMPlETE) }}, {{ ProjectTaskHelper::tasksByProjectId($project->id) - ProjectTaskHelper::tasksByProjectId($project->id, \App\Constants\TaskStatus::COMPlETE) }}],
            chart: { height: 300, type: "pie" },
            labels: ["Complete", "Incomplete"],
            legend: { position: "bottom" },
            colors: [
                '#41aae2',
                '#ff6464'
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val.toFixed(2) + ' %';
                },
            }
        };
        chart = new ApexCharts(document.querySelector("#project_status_pie_chart"), options).render();
    </script>
@endsection
