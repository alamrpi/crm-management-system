@extends('admin.layout')

@section('title') All Requests @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Requests</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @include('super-admin.shared._message')
                    <form action="#" method="get">
                        <div class="row g-2 mb-2">
                            <div class="col-sm-6">
                                <div class="search-box">
                                    <input type="text" value="{{ request()->input('name') }}" id="name" name="name" class="form-control form-control-sm search" placeholder="Subject">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-lg-auto">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="card border border-1 mb-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 align-items-center d-flex">
                                    <h5 class="fs-14 fw-semibold flex-grow-1"><a href="{{ route('admin/request/details', ['id'=>1]) }}">Request subject one</a></h5>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted"><i class="ri-settings-4-line align-middle me-1 fs-15"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::REQUEST_VIEW)
                                                    <a class="dropdown-item" href="{{ route('admin/request/details', ['id'=>1]) }}">View</a>
                                                @endcan
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::REQUEST_APPROVE)
                                                    <a class="dropdown-item" href="#">Approve</a>
                                                @endcan
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::REQUEST_DENY)
                                                    <a class="dropdown-item" href="#">Deny</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Requested By</p>
                                    Mr. ABC

                                    <a class="btn btn-link" data-bs-toggle="popover" data-bs-placement="bottom" data-bs-content-id="popover-content" tabindex="0" role="button">
                                        Open Popover
                                    </a>

                                    <div id="popover-content" class="d-none">
                                        Popover content with <strong>HTML</strong>.
                                    </div>


                                </div>
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Requested Date</p>
                                    {{ date('m/d/Y H:i') }}
                                </div>
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Status</p>
                                    <span class="badge bg-warning-subtle text-warning">PENDING</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border border-1 mb-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 align-items-center d-flex">
                                    <h5 class="fs-14 fw-semibold flex-grow-1"><a href="{{ route('admin/request/details', ['id'=>1]) }}">Request subject two</a></h5>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted"><i class="ri-settings-4-line align-middle me-1 fs-15"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="{{ route('admin/request/details', ['id'=>1]) }}">View</a>
                                                <a class="dropdown-item" href="#">Approve</a>
                                                <a class="dropdown-item" href="#">Deny</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Requested By</p>
                                    Mr. XYZ
                                </div>
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Requested Date</p>
                                    {{ date('m/d/Y H:i') }}
                                </div>
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Status</p>
                                    <span class="badge bg-success-subtle text-success">APPROVED</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border border-1 mb-1">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 align-items-center d-flex">
                                    <h5 class="fs-14 fw-semibold flex-grow-1"><a href="{{ route('admin/request/details', ['id'=>1]) }}">Request subject three</a></h5>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted"><i class="ri-settings-4-line align-middle me-1 fs-15"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::REQUEST_VIEW)
                                                <a class="dropdown-item" href="{{ route('admin/request/details', ['id'=>1]) }}">View</a>
                                                @endcan
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::REQUEST_APPROVE)
                                                <a class="dropdown-item" href="#">Approve</a>
                                                @endcan
                                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::REQUEST_DENY)
                                                <a class="dropdown-item" href="#">Deny</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Requested By</p>
                                    Mr. MNO
                                </div>
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Requested Date</p>
                                    {{ date('m/d/Y H:i') }}
                                </div>
                                <div class="col-4 fs-12">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Status</p>
                                    <span class="badge bg-danger-subtle text-danger">DENIED</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const list = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
        list.map((el) => {
            let opts = {
                animation: false,
            }
            if (el.hasAttribute('data-bs-content-id')) {
                opts.content = document.getElementById(el.getAttribute('data-bs-content-id')).innerHTML;
                opts.html = true;
            }
            new bootstrap.Popover(el, opts);
        })
    </script>
@endsection
