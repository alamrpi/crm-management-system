@extends('admin.layout')

@section('title') My Agency @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">My Agency</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @include('admin.pages.my-account._menu')
                </div>
                <div class="card-body p-2">
                    @include('admin.shared.alert-template')



                </div>
            </div>
        </div>
    </div>
@endsection
