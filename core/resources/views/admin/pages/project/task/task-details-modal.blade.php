
<div class="modal-dialog modal-lg" style="z-index: 99; position: relative;">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Project Name / Task: <span class="text-muted" id="dt_task_name">{{ $task->project_name }} / {{ $task->task_name }}</span></h4>
            <div class="flex-shrink-0">
                <div class="dropdown card-header-dropdown">
                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted fs-18"><i class="ri-settings-4-line align-middle me-1 fs-18"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        @include('admin.pages.project.task.inc._task-actions')
                    </div>
                </div>
            </div>
            <button type="button" class="btn-close" onclick="location.reload()"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav mb-2 float-end" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-semibold active" href="javascript:void(0);">
                                Details
                            </a>
                        </li>
                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_IN_REVIEW)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link fw-semibold" href="javascript:void(0);" id="tab-review" style="display: {{ $task->status == \App\Constants\TaskStatus::COMPlETE ? 'block' : 'none' }}" onclick="task.openReviewModal()">
                                    In Review
                                </a>
                            </li>
                        @endcan
                        @if($task->in_review === 1)
                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_SUBMIT)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link fw-semibold" href="javascript:void(0);" id="tab-submission" onclick="task.openSubmissionModal()">
                                        Submission
                                    </a>
                                </li>
                            @endcan
                        @endif
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control wb-task-title-fld" oninput="task.taskNameInputHandler(this)" onblur="task.taskNameBlurHandle(this)" value="{{ $task->task_name }}">
                        <p><span>{{ $task->department_name }}</span> | <span>{{ $task->service_name }}</span></p>
                        <table class="table table-responsive table-sm table-borderless mt-3">
                            <tr>
                                <td>
                                    <p class="wb-task-status-label mb-2">Status</p>
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" id="status-btn" class="btn {{ \App\Constants\TaskStatus::getBtnColor($task->status) }} btn-sm">
                                        {{ strtoupper(\App\Constants\TaskStatus::ConvertNumberToText($task->status)) }}
                                    </a>
                                    @if($task->completed_status != 0)
                                        <span class="badge {{ \App\Constants\Task\AcceptedStatus::getBgColor($task->completed_status) }} text-uppercase">{{ strtoupper(\App\Constants\Task\AcceptedStatus::ConvertNumberToText($task->completed_status)) }}</span>
                                    @endif
                                    <ul class="dropdown-menu dropdown-menu-start" style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(-77px, -155px);" data-popper-placement="top-end" data-popper-reference-hidden="">
                                        @include('admin.pages.project.task.inc._task-statuses', ['is_details' => 1])
                                    </ul>
                                </td>
                                <td>
                                    <p class="wb-task-status-label mb-2">Priority</p>
                                    <span class="badge {{ \App\Constants\Priority::getBgColor($task->priority) }} text-uppercase">{{ strtoupper(\App\Constants\Priority::ConvertNumberToText($task->priority)) }}</span>
                                </td>
                                <td>
                                    <p class="wb-task-status-label mb-2">Assigned To</p>
                                    @include('admin.pages.project.task.inc._assignee')
                                </td>
                                <td>
                                    <p class="wb-task-status-label mb-2">Due Date</p>
                                    {{ \App\Utility\Helpers::ConvertDateFormat($task->due_date) }}
                                </td>
                                <td>
                                    <p class="wb-task-status-label mb-2">Working Hour</p>
                                    <a href="javascript:void(0);" onclick="task.openWorkingHourModal({{ $task->id }})">{{ $task->assignMembers->sum('working_hour') }} / {{ $task->assignMembers->sum('assigned_hour') }}</a>
                                </td>
                                <td>
                                    <div class="wb-task-status-label mb-2">
                                        Time Tracker
                                        @include('admin.pages.project.task.inc.details._time-tracker')
                                    </div>
                                    <span id="counter-section">
                                    <button class="btn btn-sm btn-light" onclick="task.startTimerHandler()" data-bs-toggle="tooltip" data-bs-placement="top" title="Start Timer">
                                        <i class="ri-play-fill text-success"></i>
                                    </button>
                                </span>
                                    <span id="timer"> 00:00:00</span>
                                </td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-lg-12 mt-2">

                                <div class="">
                                    <div class="flex-grow-1">
                                        <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav mb-2" role="tablist">
                                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_DESCRIPTION)
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link fw-semibold active" data-bs-toggle="tab" href="#wb-task-details-description" role="tab" aria-selected="false" tabindex="-1">
                                                        <i class="mdi mdi-clipboard-outline"></i> Description
                                                    </a>
                                                </li>
                                            @endcan
                                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_DETAILS)
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#wb-task-details-details" role="tab" aria-selected="false" tabindex="-1">
                                                        <i class="mdi mdi-file-table-outline"></i> Details
                                                    </a>
                                                </li>
                                            @endcan
                                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ATTACHMENT)
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link fw-semibold"  data-bs-toggle="tab" href="#wb-task-details-attachments" role="tab" aria-selected="false" tabindex="-1">
                                                        <i class="mdi mdi-paperclip"></i> Attachments <span class="badge bg-dark-subtle text-body" id="task-count">5</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ACTION_ITEM)
                                                <li class="nav-item" role="presentation">

                                                    <a class="nav-link fw-semibold"  data-bs-toggle="tab" href="#wb-task-action-items" role="tab" aria-selected="false" tabindex="-1">
                                                        <i class="mdi mdi-format-list-checks"></i> Action Items <span class="badge bg-dark-subtle text-body" id="total_action_items"></span>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                        <div class="tab-content text-muted">
                                            <div class="tab-pane active" id="wb-task-details-description" role="tabpanel">
                                                <div class="float-end mb-1">
                                                    <button type="button" class="btn btn-sm btn-soft-primary waves-effect waves-light"><i class="mdi mdi-printer-outline"></i></button>
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="btn btn-sm btn-soft-primary waves-effect waves-light">
                                                        <i class="mdi mdi-content-save-outline"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                                        <li><a class="dropdown-item"href="javascript:void(0);" onclick="task.descriptionSaveHandler(1)">Save & Close</a></li>
                                                        <li><a class="dropdown-item"href="javascript:void(0);" onclick="task.descriptionSaveHandler()">Save</a></li>
                                                    </ul>
                                                </div>
                                                <textarea class="form-control" name="task_description" id="task_description" cols="30" rows="10" placeholder="Task description">{{ $task->description }}</textarea>
                                            </div>
                                            <div class="tab-pane" id="wb-task-details-details" role="tabpanel">
                                                @include('admin.pages.project.task.inc.details._custom-fields')
                                            </div>

                                            <div class="tab-pane" id="wb-task-details-attachments" role="tabpanel">
                                                @include('admin.pages.project.task.inc.details._attachments')
                                            </div>

                                            <div class="tab-pane" id="wb-task-action-items" role="tabpanel">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 mt-5">
                                                @include('admin.pages.project.task.inc.details._comments')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-md-4">
                            @if($task->task_type == \App\Constants\TaskType::MAIN)
                                <div class="row">
                                    <div class="col-lg-12" id="sub-task-placeholder">

                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <h4 class="card-title mb-0 flex-grow-1">Activities</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body bg-light-subtle" id="task-activities-placeholder">

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
</div>
