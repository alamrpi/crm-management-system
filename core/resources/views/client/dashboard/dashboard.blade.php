@extends('client.layout')

@section('title') Dashboard @endsection

@section('content')


        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex">
                                    <h4 class="card-title mb-0 col">Task Overview</h4>
                                    <div class="d-flex col-auto">
                                        <label for="" class="flex-grow-1 text-end p-1 m-0"><strong>SORT BY : </strong></label>
                                        <input type="month" class="form-control-sm float-end border-0 w-50 p-1" value="{{ date('Y-m') }}" onchange="dashboard.taskOverViewChart(0, this.value)"/>
                                    </div>
                                </div><!-- end card header -->
                                <div id="columnChartHolder">
                                    <div class="w-100 d-flex justify-content-center align-items-center h-100">
                                        <div class="spinner-border" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-12">
                                <div class="card pb-3">
                                    <div class="card-header align-items-center d-flex  border-bottom-0">
                                        <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Last Completed Tasks</h4>
                                    </div>

                                        <div id="lastCompletedTasksHolder">
                                            <div class="w-100 d-flex justify-content-center align-items-center h-100">
                                                <div class="spinner-border" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-12">
                                <div class="card pb-3">
                                    <div class="card-header align-items-center d-flex border-bottom-0">
                                        <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Next Due Tasks</h4>
                                    </div>

                                    <div id="nextDueTasksHolder">
                                        <div class="w-100 d-flex justify-content-center align-items-center h-100">
                                            <div class="spinner-border" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-0">Project Status</h4>
                        <div id="simple_pie_chartHolder">
                            <div class="w-100 d-flex justify-content-center align-items-center h-100">
                                <div class="spinner-border" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </div>
                        <div id="simple_pie_chart" data-colors='["--vz-primary", "--vz-primary-rgb, 0.85", "--vz-primary-rgb, 0.70", "--vz-primary-rgb, 0.55", "--vz-primary-rgb, 0.40"]' class="apex-charts" dir="ltr"></div>
                    </div><!-- end card-body -->
                </div><!-- end card -->

                <div class="card">
                    <div class="card-body p-3">
                        <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                            <img class="img-fluid w-60" src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/sitting-girl-with-laptop-dark.png" alt="Card girl image">
                        </div>
                        <h4 class="mb-2 pb-1">Upcoming Meeting</h4>
                        <p class="small">Meeting title will go hare.</p>
                        <div class="row mb-3 g-3">
                            <div class="col-5">
                                <div class="d-flex">
                                    <div class="avatar flex-shrink-0 me-2">
                                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar-exclamation bx-sm"></i></span>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                                        <small>22:00</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-group">
                                        <div class="avatar-group-item">
                                            <div class="avatar-xs">
                                                <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                            </div>
                                        </div>
                                        <div class="avatar-group-item">
                                            <div class="avatar-xs">
                                                <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                            </div>
                                        </div>
                                        <div class="avatar-group-item">
                                            <div class="avatar-xs">
                                                <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                            </div>
                                        </div>
                                        <div class="avatar-group-item">
                                            <div class="avatar-xs">
                                                <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="" class="rounded-circle img-fluid">
                                            </div>
                                        </div>
                                        <div class="avatar-group-item">
                                            <div class="avatar-xs">
                                                <img src="{{ asset('assets/images/users/avatar-5.jpg') }}" alt="" class="rounded-circle img-fluid">
                                            </div>
                                        </div>
                                        <div class="avatar-group-item">
                                            <div class="avatar-xs">
                                                <div class="avatar-title rounded-circle bg-light text-primary">
                                                    +10
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="javascript:void(0);" class="btn btn-primary w-100">Join the Meeting</a>
                        <div class="mt-3">
                            <table class="table table-borderless table-responsive align-middle fs-14">
                                <tbody>
                                <tr>
                                    <td>Meeting Subject</td>
                                    <td>10/01/2024</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                            +10
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Meeting Subject</td>
                                    <td>10/01/2024</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                            +10
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Meeting Subject</td>
                                    <td>10/01/2024</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-group">
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-2.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <img src="{{ asset('assets/images/users/avatar-3.jpg') }}" alt="" class="rounded-circle img-fluid">
                                                    </div>
                                                </div>
                                                <div class="avatar-group-item">
                                                    <div class="avatar-xs">
                                                        <div class="avatar-title rounded-circle bg-light text-primary">
                                                            +10
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end row -->

@endsection
@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('core/resources/js/client/Dashboard.js') }}"></script>
    <script>
        const dashboard = new Dashboard("{{ route('clientarea/api/base_url') }}");
    </script>
@endsection
