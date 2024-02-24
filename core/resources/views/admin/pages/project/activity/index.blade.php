@extends('admin.layout')

@section('title') Activity - Project Name @endsection

@section('content')
    <!-- start page title -->

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
                    <form action="{{ route('admin/project/activity/index', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}">
                        <div class="row g-2 mb-4">
                            <div class="col-lg-8">
                                <div class="search-box">
                                    <input type="text" name="activity" id="searchTaskList" class="form-control form-control-sm search" placeholder="Type activity here">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-control form-select-sm" id="employee_id" name="employee_id">
                                    <option value="">All Employee</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->user_id }}">{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-1">
                                <button class="btn btn-primary btn-sm createTask" type="button" data-bs-toggle="modal" data-bs-target="#createTask">
                                    <i class="ri-filter-3-line align-bottom"></i> Filter
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive table-card m-0">
                        <table class="table table-nowrap align-middle mb-0 table-hover">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">Employee</th>
                                <th scope="col">Activity</th>
                                <th scope="col">Date-Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                <td>
                                    <div class="d-flex">
                                        <img src="{{ asset($row->photo) }}" alt="{{ $row->created_user_name }}" class="avatar-xs rounded-3 me-2">
                                        <div>
                                            <h5 class="fs-13 mb-0">{{ $row->created_user_name }}</h5>
                                            <p class="fs-12 mb-0 text-muted">{{ $row->designation ?? '' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {!! \App\Utility\Helpers::replaceUserName($row->activity, $row->created_by, $row->created_user_name) !!}
                                </td>
                                <td>{{ \App\Utility\Helpers::ConvertDateFormat($row->created_at, 'd/m/y h:i:s A') }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="align-items-center mt-2 row g-3 text-center text-sm-start">
                        <div class="col-sm">
                            <div class="text-muted">Showing <span class="fw-semibold">{{ $rows->firstItem() }} - {{ $rows->lastItem() }}</span> of <span class="fw-semibold">{{ $rows->total() }}</span> Activities
                            </div>
                        </div>
                        <div class="col-sm-auto">
                            {{ $rows->links() }}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection
