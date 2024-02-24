@extends('admin.layout')

@section('title') Edit Client @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Client</li>
                        <li class="breadcrumb-item active">Edit Client</li>
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
                        <div class="col-sm-8">
                            <form action="{{ route('admin/client/update', ['id'=> $client->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label float-end">Name<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ $client->name }}">
                                        @error('name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="email" class="form-label float-end">Email<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="email" readonly  class="form-control bg-light @error('email') is-invalid @enderror" id="email" name="email" required value="{{ $client->email }}">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="address" class="form-label float-end">Address<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" required value="{{ $client->address }}">
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="company_name" class="form-label float-end">Company Name<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control @error('company_name') is-invalid @enderror" id="company_name" name="company_name" required value="{{ $client->company_name }}">
                                        @error('company_name')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="website" class="form-label float-end">Website :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website" required value="{{ $client->website }}">
                                        @error('website')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="logo" class="form-label float-end">Company Logo :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control @error('logo') is-invalid @enderror" type="file" id="logo" name="logo" accept="image/*">
                                        <small class="text-warning ">File extension must be: jpg, jpeg, png, gif & dimension maximum 150x150</small>
                                        @error('logo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="photo" class="form-label float-end">User Photo :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" accept="image/*">
                                        <small class="text-warning ">File extension must be: jpg, jpeg, png, gif & dimension maximum 256x256</small>
                                        @error('photo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
