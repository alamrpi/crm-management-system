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
                    <form action="{{ route('admin/employee/index') }}" method="get" class="mb-2 mt-3">
                        <div class="row g-1">
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ request()->input('name') }}" placeholder="Name">
                            </div>
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control-sm" name="email" id="email" value="{{ request()->input('email') }}" placeholder="Email">
                            </div>
                            <div class="col-sm-2">
                                <select name="" id="" class="form-select form-select-sm">
                                    <option value="">-- All Department --</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-">
                        <table class="table table-borderless table-sm align-middle mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">#SL</th>
                                <th scope="col" class="text-center" style="width: 50px;"><i class="mdi mdi-dots-vertical align-middle"></i></th>
                                <th scope="col" class="text-center">Photo</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Designation</th>
                                <th scope="col">Department</th>
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
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_EDIT)
                                                <a class="dropdown-item" href="{{ route('admin/employee/edit', ['id' => $row->id]) }}">Edit</a>
                                                @endcan
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_DEACTIVE)
                                                <a class="dropdown-item confirm-alert" href="{{ route('admin/employee/delete', ['id' => $row->id]) }}">Delete</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><img src="{{ asset($row->photo) }}" alt="" class="avatar-xs rounded-3"></td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->designation }}</td>
                                    <td>-</td>
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
