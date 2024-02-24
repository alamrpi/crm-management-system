@extends('admin.layout')

@section('title') Profile - Team Name @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Profile - Team Name</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teams</li>
                        <li class="breadcrumb-item active">Profile - Team Name</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            @include('client.shared._message')

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h1 class="fs-20">Minhaz Hosen</h1>
                            <p class="fs-13">Operation Manager (SEO Department)</p>
                            <div class="d-flex flex-column">
                                <img class="w-100" src="http://localhost/wbcrm/assets/images/users/avatar-9.jpg" alt="">
                                <div class="mt-3">
                                    <button type="button" class="px-3 me-3 btn btn-sm btn-light waves-effect text-primary border-1">F</button>
                                    <button type="button" class="px-3 me-3 btn btn-sm btn-light waves-effect text-primary border-1">In</button>
                                    <button type="button" class="px-3 me-3 btn btn-sm btn-light waves-effect text-primary border-1">Be</button>
                                    <button type="button" class="px-3 me-3 btn btn-sm btn-primary waves-effect waves-light">Download CV</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 pb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div class="d-flex flex-column justify-content-between">
                                        <div class="mb-3">
                                            <span>Total Projects:</span>
                                            <span>2</span>
                                            <span class="badge bg-secondary">WinHub</span>
                                            <span class="badge bg-secondary">Rye Tech</span>
                                        </div>
                                        <div class="d-flex mb-3">
                                            <span class="me-3">Tasks: </span>
                                            <!-- Labels Example -->
                                            <div class="progress flex-grow-1" style="height: 18px">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 83.33%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="30">25/30</div>
                                            </div>
                                        </div>
                                        <div class="mb-3 d-flex">
                                            <span class="me-3">Hours:</span>
                                            <!-- Labels Example -->
                                            <div class="progress flex-grow-1" style="height: 18px">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: 80%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="30">40/50</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="mt-3">
                                            <button type="button" class="px-3 me-3 btn btn-sm btn-primary waves-effect text-white border-1">Chat</button>
                                            <button type="button" class="px-3 me-3 btn btn-sm btn-info waves-effect text-white border-1">Send Email</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 pb-4">
                        <div class="card h-100">
                        <div class="card-body">
                            <div class="border-bottom">
                                <h1 class="fs-20 mb-3">Files</h1>
                            </div>
                            <!-- Tables Without Borders -->
                            <table class="table table-borderless table-responsive">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Size</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="" class="link-primary text-decoration-underline">Red Rose</a></td>
                                    <td>PNG</td>
                                    <td>1.3 MB</td>
                                </tr>
                                <tr>
                                    <td><a href="" class="link-primary text-decoration-underline">Beautiful River</a></td>
                                    <td>JPG</td>
                                    <td>6.1 MB</td>
                                </tr>
                                <tr>
                                    <td><a href="" class="link-primary text-decoration-underline">Novel</a></td>
                                    <td>PDF</td>
                                    <td>11.7 MB</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom">
                                <div class="fs-20 mb-3">Activities</div>
                            </div>
                            <div class="table-responsive table-card m-0">
                                <table class="table table-nowrap align-middle mb-0 table-hover">
                                    <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Employee</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Date-Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach((object)[1,2] as $row)
                                        <tr>
                                            <td class="d-flex">
                                                <img src="{{ asset($row->photo ?? '') }}" alt="{{ $row->created_user_name ?? '' }}" class="avatar-xs rounded-3 me-2">
                                                <div>
                                                    <h5 class="fs-13 mb-0">{{ $row->created_user_name ?? '' }}</h5>
                                                    <p class="fs-12 mb-0 text-muted">{{ $rows->designation ?? '' }}</p>
                                                </div>
                                            </td>
                                            <td>
                                                {!! $row->activity ?? '' !!}
                                            </td>
                                            <td>{{ \App\Utility\Helpers::ConvertDateFormat($row->created_at ?? '', 'd/m/y h:i:s A') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
