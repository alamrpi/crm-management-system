@extends('admin.layout')

@section('title') Keyword - Integration Config @endsection

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
            <div class="card">
                <div class="card-body">
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6">
                            <h4 class="card-title mb-0 flex-grow-1">Keyword Integrations</h4>
                        </div>
                        <div class="col-sm-6">
                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_INTEGRATION_CONFIG_ADD)
                            <div class="text-end">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#newKeywordIntegrationModal"><i class="ri-add-line align-bottom"></i> Add New</button>
                            </div>
                            @endcan
                        </div>
                    </div>

                    <div class="table-responsive table-card">
                        <table class="table table-hover table-nowrap align-middle mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col" class="text-center">#SL</th>
                                <th scope="col">Website</th>
                                <th scope="col" class="text-center">Keyword</th>
                                <th>Engine ID</th>
                                <th>API Key</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($rows as $i => $row)
                                <tr>
                                    <td class="text-center">{{ $i+1 }}</td>
                                    <td>
                                        <a href="{{ route('admin/project/integrationConfig/keyword/keywordWebsite', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'cid'=> $row->id]) }}">{{ $row->website }}</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin/project/integrationConfig/keyword/keywords', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'cid'=> $row->id]) }}">{{ $row->keywords }}</a>
                                    </td>
                                    <td>{{ $row->engine_id }}</td>
                                    <td>{{ $row->api_key }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- new keyword integration modal -->
    <div class="modal" id="newKeywordIntegrationModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="">Add new keyword integration</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <form action="{{ route('admin/project/integrationConfig/keyword/store', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}" method="POST">
                    @csrf
                    <div class="row gx-1">
                        <div class="col text-end">
                            <label for="" class="mt-2 pb-0">Website:</label>
                        </div>
                        <div class="col-6">
                            <input type="text" class="form-control" required name="website">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                 </form>
                </div>
            </div>
        </div>
    </div>

@endsection
