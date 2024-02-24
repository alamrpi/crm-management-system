@extends('admin.layout')

@section('title') Assign Access @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
                        <li class="breadcrumb-item active">Role</li>
                        <li class="breadcrumb-item active">Add</li>
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
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin/role/index') }}">
                            <i class="fas fa-home"></i>
                            All Role
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin/role/create') }}">
                            <i class="far fa-user"></i>
                            New Role
                        </a>
                    </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    @include('admin.shared.alert-template')
                    <form action="{{ route('admin/role/assign-access/store', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-sm table-bordered">
                                    <tr>
                                        <th style="width: 10%">Role Name</th>
                                        <td>{{ $role->role_name }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-sm-12">
                                <div class="row">
                                    @foreach($accesses->groupBy('group') as $group_id => $group_accesses)
                                        <div class="col-md-4 mb-3">
                                            <div class="list-group">
                                                <label class="list-group-item d-flex p-1">
{{--                                                    <input class="form-check-input flex-shrink-0" type="checkbox" {{ $all_checked ? 'checked' : '' }}>--}}
                                                    <h5 class="m-0 ps-2">{{ \App\Constants\Authorization\AccessGroup::groupName($group_id) }}</h5>
                                                </label>
                                                @foreach($group_accesses as $access)
                                                    <label class="list-group-item d-flex gap-2 p-1">
                                                        <input class="form-check-input flex-shrink-0" type="checkbox" name="access_ids[]" value="{{ $access->id }}" {{ in_array($access->id, $accesses_ids) ? 'checked' : '' }}>
                                                        <span>{{ $access->name }}</span>
                                                    </label>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-12 text-end">
                                <button class="btn btn-sm btn-primary" type="submit"><i class="bx bx-save"></i> Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
