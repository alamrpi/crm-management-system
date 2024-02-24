@extends('admin.layout')

@section('title') Edit Service @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Department</li>
                        <li class="breadcrumb-item active">Service</li>
                        <li class="breadcrumb-item active">Edit Service</li>
                    </ol>
                </div>
            </div>
        </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header p-2">
                    @include('admin.pages.department._menu')
                </div>
                <div class="card-body p-4">
                    @include('super-admin.shared._message')
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="{{route('admin/department/service/update', ['id' => $service->id])}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="name" class="form-label float-end">Service Name<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" class="form-control @error('service_name') is-invalid @enderror" id="service_name" name="service_name" value="{{ $service->service_name }}" required>
                                        @error('service_name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3 text-right">
                                    <div class="col-lg-3">
                                        <label for="department_id" class="form-label float-end">Department<span class="text-danger">*</span> :</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select name="department_id" id="department_id" class="form-select" required>
                                            <option value="">-- Select --</option>
                                           @foreach($departments as $department)
                                                <option value="{{$department->id}}" {{ $service->department_id == $department->id ? 'selected' : '' }}>{{$department->name}}</option>
                                           @endforeach
                                        </select>
                                        @error('department_id')
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
