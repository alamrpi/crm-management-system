@extends('admin.layout')

@section('title') All Client @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Client</li>
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
                    <form action="{{ route('admin/client/index') }}" method="get">
                        <div class="row g-2 mb-4">
                            <div class="col-sm-6">
                                <div class="search-box">
                                    <input type="text" value="{{ request()->input('name') }}" id="name" name="name" class="form-control form-control-sm search" placeholder="Client name">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="row job-list-row" id="candidate-list">
                        @foreach($rows as $row)
                            <div class="col-xxl-3 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="avatar-lg rounded"><img src="{{ asset($row->photo) }}"
                                                                                    alt="{{$row->name}}"
                                                                                    class="member-img img-fluid d-block rounded">
                                                </div>
                                                <div class="col-lg mt-2 text-end">
                                                    <a href="#" class="btn btn-sm btn-soft-primary btn-icon waves-effect"><i class="ri-eye-line"></i></a>
                                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_EDIT)
                                                    <a href="{{ Route('admin/client/edit', ['id'=> $row->id]) }}" class="btn btn-sm btn-soft-warning btn-icon waves-effect"><i class="ri-edit-line"></i></a>
                                                    @endcan
                                                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_DELETE)
                                                    <a href="{{ Route('admin/client/delete', ['id'=> $row->id]) }}" class="confirm-alert btn btn-sm btn-soft-danger btn-icon waves-effect"><i class="ri-delete-bin-line"></i></a>
                                                    @endcan
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3"><a href="#"><h5
                                                        class="fs-16 mb-1">{{$row->name}}</h5></a>
                                                <p class="text-muted mb-2">{{$row->email}}</p>
                                                <div class="d-flex flex-wrap gap-2 align-items-center text-muted">
                                                    <a href="{{ $row->website }}" target="_blank">{{$row->company_name}}</a>
                                                </div>
                                                <div class="d-flex gap-4 mt-2 text-muted">
                                                    <div><i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i>
                                                        {{$row->address}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="row g-0 justify-content-end mb-4" id="pagination-element">
                        <!-- end col -->
                        <div class="col-sm-6">
                            {{$rows->links()}}
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
