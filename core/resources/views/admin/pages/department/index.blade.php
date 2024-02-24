@extends('admin.layout')

@section('title') All Department @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department</li>
                        <li class="breadcrumb-item active">All Department</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @include('admin.pages.department._menu')
                </div>
                <div class="card-body">
                    @include('super-admin.shared._message')
                    <form action="{{ route('admin/department/index') }}" method="get" class="mb-2">
                        <div class="row g-1">
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ request()->input('name') }}" placeholder="Department name...">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-">
                        <table class="table table-borderless table-sm align-middle mb-0">
                            <thead class="text-muted table-light">
                            <tr class="fs-12">
                                <th scope="col" class="text-center" style="width: 50px;">#SL</th>
                                <th scope="col" class="text-center" style="width: 50px;"><i class="mdi mdi-dots-vertical align-middle"></i></th>
                                <th scope="col" class="text-center" style="width: 80px;">ICON</th>
                                <th scope="col">DEPARTMENT NAME</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown">
                                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                @can(\App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::DEPT_EDIT)
                                                <a class="dropdown-item" href="{{ route('admin/department/edit', ['id' => $row->id]) }}">Edit</a>
                                                @endcan
                                                @can(\App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::DEPT_DELETE)
                                                <a class="dropdown-item confirm-alert" href="{{ route('admin/department/delete', ['id' => $row->id]) }}">Delete</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><img src="{{ asset($row->icon) }}" alt="" class="avatar-xs rounded-3"></td>
                                    <td>{{ $row->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $rows->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
