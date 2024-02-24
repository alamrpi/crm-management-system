@extends('client.layout')

@section('title') Profile - {{ $profile->name }} @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Profile - Minhaz Hosen</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('clientarea/project/dashboard', ['slug'=>$current_project['slug']]) }}">Dashboard</a></li>
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
                    <div class="card">
                        <div class="card-body d-flex justify-content-between flex-column">
                            <div class="mb-3">
                                <h1 class="fs-20 mb-0">{{ $profile->name }}</h1>
                                <p class="fs-14 text-muted mt-0">{{ $profile->designation }} ({{ \App\Constants\EmployeeTypes::ConvertNumberToText($profile->employee_type) }})</p>
                                <img class="w-75" src="{{ asset( $profile->photo ) }}" alt="">
                            </div>
                            <div class="row gx-1">
                                <div class="col-md-6">
                                    <div class="btn-toolbar w-100" role="toolbar" aria-label="Toolbar with button groups">
                                        <div class="btn-group w-100" role="group" aria-label="First group">
                                            <button type="button" class="btn btn-light text-primary"><i class="ri-facebook-fill"></i></button>
                                            <button type="button" class="btn btn-light text-primary"><i class="ri-linkedin-fill"></i></button>
                                            <button type="button" class="btn btn-light text-primary"><i class="ri-behance-fill"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group w-100" role="group" aria-label="Second group">
                                        <button type="button" class="btn btn-light text-primary">Download CV</button>
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
                                        <div class="mb-3">
                                            <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Total Projects: <span class="text-muted">{{ $projects->count() }}</span></h5>
                                            <p>
                                                @foreach($projects as $project)
                                                    <span class="badge bg-light text-primary">{{ $project->project_name }}</span>
                                                @endforeach
                                            </p>

                                            <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Tasks: <span class="text-muted">{{ ProjectTaskHelper::getCompleteTaskByUser(\App\Utility\Helpers::getParamValue('id')) }} / {{ ProjectTaskHelper::getTotalTaskByUser(\App\Utility\Helpers::getParamValue('id')) }}</span></h5>

                                            <div class="progress flex-grow-1" style="height: 14px">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ProjectTaskHelper::getTaskCompleteTasksRatioByUser(\App\Utility\Helpers::getParamValue('id')) }}%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">10%</div>
                                            </div>
                                            <br>
                                            <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Hours: <span class="text-muted">{{ ProjectTaskHelper::getCompleteTaskByUser(\App\Utility\Helpers::getParamValue('id'), 0, 'hour') }} / {{ ProjectTaskHelper::getTotalTaskByUser(\App\Utility\Helpers::getParamValue('id'), 0, 'hour') }}</span></h5>
                                            <div class="progress flex-grow-1" style="height: 14px">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: {{ ProjectTaskHelper::getTaskCompleteRatioByUser(\App\Utility\Helpers::getParamValue('id')) }}%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">{{ ProjectTaskHelper::getTaskCompleteRatioByUser(\App\Utility\Helpers::getParamValue('id')) }}%</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row gx-1">
                                        <div class="col-md-6">
                                            <button type="button" class="px-3 w-100 btn btn-primary waves-effect text-white border-1"><i class="ri-chat-3-line position-relative" style="top:2px;"></i> Chat</button>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="px-3 w-100 btn btn-primary waves-effect text-white border-1"><i class="ri-send-plane-line position-relative" style="top:2px;"></i> Send Email</button>
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
                                <h1 class="fs-16">Files</h1>
                            </div>
                            <!-- Tables Without Borders -->
                            <table class="table table table-sm table-responsive">
                                <thead>
                                <tr class="table-light">
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Size</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($files as $file)
                                <tr>
                                    <td><a href="" class="link-primary text-decoration-underline">{{ $file->name }}</a></td>
                                    <td>{{ $file->type }}</td>
                                    <td>{{ round($file->size/1024, 2, PHP_ROUND_HALF_DOWN) }} MB</td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom">
                                <div class="fs-16 mb-3">Activities</div>
                            </div>
                            <div class="table-responsive table-card m-0">
                                <table class="table table-sm">
                                    <thead class="table-light">
                                    <tr>
                                        <th scope="col">Project</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Date-Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($project_activities as $activity)
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
                                                <div class="text-muted">Showing <span class="fw-semibold">{{ $project_activities->firstItem() }} - {{ $project_activities->lastItem() }}</span> of <span class="fw-semibold">{{ $project_activities->total() }}</span> Activities
                                                </div>
                                            </div>
                                            <div class="col-sm-auto">
                                                {{ $project_activities->links() }}
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
