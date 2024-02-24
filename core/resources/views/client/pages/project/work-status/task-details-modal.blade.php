<div class="modal-dialog" style="width: 100%; max-width: unset;margin-top: 0;">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-xxl-3">

                    <!--end card-->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="table-card">
                                <table class="table mb-0">
                                    <tbody>
                                    <tr>
                                        <td class="fw-medium">Tasks No</td>
                                        <td>{{ $task->task_id }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Tasks Title</td>
                                        <td>{{ $task->task_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Project Name</td>
                                        <td>{{ $task->project_name }} / {{ $task->department_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Priority</td>
                                        <td><span class="badge {{ App\Constants\Priority::GetColorName($task->priority) }}">{{ App\Constants\Priority::ConvertNumberToText($task->priority) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Status</td>
                                        <td><span class="badge {{ App\Constants\TaskStatus::getBgSubTitleColor($task->status) }} {{ App\Constants\TaskStatus::getTextColor($task->status) }} ">{{ App\Constants\TaskStatus::ConvertNumberToText($task->status) }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium">Due Date</td>
                                        <td>{{ App\Utility\Helpers::ConvertDateFormat($task->due_date, "d M, Y") }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex mb-3">
                                <h6 class="card-title mb-0 flex-grow-1">Assigned To</h6>
                            </div>
                            <ul class="list-unstyled vstack gap-3 mb-0">
                                @foreach ($task->assignees as $item)
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset($item->photo) }}" alt="" class="avatar-xs rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 ms-2">
                                            <h6 class="mb-1"><a href="{{ route('clientarea/project/team/profile', ['slug'=> \App\Utility\Helpers::getParamValue('slug'), 'id' => $item->user_id]) }}" target="_blank" class="link-secondary">{{ $item->name }}</a></h6>
                                            <p class="text-muted mb-0">{{ $item->designation }}</p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <div class="dropdown">
                                                <button class="btn btn-icon btn-sm fs-16 text-muted dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ri-more-fill"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-eye-line text-muted me-2 align-bottom"></i>View Profile</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!---end col-->
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            <div>
                                <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#task-description" role="tab" aria-selected="true">
                                            Task Description
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#task-attachment" role="tab" aria-selected="false" tabindex="-1">
                                            Attachments
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#task-time" role="tab" aria-selected="false" tabindex="-1">
                                            Time Entries
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#task-activities" role="tab" aria-selected="false" tabindex="-1">
                                            Activities
                                        </a>
                                    </li>
                                    @if($task->status == App\Constants\TaskStatus::COMPlETE)
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" href="#task-submission" role="tab" aria-selected="false" tabindex="-1">
                                            Submission
                                        </a>
                                    </li>
                                    @endif
                                </ul>
                                <!--end nav-->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active show" id="task-description" role="tabpanel">
                                    <div class="text-muted">
                                        <h6 class="mb-3 fw-semibold text-uppercase">Task Description</h6>
                                        <p>{{ $task->description }}</p>
                                    </div>

                                    <div class="card-body p-0">
                                        <h5 class="card-title mb-4 fs-18">Comments</h5>
                                        <div data-simplebar="init" style="height: 508px;" class="px-3 mx-n3 mb-2 simplebar-scrollable-y">
                                            <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                                <div class="simplebar-height-auto-observer-wrapper">
                                                    <div class="simplebar-height-auto-observer"></div>
                                                </div>
                                                <div class="simplebar-mask">
                                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                                            <div class="simplebar-content" id="display-comment-placeholder" style="padding: 0px 16px;">
                                                                <!--Automatic comment generate -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="simplebar-placeholder" style="width: 1196px; height: 601px;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                            </div>
                                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                                <div class="simplebar-scrollbar" style="height: 429px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                            </div>
                                        </div>
                                        <form class="mt-4">
                                            <div class="row g-3">
                                                <div class="col-lg-12">
                                                    <label for="message" class="form-label">Leave a Comments</label>
                                                    <textarea class="form-control bg-light border-light" id="message" name="message" rows="3" placeholder="Enter comments"></textarea>
                                                </div>
                                                <!--end col-->
                                                <div class="col-12 text-end">
                                                    <input type="file" multiple name="attachments[]" id="attachments" style="display: none;">
                                                    <label for="attachments" type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></label>
                                                    <button type="button" onclick="workStatus.storeCommentHandler()" class="btn btn-soft-dark">Post Comment</button>
                                                </div>
                                            </div>
                                            <!--end row-->
                                        </form>
                                    </div>
                                </div>

                                <div class="tab-pane" id="task-attachment" role="tabpanel">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless align-middle mb-0">
                                            <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">File Name</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Size</th>
                                                <th scope="col">Upload Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($task->attachments as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="ms-3 flex-grow-1">
                                                                <h6 class="fs-15 mb-0"><a href="javascript:void(0)" onclick="common.openFileViewModel('{{ asset($item->path) }}', '{{ $item->attachment_name }}')" class="link-secondary">{{ $item->attachment_name }}</a></h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $item->extension }}</td>
                                                    <td>{{ round($item->size / 1024, 2) }} MB</td>
                                                    <td>{{ App\Utility\Helpers::ConvertDateFormat($item->created_at, "d M, Y") }}</td>
                                                    <td>
                                                        <div class="dropdown">
                                                            <a href="javascript:void(0);" class="btn btn-light btn-icon" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="true">
                                                                <i class="ri-equalizer-fill"></i>
                                                            </a>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink1" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(0px, 23px);">
                                                                <li><a class="dropdown-item" href="javascript:void(0);" onclick="common.openFileViewModel('{{ asset($item->path) }}', '{{ $item->attachment_name }}')"><i class="ri-eye-fill me-2 align-middle text-muted"></i>View</a></li>
                                                                <li><a class="dropdown-item" href="{{ asset($item->path) }}" download="{{ $item->attachment_name }}"><i class="ri-download-2-fill me-2 align-middle text-muted"></i>Download</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                          
                                            </tbody>
                                        </table>
                                        <!--end table-->
                                    </div>
                                </div>

                                <div class="tab-pane" id="task-time" role="tabpanel">
                                    <h6 class="card-title mb-4 pb-2">Time Entries</h6>
                                    <div class="table-responsive table-card">
                                        <table class="table align-middle mb-0">
                                            <thead class="table-light text-muted">
                                            <tr>
                                                <th scope="col">Member</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Hour</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($task->timeTrackers as $item)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ asset($item->photo) }}" alt="{{ $item->member_name }}" class="rounded-circle avatar-xxs">
                                                            <div class="flex-grow-1 ms-2">
                                                                <a href="{{ route('clientarea/project/team/profile', ['slug'=> \App\Utility\Helpers::getParamValue('slug'), 'id' => $item->user_id]) }}" target="_blank" class="fw-medium link-secondary">{{ $item->member_name }}</a>
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <td>{{ App\Utility\Helpers::ConvertDateFormat($item->created_at, "d M, Y") }}</td>
                                                    <td>{{implode(':',  explode('.', $item->working_hour)) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!--end table-->
                                    </div>
                                </div>

                                <div class="tab-pane" id="task-activities" role="tabpanel">
                                    <div class="acitivity-timeline py-3">
                                        @foreach ($task->activities as $item)
                                        <div class="acitivity-item d-flex">
                                            <div class="flex-shrink-0">
                                                <img src="{{ asset($item->photo) }}" alt="" class="avatar-xs rounded-circle acitivity-avatar">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">{{ $item->created_user_name }}</h6>
                                                {!! \App\Utility\Helpers::replaceUserName($item->activity, $item->created_by, $item->created_user_name) !!}
                                                <small class="mb-0 text-muted">{{ \App\Utility\Helpers::ConvertDateFormat($item->created_at, 'd/m/y h:i:s A') }}</small>
                                            </div>
                                            <br>
                                        </div>
                                        @endforeach
                                      
                                    </div>
                                </div>

                                <div class="tab-pane" id="task-submission" role="tabpanel">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Task Submission</h4>
                                            <div class="flex-shrink-0">
                                                @if($task->completed_status == App\Constants\Task\AcceptedStatus::SUBMIT)
                                                <div class="dropdown card-header-dropdown" id="accepted-status-action">
                                                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="text-muted fs-16"><i class="mdi mdi-dots-vertical align-middle"></i></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        {{-- <a class="dropdown-item" href="#">Submit</a> --}}
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="workStatus.changeStatus({{ App\Constants\Task\AcceptedStatus::REVISION }})">Revision</a>
                                                        <a class="dropdown-item" href="javascript:void(0);" onclick="workStatus.changeStatus({{ App\Constants\Task\AcceptedStatus::ACCEPT }})">Accept</a>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div data-simplebar="init" class="px-3 mx-n3 mb-2 simplebar-scrollable-y">
                                        <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                            <div class="simplebar-height-auto-observer-wrapper">
                                                <div class="simplebar-height-auto-observer"></div>
                                            </div>
                                            <div class="simplebar-mask">
                                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                                    <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                                        <div class="simplebar-content" id="submission-comment-placeholder" style="padding: 0px 16px;">
                                                            <!--Automatic comment generate -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="simplebar-placeholder" style="width: 1196px; height: 450px;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                                        </div>
                                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                            <div class="simplebar-scrollbar" style="height: 429px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                                        </div>
                                    </div>
                                    <form class="mt-4">
                                        <div class="row g-3">
                                            <div class="col-lg-12">
                                                <textarea class="form-control bg-light border-light" id="sub-message" name="message" rows="3" placeholder="Enter submission comment"></textarea>
                                            </div>
                                            <!--end col-->
                                            <div class="col-12 text-end">
                                                <input type="file" multiple name="attachments[]" id="sub-attachments" style="display: none;">
                                                <label for="attachments" type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></label>
                                                <button type="button" onclick="workStatus.storeCommentHandler(1)" class="btn btn-soft-dark">Send</button>
                                            </div>
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>

                            </div>
                            <!--end tab-content-->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
</div>