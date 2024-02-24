@extends('admin.layout')

@section('title') Request Details @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Request Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row mt-1">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <p><a href="{{ route('admin/request/index') }}"><i class="mdi mdi-arrow-left"></i> Back</a></p>
                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Subject</h5>
                    <p class="text-muted fs-12">Request subject here</p>

                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Requested By</h5>
                    <p class="text-muted fs-12">Mr. ABC</p>

                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Requested Date</h5>
                    <p class="text-muted fs-12">{{ date('m/d/Y H:i') }}</p>

                    <h5 class="fs-12 fw-semibold text-uppercase border-bottom pb-2 mb-1">Status</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning btn-sm">PENDING</button>
                        <button type="button" class="btn btn-warning btn-sm dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item text-success" href="#">Approve</a>
                            <a class="dropdown-item text-danger" href="#">Deny</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div class="accordion accordion-flush">
                        <div class="accordion-item border-dashed left">
                            <div class="accordion-header">
                                <a role="button" class="btn w-100 text-start px-0 bg-transparent shadow-none collapsed" data-bs-toggle="collapse" href="#email-collapseOne" aria-expanded="false" aria-controls="email-collapseOne">
                                    <div class="d-flex align-items-center text-muted">
                                        <div class="flex-shrink-0 avatar-xs me-3">
                                            <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="fs-14 text-truncate email-user-name mb-0">Web Support Dennis</h5>
                                            <div class="text-truncate fs-12">to: me</div>
                                        </div>
                                        <div class="flex-shrink-0 align-self-start">
                                            <div class="text-muted fs-12">09 Jan 2022, 11:12 AM</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div id="email-collapseOne" class="accordion-collapse collapse" style="">
                                <div class="accordion-body text-body px-0">
                                    <div>
                                        <p>Dear [Admin's Name],</p>

                                        <p>I am writing to request mail permission for [Software Name]. I need this permission to send notifications to users about their software access status.</p>

                                        <p>[Software Name] is a [Brief description of the software]. It is used by [List of users who use the software].</p>

                                        <p>The notifications will be sent to users to inform them of the following:</p>

                                        <ul>
                                            <li>When their software access has been approved or denied</li>
                                            <li>When their software access is about to expire</li>
                                            <li>When there are important updates to the software</li>
                                        </ul>

                                        <p>I will only send notifications to users who have consented to receive them. I will also make sure that the notifications are relevant and timely.</p>

                                        <p>I understand that granting mail permission is a serious decision. I assure you that I will use this permission responsibly and only for the purposes of sending software access notifications.</p>

                                        <p>Thank you for your time and consideration.</p>

                                        <p>Sincerely,</p>
                                        <p>[Your Name]</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion-item -->

                        <div class="accordion-item border-dashed right">
                            <div class="accordion-header">
                                <a role="button" class="btn w-100 text-start px-0 bg-transparent shadow-none collapsed" data-bs-toggle="collapse" href="#email-collapseTwo" aria-expanded="false" aria-controls="email-collapseTwo">
                                    <div class="d-flex align-items-center text-muted">
                                        <div class="flex-shrink-0 avatar-xs me-3">
                                            <img src="{{ asset('assets/images/users/avatar-1.jpg') }}" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="fs-14 text-truncate email-user-name-right mb-0">Anna Adame</h5>
                                            <div class="text-truncate fs-12">to: jackdavis@email.com</div>
                                        </div>
                                        <div class="flex-shrink-0 align-self-start">
                                            <div class="text-muted fs-12">09 Jan 2022, 02:15 PM</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div id="email-collapseTwo" class="accordion-collapse collapse" style="">
                                <div class="accordion-body text-body px-0">
                                    <div>
                                        <p>Hi,</p>
                                        <p>If several languages coalesce, the grammar of the resulting language is more simple and regular than that of the individual.</p>
                                        <p>Thank you</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end accordion-item -->

                        <div class="accordion-item border-dashed left">
                            <div class="accordion-header">
                                <a role="button" class="btn w-100 text-start px-0 bg-transparent shadow-none collapsed" data-bs-toggle="collapse" href="#email-collapseThree" aria-expanded="false" aria-controls="email-collapseThree">
                                    <div class="d-flex align-items-center text-muted">
                                        <div class="flex-shrink-0 avatar-xs me-3">
                                            <img src="{{ asset('assets/images/users/avatar-4.jpg') }}" alt="" class="img-fluid rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <h5 class="fs-14 text-truncate email-user-name mb-0">Web Support Dennis</h5>
                                            <div class="text-truncate fs-12">to: me</div>
                                        </div>
                                        <div class="flex-shrink-0 align-self-start">
                                            <div class="text-muted fs-12">10 Jan 2022, 10:08 AM</div>
                                        </div>
                                    </div>
                                </a>
                            </div>

                            <div id="email-collapseThree" class="accordion-collapse collapse" style="">
                                <div class="accordion-body text-body px-0">
                                    <div>
                                        <p>Hi,</p>
                                        <p>Everyone realizes why a new common language would be desirable: one could refuse to pay expensive translators. To achieve this, it would be necessary to have uniform grammar pronunciation.</p>
                                        <p>Thank you</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-auto">
                            <form class="mt-2">
                                <div>
                                    <label for="exampleFormControlTextarea1" class="form-label">Reply :</label>
                                    <textarea class="form-control border-bottom-0 rounded-top rounded-0 border" id="exampleFormControlTextarea1" rows="3" placeholder="Enter message"></textarea>
                                    <div class="bg-light px-2 py-1 rouned-bottom border">
                                        <div class="row">
                                            <div class="col">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Bold" data-bs-original-title="Bold"><i class="ri-bold align-bottom"></i></button>
                                                    <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Italic" data-bs-original-title="Italic"><i class="ri-italic align-bottom"></i></button>
                                                    <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Link" data-bs-original-title="Link"><i class="ri-link align-bottom"></i></button>
                                                    <button type="button" class="btn btn-sm py-0 fs-15 btn-light" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Image" data-bs-original-title="Image"><i class="ri-image-2-line align-bottom"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-auto"><button type="button" class="btn btn-sm btn-success"><i class="ri-send-plane-2-fill align-bottom"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
