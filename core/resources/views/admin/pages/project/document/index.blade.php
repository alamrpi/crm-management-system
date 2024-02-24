@extends('admin.layout')

@section('title') Document - Project Name @endsection


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
                    <div class="row">
                        <div class="col-md-3">
                            @include('admin.pages.project.document._menu')
                        </div><!-- end col -->
                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_DOCUMENT_ALL)
                        <div class="col-md-9">
                            <div class="tab-content mt-4 mt-md-0">
                                <table class="table table-bordered table-sm align-middle mb-0 fs-12">
                                    <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="text-center">#SL</th>
                                        <th scope="col" class="text-center"><i class="mdi mdi-dots-vertical align-middle"></i></th>
                                        <th scope="col">Document Name</th>
                                        <th scope="col" class="text-center">Doc Type</th>
                                        <th scope="col" class="text-center">File Type</th>
                                        <th scope="col" class="text-center">Size</th>
                                        <th scope="col" class="text-center">Uploaded Date</th>
                                        <th scope="col">Uploaded By</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rows as $i => $row)
                                        <tr>
                                            <td class="text-center">{{ ++$i }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <a href="javascript:void(0);" class="btn btn-sm btn-icon show" data-bs-toggle="dropdown" aria-expanded="true">
                                                        <i class="mdi mdi-dots-vertical align-middle"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-66px, 30px);">
                                                                                                                <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-fill me-2 align-bottom text-muted"></i>View</a></li>
                                                        <li><a class="dropdown-item" href="{{ asset($row->file_path) }}" download="{{ $row->document_name }}"><i class="ri-download-2-fill me-2 align-bottom text-muted"></i>Download</a></li>
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_DOCUMENT_EDIT)
                                                        <li>
                                                            <a class="dropdown-item" href="{{ route('admin/project/document/edit', ['id' => \App\Utility\Helpers::getParamValue('id'), 'document_id' => $row->id]) }}"><i class="ri-edit-2-line me-2 align-bottom text-muted"></i>Edit</a>
                                                        </li>
                                                        @endcan
                                                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_DOCUMENT_DELETE)
                                                        <li class="dropdown-divider"></li>
                                                        <li>
                                                            <a class="dropdown-item confirm-alert" href="{{ route('admin/project/document/delete', ['id' => \App\Utility\Helpers::getParamValue('id'), 'document_id' => $row->id]) }}"><i class="ri-delete-bin-5-fill me-2 align-bottom text-muted"></i>Delete</a>
                                                        </li>
                                                        @endcan
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                @if($row->file_path)
                                                    <a href="javascript:void(0);" onclick="common.openFileViewModel('{{ asset($row->file_path) }}', '{{ $row->document_name }}')">{{ $row->document_name }}</a>
                                                @else
                                                    <a href="{{ $row->file_link }}" target="_blank">{{ $row->document_name }}</a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary-subtle text-primary">{{ \App\Constants\DocumentType::ConvertNumberToText($row->type) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="{{$row->file_path ? 'badge bg-dark-subtle text-dark' : ''}}">{{ $row->file_path ? $row->file_type : '-' }}</span>
                                            </td>
                                            <td class="text-center">{{ $row->file_path ? $row->size . ' KB' : '-' }}</td>
                                            <td class="text-center">{{ \App\Utility\Helpers::ConvertDateFormat($row->created_at)}}</td>
                                            <td>{{ $row->create_document_by }}</td>
                                        </tr>
                                    @endforeach
                                    @endcan
                                    </tbody>
                                </table>
                            </div>
                        </div><!--  end col -->
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
