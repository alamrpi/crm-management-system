@extends('admin.layout')

@section('title')
    New Project
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin/project/index') }}">Project</a></li>
                        <li class="breadcrumb-item active">New Project</li>
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
                    @include('admin.pages.project._menu')
                </div>
                <div class="card-body p-2">
                    @include('admin.shared.alert-template')

                    <form action="{{ route('admin/project/store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">Project Info</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="project_name">Project Name<span
                                                        class="text-danger">*</span></label>
                                            <input type="text"
                                                   class="form-control @error('project_name') is-invalid @enderror"
                                                   id="project_name" name="project_name" required
                                                   value="{{ old('project_name') }}">
                                            @error('project_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="description">Project Description<span class="text-danger">*</span></label>
                                            <textarea class="form-control ck-editor @error('description') is-invalid @enderror" rows="5" name="description" id="description">{{ old('description') }}</textarea>
                                            @error('description')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-lg-0">
                                                    <label for="priority" class="form-label">Priority<span
                                                                class="text-danger">*</span></label>
                                                    <select class="form-select @error('priority') is-invalid @enderror"
                                                            id="priority" name="priority">
                                                        @foreach(\App\Constants\Priority::GetPriorities() as $value => $type)
                                                            <option value="{{ $value }}" {{ old('priority') == $value ? 'selected' : ''}}>{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('priority')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-lg-0">
                                                    <label for="pr_status" class="form-label">Status<span
                                                                class="text-danger">*</span></label>
                                                    <select class="form-select @error('status') is-invalid @enderror"
                                                            id="pr_status" name="status">
                                                        @foreach(\App\Constants\ProjectStatus::GetStatuses() as $value => $type)
                                                            <option value="{{ $value }}" {{ old('status') == $value ? 'selected' : ''}}>{{ $type }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('status')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="deadline" class="form-label">Deadline<span
                                                                class="text-danger">*</span></label>
                                                    <input type="date"
                                                           class="form-control @error('deadline') is-invalid @enderror"
                                                           id="deadline" name="deadline" required
                                                           value="{{ old('deadline') }}">
                                                    @error('deadline')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div>
                                                    <label for="target" class="form-label">Target<span
                                                                class="text-danger">*</span></label>
                                                    <input type="date"
                                                           class="form-control @error('target') is-invalid @enderror"
                                                           id="target" name="target" required
                                                           value="{{ old('target') }}">
                                                    @error('target')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">Client<span class="text-danger">*</span></h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <select class="form-select @error('client_id') is-invalid @enderror"
                                                    data-choices="" data-choices-search-false="" id="client_id"
                                                    name="client_id" required>
                                                <option value="">-- Select --</option>
                                                @foreach($clients as $client)
                                                    <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                                        {{$client->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('client_id')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end card body -->
                                </div>
                                <!-- end card -->

                                <div class="card">
                                    <div class="card-header bg-light">
                                        <h5 class="card-title mb-0">Attachment</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label" for="thumbnail">Thumbnail</label>
                                            <input class="form-control" id="thumbnail" name="thumbnail" type="file"
                                                   accept="image/png, image/gif, image/jpeg">
                                            @error('thumbnail')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end mb-4">
                                    <button type="submit" class="btn btn-primary w-sm">Save & Continue</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/libs/ckeditor/ckeditor.js') }}"></script>
    <script>

        $(function(){
            $('.ck-editor').each(function(e){
                CKEDITOR.replace( this.id, {
                    toolbar: [
                        ['Bold', 'Italic', 'Underline', 'Strike','-', 'TextColor', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-','JustifyLeft', 'JustifyRight', 'JustifyCenter', 'JustifyBlock', "tablerow", "tablecolumn", "tablecell", "tablecellmergesplit", '-','Table','-','Styles', 'Format', 'Font', 'FontSize' ],
                    ]
                });
            });
        });
    </script>
@endsection
