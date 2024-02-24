@extends('admin.layout')

@section('title') Profile - {{ $profile->name }} @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Profile - {{ $profile->name }}</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teams</li>
                        <li class="breadcrumb-item active">Profile - {{ $profile->name }}</li>
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
                <div class="col-md-4">
                    <div class="h-100 pb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div class="">
                                    <h1 class="fs-20 mb-0">{{ $profile->name }} <span class="text-success"><i class="mdi mdi-check-decagram"></i></span></h1>
                                    <p class="fs-16 text-muted mt-0">{{ $profile->designation }} ({{ $profile->dept_name }})</p>
                                    <img class="w-100 img-thumbnail" src="{{ asset($profile->photo) }}" alt="">
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="mt-3">
                                       <div class="row gx-1">
                                           <div class="col-6">
                                               <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                   <div class="btn-group me-2 w-100" role="group" aria-label="First group">
                                                       @foreach($socialLinks as $social)
                                                           <a href="{{ $social->profile_url }}" target="_blank" class="btn btn-light text-primary">{!! $social->icon !!}</a>
                                                       @endforeach
                                                   </div>
                                               </div>
                                           </div>
                                           <div class="col-6">
                                               <div class="btn-group w-100" role="group" aria-label="Second group">
                                                   <button type="button" class="btn btn-light text-primary">Download CV</button>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 pb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div class="d-flex flex-column justify-content-between">
                                        <div class="border-bottom mb-3">
                                            <h1 class="fs-20 mb-3">Work Summary</h1>
                                        </div>
                                        <h5 class="fs-14 fw-normal text-uppercase border-bottom pb-2 mb-2">Total Projects: <span class="text-muted">{{ ProjectTaskHelper::getProjectCount($profile->id) }}</span></h5>
                                        <h5 class="fs-14 fw-normal text-uppercase border-bottom pb-2 mb-2">Running Projects: <span class="text-muted">{{ ProjectTaskHelper::getProjectCount($profile->id) - ProjectTaskHelper::getProjectCount($profile->id, \App\Constants\ProjectStatus::CANCELED) }}</span></h5>
                                        <h5 class="fs-14 fw-normal text-uppercase border-bottom pb-2 mb-2">Completed Tasks: <span class="text-muted">{{ ProjectTaskHelper::getCompleteTaskByUser($profile->id) }}</span></h5>
                                        <h5 class="fs-14 fw-normal text-uppercase border-bottom pb-2 mb-2">Working Hours: <span class="text-muted">{{ ProjectTaskHelper::getCompleteTaskByUser($profile->id, 0, 'hour') }}</span></h5>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="mt-3 row gx-1">
                                            <div class="col-6">
                                                <button type="button" class="px-3 me-2 btn btn-primary waves-effect text-white border-1 w-100"><i class="ri-chat-3-line position-relative" style="top:2px;"></i> Chat</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="button" class="px-3 me-2 btn btn-primary waves-effect text-white border-1 w-100"><i class="ri-send-plane-line position-relative" style="top:2px;"></i> Send Email</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 pb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="border-bottom">
                                    <h1 class="fs-20 mb-3">Performance</h1>
                                </div>
                                <!-- Tables Without Borders -->
                                <div id="performance_pie_chart" data-colors='["--vz-primary", "--vz-primary-rgb, 0.85", "--vz-primary-rgb, 0.70", "--vz-primary-rgb, 0.55", "--vz-primary-rgb, 0.40"]' class="apex-charts mt-3" dir="ltr"></div>
                                <div class="">
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Attendance: <span class="text-muted">90%</span></h5>
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Ontime Delivery: <span class="text-muted">80%</span></h5>
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Work Quality: <span class="text-muted">95%</span></h5>
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Extra Curriculum Activity: <span class="text-muted">95%</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom">
                                <div class="fs-20 mb-3">Employee Details</div>
                            </div>
                            <div class="card-body">
                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Name</h5>
                                <p class="text-muted fs-12">{{ $profile->name }}</p>

                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Designation</h5>
                                <p class="text-muted fs-12">{{ $profile->designation }}</p>

                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Join Date</h5>
                                <p class="text-muted fs-12">{{ \Carbon\Carbon::parse($profile->join_date)->format('d/m/Y H:i') }}</p>

                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">More Info Will Go Here</h5>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom">
                                <div class="fs-20 mb-3">Activities</div>
                            </div>
                            <div class="table m-0">
                                <table class="table table-nowrap align-middle mb-0 table-hover">
                                    <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Project</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Date-Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($activities as $activity)
                                        <tr>
                                            <td>
                                                <p class="mb-0">{{$activity->project_name}}</p>
                                                <small>{{ $activity->task_name }}</small>
                                            </td>
                                            <td>{!!\App\Utility\Helpers::replaceUserName( $activity->activity, $activity->created_by, $activity->created_user_name) !!}</td>
                                            <td>{{ \Carbon\Carbon::parse($activity->created_at)->format('d-m-Y, H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3">
                                            <div class="col-sm">
                                                <div class="text-muted">Showing <span class="fw-semibold">{{ $activities->firstItem() }} - {{ $activities->lastItem() }}</span> of <span class="fw-semibold">{{ $activities->total() }}</span> Activities
                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                {{ $activities->links() }}
                                            </div>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [92, 8],
            chart: { height: 300, type: "pie" },
            labels: ["Complete", "Incomplete"],
            legend: { position: "top" },
            colors: [
                '#12436D',
                '#F46A25'
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + ' %';
                },
            }
        };
        chart = new ApexCharts(document.querySelector("#performance_pie_chart"), options).render();
    </script>
@endsection
