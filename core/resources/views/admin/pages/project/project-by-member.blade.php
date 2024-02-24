@extends('admin.layout')

@section('title')
    Project by Member
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin/project/index') }}">Project</a></li>
                        <li class="breadcrumb-item active">Project by Member</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <form action="">
                        <div class="float-end d-flex">
                            <select class="form-select me-2" aria-label="Default select example" name="member_id">
                                <option value="0" selected>All</option>
                                @foreach($employees as $user)
                                    <option value="{{ $user->user_id }}" {{ request()->input('member_id') == $user->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="d-flex">
                                <button type="submit" class="btn btn-primary waves-effect waves-light d-flex"><i class='mdi mdi-filter me-2'></i> Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <h5 class="">
                                @if(request()->input('member_id'))
                                    {{ $projects->count() }} projects of <span class="text-muted fst-italic">{{ $employee_details->name }}</span>
                                @else
                                    Total {{ $projects->count() }} Projects
                                @endif
                            </h5>
                            <table class="table table-sm table-striped">
                                <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">#SL</th>
                                    <th scope="col">Project Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Hour</th>
                                    <th scope="col">Progress</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($projects as $row)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $row->project_name }}</td>
                                    <td><div class="badge {{ \App\Constants\ProjectStatus::GetColorClassName($row->status) }} fs-12">{{ \App\Constants\ProjectStatus::ConvertNumberToText($row->status) }}</div></td>
                                    <td><span class="badge {{ \App\Constants\Priority::getBgColor($row->priority) }} text-uppercase">{{ \App\Constants\Priority::ConvertNumberToText($row->priority) }}</span></td>
                                    <td>{{ $row->task->groupBy('status')[\App\Constants\ProjectStatus::COMPLETED]->count() }} / {{ $row->task->count() }}</td>
                                    <td>{{ ProjectTaskHelper::tasksHourByProjectId($row->id, \App\Constants\TaskStatus::COMPlETE) }} / {{ ProjectTaskHelper::tasksHourByProjectId($row->id) }}</td>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: {{\App\Utility\ProjectTaskHelper::getRatioByValue( $row->task->count(), $row->task->groupBy('status')[\App\Constants\ProjectStatus::COMPLETED]->count() )}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{\App\Utility\ProjectTaskHelper::getRatioByValue( $row->task->count(), $row->task->groupBy('status')[\App\Constants\ProjectStatus::COMPLETED]->count() )}}%</div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm">
                                    <div class="text-muted">Showing <span class="fw-semibold">{{ $projects->firstItem() }} - {{ $projects->lastItem() }}</span> of <span class="fw-semibold">{{ $projects->total() }}</span> projects
                                    </div>
                                </div>
                                <div class="col-sm-auto float-end">
                                    {{ $projects->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

