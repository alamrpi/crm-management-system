@extends('admin.layout')

@section('title') All Employee @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Employee</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header p-2">
                    @include('admin.pages.employee._menu')
                </div>
                <div class="card-body p-2">
                    @include('super-admin.shared._message')
                    <form action="{{ route('admin/employee/index') }}" method="get" class="mb-4 mt-3">
                        <div class="row g-1">
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ request()->input('name') }}" placeholder="Name">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control-sm" name="email" id="email" value="{{ request()->input('email') }}" placeholder="Email">
                            </div>
                            <div class="col-sm-2">
                                <select name="department_id" id="department_id" class="form-select form-select-sm">
                                    <option value="">-- All Department --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" {{ request()->input('department_id') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-lg-12">
                            <div>
                                <div id="teamlist">
                                    <div class="team-list row grid-view-filter" id="team-member-list">
                                        @foreach($rows as $row)
                                            <x-employee :employee="$row"/>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                    </div>
                </div>
                {{ $rows->links() }}
            </div>
        </div>
    </div>
@endsection
