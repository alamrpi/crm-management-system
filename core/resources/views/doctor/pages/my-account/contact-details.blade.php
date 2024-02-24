@extends('doctor.layout')

@section('title') Contact Details @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Contact Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('doctor/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">My Account</li>
                        <li class="breadcrumb-item active">Contact Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-3">
            @include('doctor.pages.my-account._menu')
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <form action="">
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">WhatsApp</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">IMO</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">WeChat</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">Skype</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">Facebook</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">Linkedin</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">Twitter</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">Instagram</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="input-group flex-nowrap mb-2">
                            <span class="input-group-text w-sm" id="addon-wrapping">Pinterest</span>
                            <input type="text" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
