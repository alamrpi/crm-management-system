@extends('super-admin.layout')

@section('title') Create New Agency @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Create New Agency</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('sa/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('sa/agency/index') }}">Agency</a></li>
                        <li class="breadcrumb-item active">Edit Agency</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sa/agency/index') }}">
                                <i class="fas fa-home"></i>
                                All Agency
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('sa/agency/edit', ['id' => $agency->id]) }}">
                                <i class="far fa-user"></i>
                                Edit Agency
                            </a>
                        </li>
                    </ul>

                </div>
                <div class="card-body p-4">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{ route('sa/agency/update', ['id' => $agency->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="agency_name" class="form-label float-end">Agency Name<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-sm @error('agency_name') is-invalid @enderror" id="agency_name" name="agency_name" required value="{{ $agency->name }}">
                                        @error('agency_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="tagline" class="form-label float-end">Tagline<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-sm @error('tagline') is-invalid @enderror" id="tagline" name="tagline" required value="{{ $agency->tagline }}">
                                        @error('tagline')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="email" class="form-label float-end">Email<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email" name="email" required value="{{ $agency->email }}">
                                        @error('email')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="address" class="form-label float-end">Address<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror" id="address" name="address" required value="{{ $agency->address }}">
                                        @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="website" class="form-label float-end">Website<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="url" class="form-control form-control-sm @error('website') is-invalid @enderror" id="website" name="website" required value="{{ $agency->website }}">
                                        @error('website')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="about" class="form-label float-end">About Agency<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <textarea class="form-control form-control-sm @error('about') is-invalid @enderror" id="about" name="about" rows="3">{{ $agency->about }}</textarea>
                                        @error('about')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="logo" class="form-label float-end">Logo<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input class="form-control form-control-sm @error('logo') is-invalid @enderror" type="file" id="logo" name="logo">
                                        @error('logo')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-sm btn-soft-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
