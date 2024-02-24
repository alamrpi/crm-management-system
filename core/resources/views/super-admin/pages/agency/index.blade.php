@extends('super-admin.layout')

@section('title') All Agency @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">All Agency</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('sa/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Agency</li>
                        <li class="breadcrumb-item active">All Agency</li>
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
                    @include('super-admin.pages.agency._menu')
                </div>
                <div class="card-body p-2">
                    @include('super-admin.shared._message')
                    <form action="{{ route('sa/agency/index') }}" method="get" class="mb-2 mt-3">
                        <div class="row g-1">
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="{{ request()->input('name') }}" placeholder="Agency name..." aria-label="First-Name">
                            </div>
                            <div class="col-sm-2">
                                <select class="form-control form-control-sm" name="status" id="status">
                                    <option value="">-- Status --</option>
                                    <option value="1" {{ request()->input('status') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ request()->input('status') == 0 ? 'selected' : '' }}>Deactivated</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-soft-primary btn-sm waves-effect waves-light">Search</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-">
                        <table class="table table-borderless table-sm align-middle mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" class="text-center">#SL</th>
                                <th scope="col" class="text-center"><i class="mdi mdi-dots-vertical align-middle"></i></th>
                                <th scope="col" class="text-center">Logo</th>
                                <th scope="col" class="text-center">ID</th>
                                <th scope="col">Agency</th>
                                <th scope="col">Email</th>
                                <th scope="col">Address</th>
                                <th scope="col">Website</th>
                                <th scope="col">Status</th>
                                <th scope="col">Created Date</th>
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
                                                <a class="dropdown-item" href="{{ route('sa/agency/details', ['id' => $row->id]) }}">Details</a>
                                                <a class="dropdown-item confirm-alert" href="{{ route('sa/agency/changeStatus', ['id' => $row->id]) }}">{{ $row->deactivated == 0 ? 'Active' : 'Deactive' }}</a>
                                                @if(empty($row->admin_name))
                                                <a class="dropdown-item" href="{{ route('sa/agency/createAdmin', ['id' => $row->id]) }}">Create Admin</a>
                                                @endif
                                                <a class="dropdown-item" href="{{ route('sa/agency/edit', ['id' => $row->id]) }}">Edit</a>
                                                <a class="dropdown-item confirm-alert" href="{{ route('sa/agency/delete', ['id' => $row->id]) }}">Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><img src="{{ asset($row->logo) }}" alt="" class="avatar-xs rounded-3"></td>
                                    <td class="text-center"><a href="#">{{ $row->agency_id }}</a></td>
                                    <td>
                                        <h5 class="fs-13 mb-0"><a href="{{ route('sa/agency/details', ['id' => $row->id]) }}">{{ $row->name }}</a></h5>
                                        <p class="fs-12 mb-0 text-muted">{{ $row->tagline }}</p>
                                    </td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->address }}</td>
                                    <td>{{ $row->website }}</td>
                                    <td>
                                        @if($row->deactivated == 0)
                                            <span class="badge bg-danger-subtle text-danger">Deactivated</span>
                                        @else
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/y', strtotime($row->created_at)) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-end">
                    {{ $rows->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
