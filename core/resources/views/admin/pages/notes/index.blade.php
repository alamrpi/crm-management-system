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
                        <li class="breadcrumb-item active">Notes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            @include('super-admin.shared._message')
            <div class="card-header p-2 show">
                <div class="d-flex mb-3">
                    <h3 class="card-title fs-24 mb-0 col">Notes</h3>
                    <div class="col-auto d-flex flex-row">
                        <a href="javascript:void(0)" class="btn btn-primary btn-sm me-2">Add Notes</a>
                        <div>
                            <div class="form-icon">
                                <form action="">
                                    <input type="text" name="search" class="form-control form-control-icon form-control-sm" id="search" placeholder="Search...">
                                    <i class="ri-search-2-line"></i>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- end card header -->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card border">
                <div class="card-header">
                    <div class="border-bottom border-1">
                        <h6 class="card-title mb-3">Note Title</h6>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="card-content mb-3 overflow-hidden" style="height: 87px">
                        <p class="card-text">They all have something to say beyond the words on the page. They can come across as casual or neutral, exotic or graphic. Cosby sweater eu banh mi, qui irure terry richardson ex squid.</p>
                    </div>
                    <div class="text-muted d-flex justify-content-between align-items-center">
                        <div class="">Dec 2030</div>
                        <div class="" style="transform: rotate(360deg);">
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-success fs-20 py-0 px-1-2"><i class="mdi mdi-microsoft-excel"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-primary fs-20 py-0 px-1-2"><i class="mdi mdi-microsoft-word"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-danger fs-20 py-0 px-1-2"><i class="mdi mdi-file-pdf-box"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-success fs-20 py-0 px-1-2"><i class="mdi mdi-file-jpg-box"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border">
                <div class="card-header">
                    <div class="border-bottom border-1">
                        <h6 class="card-title mb-3">Note Title</h6>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="card-content mb-3 overflow-hidden" style="height: 87px">
                        <p class="card-text">They all have something to say beyond the words on the page. They can come across as casual or neutral, exotic or graphic. Cosby sweater eu banh mi, qui irure terry richardson ex squid.</p>
                    </div>
                    <div class="text-muted d-flex justify-content-between align-items-center">
                        <div class="">Dec 2030</div>
                        <div class="" style="transform: rotate(360deg);">
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-success fs-20 py-0 px-1-2"><i class="mdi mdi-microsoft-excel"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-primary fs-20 py-0 px-1-2"><i class="mdi mdi-microsoft-word"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-danger fs-20 py-0 px-1-2"><i class="mdi mdi-file-pdf-box"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-success fs-20 py-0 px-1-2"><i class="mdi mdi-file-jpg-box"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border">
                <div class="card-header">
                    <div class="border-bottom border-1">
                        <h6 class="card-title mb-3">Note Title</h6>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="card-content mb-3 overflow-hidden" style="height: 87px">
                        <p class="card-text">They all have something to say beyond the words on the page. They can come across as casual or neutral, exotic or graphic. Cosby sweater eu banh mi, qui irure terry richardson ex squid.</p>
                    </div>
                    <div class="text-muted d-flex justify-content-between align-items-center">
                        <div class="">Dec 2030</div>
                        <div class="" style="transform: rotate(360deg);">
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-success fs-20 py-0 px-1-2"><i class="mdi mdi-microsoft-excel"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-primary fs-20 py-0 px-1-2"><i class="mdi mdi-microsoft-word"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-danger fs-20 py-0 px-1-2"><i class="mdi mdi-file-pdf-box"></i></a>
                            <a href="javascript:void(0)" class="btn-sm btn btn-ghost-dark waves-effect waves-light text-success fs-20 py-0 px-1-2"><i class="mdi mdi-file-jpg-box"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <!-- Striped Rows -->
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Note Title</th>
                                <th scope="col">Note Description</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Note Title Bobby Davis Christopher Neal</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                <td class="text-nowrap">Nov 14, 2021</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Christopher Neal</td>
                                <td>Consectetur ipsam soluta ullam? distinctio eligendi magni repellat sapiente voluptas!</td>
                                <td class="text-nowrap">Nov 21, 2021</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Monkey Karry</td>
                                <td> At aut beatae iste pariatur rerum. Modi.amet, consectetur adipisicing elit.</td>
                                <td class="text-nowrap">Nov 24, 2021</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Aaron James</td>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</td>
                                <td class="text-nowrap">Nov 25, 2021</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
