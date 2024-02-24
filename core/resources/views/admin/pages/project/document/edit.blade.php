@extends('admin.layout')

@section('title') Add Document - Project Name @endsection

@section('content')
    <!-- start page title -->

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
                    @include('admin.shared.alert-template')
                    <div class="row">
                        <div class="col-md-3">
                            @include('admin.pages.project.document._menu')
                        </div><!-- end col -->
                        <div class="col-md-9">
                            <form action="{{ route('admin/project/document/update', ['id' => \App\Utility\Helpers::getParamValue('id'), 'document_id' => $document->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label float-end">Document Name<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control @error('document_name') is-invalid @enderror" id="document_name" name="document_name" required value="{{ $document->document_name }}">
                                        @error('document_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label float-end">Document Type<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select class="form-control @error('type') is-invalid @enderror" name="type" id="type">
                                            <option value="">-- Select --</option>
                                            @foreach(\App\Constants\DocumentType::Gets() as $key => $type)
                                                <option value="{{ $key }}" {{ $document->type == $key ? 'selected' : '' }}>{{ $type }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="file" class="form-label float-end">File :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file">
                                        @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="file_link" class="form-label float-end">File Link :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control @error('file_link') is-invalid @enderror" id="file_link" name="file_link" required value="{{ $document->file_link }}">
                                        @error('file_link')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-end">
                                    <div class="row">
                                        <div class="col-lg-11">
                                            <button type="submit" class="btn btn-primary w-sm">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div><!--  end col -->
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
