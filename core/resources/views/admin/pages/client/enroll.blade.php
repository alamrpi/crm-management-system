@extends('admin.layout')

@section('title') Enroll Client @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Client</li>
                        <li class="breadcrumb-item active">Enroll Client</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header p-2 show">
                    @include('admin.pages.client._menu')
                </div>

                <div class="card-body">
                    @include('super-admin.shared._message')
                    <div class="row">
                        <div class="col-md-6 offset-3">
                            <div class="row g-2 mb-4">
                                <div class="col-sm-10">
                                    <input type="text" id="client_id" class="form-control search" placeholder="Client ID">
                                </div>
                                <div class="col-lg">
                                    <button class="btn btn-primary w-100" type="button" onclick="getClientInfoHandler('{{ route('admin/client/getInfo') }}')">
                                        Next <i class="ri-arrow-right-s-line align-bottom"></i>
                                    </button>
                                </div>
                            </div>

                            <div id="client_info">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('core/resources/js/client.js') }}"></script>
    <script>
        const client  = new Client();
        function getClientInfoHandler(url)
        {
            const id = $('#client_id').val();
            if(id === '')
            {
                common.showAlert("Client ID is required.", 'error');
                return;
            }
            client.getClientInfo(id, url)
        }
    </script>

@endsection
