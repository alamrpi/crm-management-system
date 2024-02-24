@extends('admin.layout')

@section('title') Dashboard | Admin @endsection

@section('content')
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-money-dollar-circle-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">Revenue</p>
                                    <h4 class=" mb-0">$<span class="counter-value" data-target="2390.68">2,390.68</span>
                                    </h4>
                                </div>
                            </div>

                            <table class="table table-sm table-centered align-middle table-nowrap mb-0 mt-3">
                                <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-14 mb-0">Oct</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$48,568.025</td>
                                    <td>
                                        <h6 class="text-success fs-13 mb-0"><i class="mdi mdi-trending-up align-middle me-1"></i>5%
                                        </h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-14 mb-0">Nov</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$87,142.027</td>
                                    <td>
                                        <h6 class="text-danger fs-13 mb-0"><i class="mdi mdi-trending-down align-middle me-1"></i>10%
                                        </h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div>
                                                <h6 class="fs-14 mb-0">Dec</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>$48,568.025</td>
                                    <td>
                                        <h6 class="text-success fs-13 mb-0"><i class="mdi mdi-trending-up align-middle me-1"></i>15%
                                        </h6>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div><!-- end card -->
                </div>
                <div class="col-6">
                    <div class="card" id="projectCounterHolder">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm flex-shrink-0">
                                    <span
                                        class="avatar-title bg-light text-primary rounded-circle fs-3">
                                        <i class="ri-line-chart-fill align-middle"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                                        Total Projects</p>
                                    <h4 class=" mb-0" id="totalProjectCount">
                                        <div class="spinner-border spinner-border-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </h4>
                                </div>

                            </div>

                            <div class="mt-3">
                                <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-1">
                                    <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-success align-middle me-2"></i> Completed</p>
                                    <div>
                                        <span class="text-muted pe-5" id="completedProjectCount">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </span>
                                    </div>
                                </div><!-- end -->
                                <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-1">
                                    <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-primary align-middle me-2"></i> In Progress</p>
                                    <div>
                                        <span class="text-muted pe-5" id="inProgressProjectCount">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </span>
                                    </div>
                                </div><!-- end -->
                                <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-1">
                                    <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-warning align-middle me-2"></i> Not Started Yet</p>
                                    <div>
                                        <span class="text-muted pe-5" id="notStartedProjectCount">
                                            <div class="spinner-border spinner-border-sm" role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card pb-3">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Over Due Tasks <span class="badge bg-danger" id="overDueCount">...</span></h4>
                        </div>

                        <div id="overDueTaskHolder">
                            <div class="card-body py-0">
                                <div class="card card-animate border border-1 mb-1">
                                    <div class="card-body">
                                        <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 50px">
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

            <div class="row">
                <div class="col-12">
                    <div class="card pb-3">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Next Due Tasks <span class="badge bg-warning" id="nextDueCount">..</span></h4>
                        </div>
                        <div id="nextDueTasksHolder">
                            <div class="card-body py-0">
                                <div class="card card-animate border border-1 mb-1">
                                    <div class="card-body">
                                        <div class="w-100 d-flex justify-content-center align-items-center" style="min-height: 50px">
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
        </div>

        <div class="col-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Client's Feedbacks</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive bg-white">
                                <table class="table table-sm fs-12 table-borderless table-hover">
                                    <thead class="text-muted fs-12">
                                    <tr class="table-light">
                                        <th>TYPE</th>
                                        <th>CLIENT</th>
                                        <th>DATE</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#feedbackModal"><span class="badge bg-primary-subtle text-success">REVIEW</span></a></td>
                                            <td>Stephanie Ellis</td>
                                            <td>{{ date('m/d/Y H:i') }}</td>
                                        </tr>

                                        <tr>
                                            <td><span class="badge bg-success-subtle text-success">REVIEW</span></td>
                                            <td>Tori Hull</td>
                                            <td>{{ date('m/d/Y H:i') }}</td>
                                        </tr>

                                        <tr>
                                            <td><span class="badge bg-danger-subtle text-danger">COMPLAINT</span></td>
                                            <td>Jon Dessen</td>
                                            <td>{{ date('m/d/Y H:i') }}</td>
                                        </tr>

                                        <tr>
                                            <td><span class="badge bg-primary-subtle text-primary">SUGGESTION</span></td>
                                            <td>Mark Milleker</td>
                                            <td>{{ date('m/d/Y H:i') }}</td>
                                        </tr>

                                        <tr>
                                            <td><span class="badge bg-success-subtle text-success">REVIEW</span></td>
                                            <td>Nate Crochunis</td>
                                            <td>{{ date('m/d/Y H:i') }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="pt-1 text-end fs-12">
                                <a href="{{ route('admin/feedbacks') }}" class="text-muted text-decoration-underline">View More Feedbacks</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Performance: Manager</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive bg-white">
                                <table class="table table-sm fs-12 table-borderless table-hover">
                                    <thead class="text-muted fs-12">
                                    <tr class="table-light">
                                        <th class="text-center">#</th>
                                        <th>NAME</th>
                                        <th class="text-center">PER.</th>
                                        <th class="text-center">PROJECT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i=0; $i<3; $i++)
                                    <tr>
                                        <td class="text-center">{{ $i }}</td>
                                        <td>Minhaz Hosen</td>
                                        <td class="text-center"><a href="#">83%</a></td>
                                        <td class="text-center"><a href="#">4</a></td>
                                    </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="text-uppercase fw-semibold fs-12 text-muted mb-0 flex-grow-1">Performance: Executive</h4>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive bg-white">
                                <table class="table table-sm fs-12 table-borderless table-hover">
                                    <thead class="text-muted fs-12">
                                    <tr class="table-light">
                                        <th class="text-center">#</th>
                                        <th>NAME</th>
                                        <th class="text-center">PER.</th>
                                        <th class="text-center">PROJECT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @for($i=0; $i<6; $i++)
                                        <tr>
                                            <td class="text-center">{{ $i }}</td>
                                            <td>Shafkat Hamim</td>
                                            <td class="text-center"><a href="#">55%</a></td>
                                            <td class="text-center"><a href="#">6</a></td>
                                        </tr>
                                    @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal custom-modal" id="feedbackModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="width: 60% !important;">
            <div class="modal-content">
                <div class="modal-header pb-3 align-items-center d-flex">
                    <h4 class="modal-title mb-0 flex-grow-1 fs-14">Details: <span class="text-muted">Client's feedback</span></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-light-subtle">
                    <div class="card border border-1">
                        <div class="card-body fs-16">
                            <h5 class="fs-15 fw-semibold">Type: <span class="badge bg-primary-subtle text-success">REVIEW</span></h5>
                            <h5 class="fs-15 fw-semibold">Date: <span class="text-muted fw-normal">{{ date('m/d/Y H:i') }}</span></h5>
                            <h5 class="fs-15 fw-semibold">Client: <span class="text-muted fw-normal">Client A</span></h5>
                            <h5 class="fs-15 fw-semibold">Project: <span class="text-muted fw-normal">Project AAA</span></h5>
                            <h5 class="fs-15 fw-semibold mt-3 border-bottom pb-2">Details</h5>
                            I am very pleased with the work that [Contractor name] did on our project. They were professional, responsive, and always went the extra mile to meet our needs. I would highly recommend them to anyone looking for a reliable and experienced contractor.
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('admin.pages.project.task.details-modal')
@endsection

@section('script')
    <script src="{{ asset('core/resources/js/Dashboard.js') }}"></script>
    <script src="{{ asset('core/resources/js/Task.js') }}"></script>
    <script>
        const dashboard = new Dashboard(0, 'admin');
        dashboard.loadAdminDashboard();
    </script>
@endsection
