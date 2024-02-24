@extends('client.layout')

@section('title') Integrated Report @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav">
                    <li>
                        <a class="nav-link fw-semibold active fs-16" href="#">
{{--                            <i class="ri-list-unordered mt-1 position-relative" style="top: 2px;"></i>--}}
                            Organic Result
                        </a>
                    </li>
                    <li>
                        <a class="nav-link fw-semibold fs-16" href="#">
{{--                            <i class="ri-calendar-line mt-1 position-relative" style="top: 2px;"></i>--}}
                            Paid Result
                        </a>
                    </li>
                </ul>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('clientarea/project/dashboard', ['slug'=>$current_project['slug']]) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Reports</li>
                        <li class="breadcrumb-item active">Integrated Report</li>
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
                <div class="col-md-3">
                    <div class="card bg-success-subtle">
                        <div class="card-body">
                            <h4 class="card-title fs-22">Total Sales</h4>
                            <h1 class="fs-48 my-3">890</h1>
                            <div class="d-flex justify-content-between">
                                <span class="text-success">+1.8%</span>
                                <span>+3.8k this week</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning-subtle">
                        <div class="card-body">
                            <h4 class="card-title fs-22">Traffic</h4>
                            <h1 class="fs-48 my-3">1.294</h1>
                            <div class="d-flex justify-content-between">
                                <span class="text-success">+23.7%</span>
                                <span>+3.8k this week</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-primary-subtle">
                        <div class="card-body">
                            <h4 class="card-title fs-22">Total lead</h4>
                            <h1 class="fs-48 my-3">890</h1>
                            <div class="d-flex justify-content-between">
                                <span class="text-success">+1.8%</span>
                                <span>+3.8k this week</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger-subtle">
                        <div class="card-body">
                            <h4 class="card-title fs-22">Ranking Keyword</h4>
                            <h1 class="fs-48 my-3">890</h1>
                            <div class="d-flex justify-content-between">
                                <span class="text-danger">+1.8%</span>
                                <span>+3.8k this week</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                       <div class="row">
                           <div class="col-md-7">
                               <div class="card-body">
                                   <div class="d-flex">
                                       <h4 class="card-title mb-0 col">Traffic Status</h4>
                                       <div class="col-auto">
                                           <select class="form-control form-control-sm float-end border-0 p-1" name="year">
                                               <option selectd>2023</option>
                                           </select>
                                       </div>
                                   </div><!-- end card header -->
                                   <div class="card-body">
                                       <div id="traffic_overview"></div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-md-5">
                               <div class="card-body">
                                   <div class="d-flex">
                                       <h4 class="card-title mb-0 col">Traffic By Devices</h4>
                                       <div class="col-auto">
                                           <select class="form-control form-control-sm float-end border-0 p-1" name="year">
                                               <option selectd>2023</option>
                                           </select>
                                       </div>
                                   </div><!-- end card header -->
                               </div>
                               <div class="card-body">
                                    <div class="w-75 m-auto">
                                        <div id="trafficByDevices"></div>
                                    </div>
                               </div>
                           </div>
                       </div>
                    </div>
                </div> <!-- end col -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row">

                            <div class="col-md-7">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h4 class="card-title mb-0 col">Ranking Overview</h4>
                                    </div><!-- end card header -->
                                    <div class="d-flex">
                                        <div class="flex-grow-1" id="rankingOberviewChart"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <h4 class="card-title mb-3 col">Keyword List</h4>
                                    </div><!-- end card header -->
                                    <table class="table table-striped">
                                        <thead>
                                        <tr class="table-light">
                                            <th>Keyword</th>
                                            <th class="text-center">Position</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Business Development Training</td>
                                            <td class="text-center">3</td>
                                        </tr>
                                        <tr>
                                            <td>PMO Consulting</td>
                                            <td class="text-center">1</td>
                                        </tr>
                                        <tr>
                                            <td>Business Development Consulting</td>
                                            <td class="text-center">2</td>
                                        </tr>
                                        <tr>
                                            <td>Product Development Consulting</td>
                                            <td class="text-center">4</td>
                                        </tr>
                                        <tr>
                                            <td>Program Management Consulting</td>
                                            <td class="text-center">5</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-start">
                                        <a href="javascript:void(0)" role="button" class="btn btn-link waves-effect text-decoration-underline">View All Keywords</a>
                                    </div>
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
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        var options = {
            series: [{
                data: [13, 23, 27, 32, 49, 46, 52, 71, 66, 92, 84, 98],
                label: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug','Sep','Oct','Nov','Dec']
            }],
            chart: {
                type: 'line',
                height: 350,
                stacked: true,
                toolbar: { show: false }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug','Sep','Oct','Nov','Dec'],
            },
            fill: {
                opacity: 1
            },
            legend: {
                position: 'bottom',
                offsetX: 0,
                offsetY: 0
            },
            markers: {
                size: 5,
            }
        };

        new ApexCharts(document.querySelector("#traffic_overview"), options).render();

        options = {
            series: [44, 55, 41, 17],
            labels: ['Mobile', 'Desktop', 'Tab', 'Unknown'],
            chart: {
                type: 'donut'
            },
            legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
            }
        }

        new ApexCharts(document.querySelector("#trafficByDevices"), options).render();

        options = {
            series: [{
                data: [13, 23, 27, 32, 49, 46,32, 52, 32, 49, 46, 52],
            }],
            chart: {
                type: 'area',
                height: 350,
                stacked: true,
                toolbar: { show: false }
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    legend: {
                        position: 'bottom',
                        offsetX: -10,
                        offsetY: 0
                    }
                }
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                    'Jul', 'Aug','Sep','Oct','Nov','Dec'],
            },
            fill: {
                opacity: 1
            },
            stroke: {
                curve: 'smooth',
            },
            dataLabels: {
                enabled: false
            },
        };
        new ApexCharts(document.querySelector("#rankingOberviewChart"), options).render();

    </script>
@endsection
