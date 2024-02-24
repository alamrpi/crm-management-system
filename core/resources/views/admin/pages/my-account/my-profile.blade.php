@extends('admin.layout')

@section('title') My Profile @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">My Profile</h4>
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

                    <div class="col-md-8 mx-auto">
                        <div class="border p-4 rounded">
                            <form action="{{ route('admin/myProfile')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label float-end">Name :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required="" value="{{ $profile->name }}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="email" class="form-label float-end">Email <span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required="" value="{{ $profile->email }}" readonly>
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="photo" class="form-label float-end">Profile Picture:</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo">
                                        @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-11">
                                        <button type="submit" class="btn btn-primary float-end">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
