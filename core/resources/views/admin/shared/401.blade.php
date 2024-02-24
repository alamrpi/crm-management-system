@extends('admin.layout')

@section('title') Error | Un-Authorize @endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-xl-4 text-center">
            <div class="error-500 position-relative">
                <img src="assets/images/error500.png" alt="" class="img-fluid error-500-img error-img" />
                <h1 class="title text-primary">401</h1>
            </div>
            <div>
                <h4 class="text-danger">Page Un-authorized!</h4>
                <a href="{{ route('admin/dashboard') }}" class="btn btn-primary"><i class="mdi mdi-home me-1"></i>Back to Dashboard</a>
            </div>
        </div><!-- end col-->
    </div>
@endsection
