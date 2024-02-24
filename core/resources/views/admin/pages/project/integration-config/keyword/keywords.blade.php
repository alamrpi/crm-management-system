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
                               <form action="{{ route('admin/project/integrationConfig/keyword/addOrUpdate', ['id' => \App\Utility\Helpers::getParamValue('id'), 'cid' => \App\Utility\Helpers::getParamValue('cid')]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="keyword_id" id="keyword_id" value="0">
                                    <div class="row gx-1 mb-2">
                                        <div class="col-6">
                                            <input type="text" class="form-control" required placeholder="New keyword" id="keyword_name" name="keyword_name">
                                        </div>
                                        <div class="col"><button type="submit" id="btn-submit" class="btn btn-primary">Save</button></div>
                                    </div>
                               </form>
                                <div class="mt-4 mt-md-0">
                                    <table class="table table-bordered table-sm align-middle mb-0 fs-16">
                                        <thead class="table-light fs-12">
                                        <tr>
                                            <th scope="col" class="text-center">#SL</th>
                                            <th scope="col" class="text-uppercase">Keyword</th>
                                            <th scope="col" class="text-center text-uppercase">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($keywords as $i => $keyword)
                                            <tr>
                                                <td class="text-center">{{ $i + 1 }}</td>
                                                <td>{{ $keyword->keyword_name }}</td>
                                                <td class="text-center">
                                                    <a href="#" onclick="setForUpdate({{ $keyword->id }}, '{{ $keyword->keyword_name }}')" class="btn btn-sm btn-soft-light text-primary"><i class="ri-pencil-fill"></i> Edit</a>
                                                    <a href="{{ route('admin/project/integrationConfig/keyword/keyword/delete', ['id' => \App\Utility\Helpers::getParamValue('id'), 'cid' => \App\Utility\Helpers::getParamValue('cid'), 'keyword_id' => $keyword->id]) }}" class="btn confirm-alert btn-sm btn-soft-light text-danger"><i class="ri-delete-bin-line"></i> Delete</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                       
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

@section('script')
<script>
    function setForUpdate(keyword_id, keyword_name){
        $('#keyword_id').val(keyword_id);
        $('#keyword_name').val(keyword_name);
        $('#btn-submit').text('Update');
    }
</script>
@endsection
