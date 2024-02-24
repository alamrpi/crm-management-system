@extends('admin.layout')

@section('title') Access - Project Name @endsection

@section('content')
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
            <div class="tab-content text-muted">
                <div class="tab-pane fade active show" id="project-overview" role="tabpanel">
                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-light-subtle">
                                    <h6 class="card-title mb-0">Add Access </h6>
                                </div>
                                <div class="card-body">
                                    @if(empty($access))
                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_ADD)
                                        @include('admin.pages.project.access._add-form')
                                        @endcan
                                    @else
                                        @include('admin.pages.project.access._edit-form')
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ene col -->
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header bg-light-subtle">
                                    <h6 class="card-title mb-0">All Access </h6>
                                </div>
                                <div class="card-body">
                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_ALL)
                                    <table class="table table-bordered table-sm fs-12">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#SL</th>
                                            <th>Access Title</th>
                                            <th>Access Request</th>
                                            <th>Access Details</th>
                                            <th>File</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($rows as $i => $row)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td>{{ $row->access_title }}</td>
                                                <td>{{ $row->request_title }}</td>
                                                <td>{{ $row->access_details }}</td>
                                                <td>
                                                    @if(!empty($row->file_info))
                                                        @php($info = json_decode($row->file_info))
                                                        <button type="button" class="btn btn-link p-0 fs-12" onclick="common.openFileViewModel('{{ asset($info->path) }}', '{{ 'Project access file view: <span class="text-muted">'.$info->original_name.'</span>' }}')">{{ $info->original_name }}</button>
                                                    @endif
                                                </td>
                                                <td class="text-center text-nowrap">
                                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_EDIT)
                                                    <a href="{{ route('admin/project/access/edit', ['id' => \App\Utility\Helpers::getParamValue('id'), 'access_id' => $row->id]) }}" class="btn btn-soft-primary btn-sm btn-icon waves-effect waves-light"><i class="ri-edit-line"></i></a>
                                                    @endcan
                                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_DELETE)
                                                    <a href="{{ route('admin/project/access/delete', ['id' => \App\Utility\Helpers::getParamValue('id'), 'access_id' => $row->id]) }}" class="btn btn-soft-danger btn-sm btn-icon waves-effect waves-light confirm-alert"><i class="ri-delete-bin-5-line"></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @endcan
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header align-items-center d-flex bg-light-subtle">
                                    <h4 class="card-title mb-0 flex-grow-1">All Requests</h4>
                                    <div class="flex-shrink-0">
                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_REQUEST_ADD)
                                        <button type="button" onclick="project.requestAddOrEditModal('{{ route('admin/project/accessRequest/store', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}')" class="btn btn-primary btn-sm waves-effect waves-light">New Request</button>
                                        @endcan
                                    </div>
                                </div>
                                <div class="card-body">
                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_REQUEST_ALL)
                                    <table class="table table-bordered table-sm fs-12">
                                        <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">#SL</th>
                                            <th>Request Title</th>
                                            <th>Request Details</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($request_rows as $i => $row)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td>
                                                    @if($row->access_id == null)
                                                        {{ $row->request_title }}
                                                    @else
                                                        <s class="text-success">
                                                            {{ $row->request_title }}
                                                        </s>
                                                    @endif

                                                </td>
                                                <td>{{ $row->request_details }}</td>
                                                <td class="text-center text-nowrap">
                                                    @if($row->access_id == null)
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_REQUEST_EDIT)
                                                        <button type="button" onclick="project.requestAddOrEditModal('{{ route('admin/project/accessRequest/update', ['id' => \App\Utility\Helpers::getParamValue('id'), 'request_id' => $row->id]) }}', '{{ $row->request_title }}', '{{ $row->request_details }}', 1)" class="btn btn-soft-primary btn-sm btn-icon waves-effect waves-light"><i class="ri-edit-line"></i></button>
                                                        @endcan
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACCESS_REQUEST_DELETE)
                                                        <a href="{{ route('admin/project/accessRequest/delete', ['id' => \App\Utility\Helpers::getParamValue('id'), 'request_id' => $row->id]) }}" class="btn btn-soft-danger btn-sm btn-icon waves-effect waves-light confirm-alert"><i class="ri-delete-bin-5-line"></i></a>
                                                        @endcan
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.pages.project.access._request_add_or_edit_modal')
@endsection

@section('script')
    <script src="{{ asset('core/resources/js/Project.js') }}"></script>
    <script>
        const project = new Project();

    </script>
@endsection
