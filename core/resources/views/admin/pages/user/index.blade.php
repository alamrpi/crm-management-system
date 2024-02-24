@extends('admin.layout')

@section('title') All User @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All User</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @include('super-admin.shared._message')
                    <form action="{{ route('admin/users/index') }}" method="get" class="mb-2">
                        <div class="row g-1">
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ request()->input('name') }}" placeholder="User name...">
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="email" id="email" value="{{ request()->input('email') }}" placeholder="Email...">
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-borderless table-striped align-middle mb-0">
                            <thead class="text-muted table-light">
                            <tr class="fs-12">
                                <th class="text-center" style="width: 50px;">#SL</th>
                                <th class="text-center" style="width: 50px;"><i class="mdi mdi-dots-vertical align-middle"></i></th>
                                <th>Name</th>
                                <th>Role</th>
                                <th>Assigned Project</th>
                                <th>Time Tracker</th>
                                <th>Email</th>
                                <th class="text-center">Status</th>
{{--                                <th scope="col" >Permissions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($rows as $row)
                                <tr class="border-bottom">
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown">
                                                <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                            </a>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item confirm-alert" href="{{ route('admin/users/ActivationToggle', ['user_id' => $row->id]) }}">{{ $row->deactivated == 1 ? 'Active' : 'Deactive' }}</a>
                                                <a class="dropdown-item" href="{{ route('admin/users/permissions', ['user_id' => $row->id])}}">Permissions</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-nowrap"><img src="{{ asset($row->photo) }}" alt="" class="avatar-xs rounded-3 me-2"> {{ $row->name }}</td>
                                    <td>{{ ucwords($row->role) }}</td>
                                    <td>
                                        <p>
                                            @if( ProjectTaskHelper::getProjects($row->id)->count())

                                                <a href="{{ route('admin/project/project-by-member') }}?member_id={{ $row->id }}" target="_blank" class="link-secondary"><span class="badge border border-secondary text-secondary p-2 me-2">{{ ProjectTaskHelper::getProjects($row->id)->first()->project_name }}</span></a>
                                            @else

                                                <span class="badge border border-secondary text-secondary p-2 me-2">No project assigned yet</span>
                                            @endif

                                            <a href="{{ route('admin/project/project-by-member') }}?member_id={{ $row->id }}" target="_blank" class="link-secondary">{{ ($projCount = ProjectTaskHelper::getProjects($row->id)->count()-1) > 0 ? "+ $projCount More" : "" }}</a>
                                        </p>
                                    </td>
                                    <td class="text-nowrap">
                                        <div class="d-flex mb-2 text-muted">
                                            Allow Manual Time Tracker
                                            <div class="ms-3 form-check form-switch form-switch-success">
                                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck3" checked>
                                            </div>
                                        </div>
                                        <div class="d-flex text-muted">
                                            Manual Time Auto Approval
                                            <div class="ms-3 form-check form-switch form-switch-success">
                                                <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck3" checked>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $row->email }}</td>
                                    <td class="text-center text-nowrap">
                                        @if($row->deactivated == 1)
                                            <span class="text-danger"><i class="ri ri-close-line"></i> Deactivated</span>
                                        @else
                                            <span class="text-success"><i class="ri ri-check-line"></i> Activated</span>
                                        @endif
                                    </td>
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
