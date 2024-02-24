@extends('admin.layout')

@section('title') Keyword - Integration Config @endsection


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
                <div class="card-header">
                    <h6 class="mb-3"><a href="{{ route('admin/project/integrationConfig/keyword/index', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}"><i class="mdi mdi-arrow-left"></i> Back to keyword integration list</a></h6>
                    <p class="card-title mb-0 flex-grow-1"><strong>Keyword Integration Details:</strong> {{ $config->website }}</p>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @include('admin.pages.project.integration-config.keyword._menu')
                        </div><!-- end col -->
                            <div class="col-md-9">
                                <div class="mt-4 mt-md-0">
                                    <form action="{{ route('admin/project/integrationConfig/keyword/updateIdKey', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'cid' => \App\Utility\Helpers::getParamValue('cid'),]) }}" method="POST">
                                        @csrf
                                        <div class="row g-3 align-items-center mb-2">
                                            <div class="col-2 text-end">
                                                <label for="engine_id" class="col-form-label">Engine ID<span class="text-danger">*</span>: </label>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" id="engine_id" class="form-control" required name="engine_id" value="{{ $config->engine_id }}">
                                            </div>
                                        </div>
                                        <div class="row g-3 align-items-center mb-2">
                                            <div class="col-2 text-end">
                                                <label for="api_key" class="col-form-label">API Key<span class="text-danger">*</span>: </label>
                                            </div>
                                            <div class="col-6">
                                                <input type="text" id="api_key" class="form-control" required name="api_key" value="{{ $config->api_key }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-8 text-end mt-3 mb-4">
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div><!--  end col -->
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
