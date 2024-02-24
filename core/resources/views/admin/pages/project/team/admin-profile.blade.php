@extends('admin.layout')

@section('title') Profile - Minhaz Hosen @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Profile - Minhaz Hosen</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teams</li>
                        <li class="breadcrumb-item active">Profile - Minhaz Hosen</li>
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
                    <div class="h-100 pb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <h1 class="fs-20 mb-0">Minhaz Hosen</h1>
                                <p class="fs-16 text-muted mt-0">Operation Manager (SEO Department)</p>
                                <div class="d-flex flex-column">
                                    <img class="w-100" src="http://localhost/wbcrm/assets/images/landing/profile-pic.png" alt="">
                                    <div class="mt-3">
                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                            <div class="btn-group me-2" role="group" aria-label="First group">
                                                <button type="button" class="btn btn-light text-primary"><i class="ri-facebook-fill"></i></button>
                                                <button type="button" class="btn btn-light text-primary"><i class="ri-linkedin-fill"></i></button>
                                                <button type="button" class="btn btn-light text-primary"><i class="ri-behance-fill"></i></button>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="Second group">
                                                <button type="button" class="btn btn-light text-primary">Download CV</button>
                                            </div>
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
                                <div class="d-flex flex-column justify-content-between h-100">
                                    <div class="d-flex flex-column justify-content-between mt-3">
                                        <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Total Projects: <span class="text-muted">50</span></h5>
                                        <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Running Projects: <span class="text-muted">2</span></h5>
                                        <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Completed Tasks: <span class="text-muted">200</span></h5>
                                        <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Working Hours: <span class="text-muted">420</span></h5>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="mt-3">
                                            <button type="button" class="px-3 me-2 btn btn-primary waves-effect text-white border-1"><i class="ri-chat-3-line position-relative" style="top:2px;"></i> Chat</button>
                                            <button type="button" class="px-3 me-2 btn btn-primary waves-effect text-white border-1"><i class="ri-send-plane-line position-relative" style="top:2px;"></i> Send Email</button>
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
                                    <h1 class="fs-20 mb-3">Performance</h1>
                                </div>
                                <!-- Tables Without Borders -->
                                <div id="performance_pie_chart" data-colors='["--vz-primary", "--vz-primary-rgb, 0.85", "--vz-primary-rgb, 0.70", "--vz-primary-rgb, 0.55", "--vz-primary-rgb, 0.40"]' class="apex-charts mt-3" dir="ltr"></div>
                                <div class="">
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Attendance: <span class="text-muted">90%</span></h5>
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Ontime Delivery: <span class="text-muted">80%</span></h5>
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Work Quality: <span class="text-muted">95%</span></h5>
                                    <h5 class="fs-14 fw-semibold text-uppercase border-bottom pb-2 mb-1">Extra Curriculum Activity: <span class="text-muted">95%</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom">
                                <div class="fs-20 mb-3">Employee Details</div>
                            </div>
                            <div class="card-body">
                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Name</h5>
                                <p class="text-muted fs-12">Mr. Minhaz Hosen</p>

                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Designation</h5>
                                <p class="text-muted fs-12">Marketing Executive</p>

                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Join Date</h5>
                                <p class="text-muted fs-12">12/14/2023 12:15</p>

                                <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">More Info Will Go Here</h5>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom">
                                <div class="fs-20 mb-3">Activities</div>
                            </div>
                            <div class="table-responsive table-card m-0">
                                <table class="table table-nowrap align-middle mb-0 table-hover">
                                    <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Project</th>
                                        <th scope="col">Activity</th>
                                        <th scope="col">Date-Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>

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

@section('script')
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [70, 30],
            chart: { height: 300, type: "pie" },
            labels: ["Completed", "Incomplete"],
            legend: { position: "top" },
            colors: [
                '#12436D',
                '#F46A25'
            ],
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + ' %';
                },
            }
        };
        chart = new ApexCharts(document.querySelector("#performance_pie_chart"), options).render();
    </script>
@endsection
