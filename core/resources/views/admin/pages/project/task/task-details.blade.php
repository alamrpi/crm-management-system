@extends('admin.layout')

@section('title')
    Tasks - List View - Project Name
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-12">
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
                                    <input type="text" class="form-control bg-light-subtle wb-task-title-fld" oninput="task.taskNameInputHandler(this)" onblur="task.taskNameBlurHandle(this)" value="{{ $task->task_name }}">
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
        </div>
    </div>

    <!--Some links for the ajax call-->
    <input type="hidden" id="hdnCreateModalOpenUrl" value="{{ route('admin/project/task/create', ['id' => \App\Utility\Helpers::getParamValue('id'), 'v' => request()->input('v')]) }}">
    <input type="hidden" id="hdnAssignMemberModalOpenUrl" value="{{ route('admin/project/task/assignMember', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnAssignMemberEditModalOpenUrl" value="{{ route('admin/project/task/assignMember/edit', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id, 'assign_to_id'=>'assign_to_id']) }}">
    <input type="hidden" id="hdnChangeTaskStatusUrl" value="{{ route('admin/project/task/change-status', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnTaskConvertModalOpenUrl" value="{{ route('admin/project/task/convert-task', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnEditTaskModal" value="{{ route('admin/project/task/edit', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id, 'v' => request()->input('v')]) }}">

    <input type="hidden" id="hdnTaskApproveUrl" value="{{ route('admin/project/task/approve', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnChangeAcceptanceStatusUrl" value="{{ route('admin/project/task/changeAcceptanceStatus', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnTaskWorkingHourModalUrl" value="{{ route('admin/project/task/working-hour-modal', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnTaskTimeTrackerEditUrl" value="{{ route('admin/project/task/edit-tracker', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnTaskTimeTrackerRemoveUrl" value="{{ route('admin/project/task/remove-tracker', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnConvertTaskUrl" value="{{ route('admin/project/task/convert-task-store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnOpenTaskArchiveModalUrl" value="{{ route('admin/project/task/archiveModal', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnTaskArchiveUrl" value="{{ route('admin/project/task/archive', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnOpenTaskDetailsModalUrl" value="{{ route('admin/project/task/details', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnOpenTaskReviewModalUrl" value="{{ route('admin/project/task/review', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnOpenTaskSubmissionModalUrl" value="{{ route('admin/project/task/submission', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnChangeTaskNameUrl" value="{{ route('admin/project/task/change-name', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnStartTimerUrl" value="{{ route('admin/project/task/start-timer', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnStopTimerUrl" value="{{ route('admin/project/task/stop-timer', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnAddTrackingHourUrl" value="{{ route('admin/project/task/add-tracking-hour', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnsaveManualTrackingUrl" value="{{ route('admin/project/task/save-manual-tracking', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnDescriptionSaveUrl" value="{{ route('admin/project/task/save-description', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnDeleteTaskDetailUrl" value="{{ route('admin/project/task/save-delete', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnLoadAttachmentsUrl" value="{{ route('admin/project/task/attachments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnStoreAttachmentUrl" value="{{ route('admin/project/task/attachments/store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnLoadReviewCommentsUrl" value="{{ route('admin/project/task/review/comments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnLoadSubmissionCommentsUrl" value="{{ route('admin/project/task/submission/comments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnLoadCommentsUrl" value="{{ route('admin/project/task/comments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnStoreCommentUrl" value="{{ route('admin/project/task/comments/store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnLoadSubtaskUrl" value="{{ route('admin/project/task/sub-task', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnLoadActivitiesUrl" value="{{ route('admin/project/task/activities', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnChangeCustomFieldLabelUrl" value="{{ route('admin/project/task/change-detail-label', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">

    <input type="hidden" id="hdnLoadActionItems" value="{{ route('admin/project/task/action-items', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnAddActionItemsUrl" value="{{ route('admin/project/task/action-items/add', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnTaskActionRenameUrl" value="{{ route('admin/project/task/action-items/rename', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnInsertActionItemUrl" value="{{ route('admin/project/task/action-items/insertItem', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnChangeCheckStatusActionItemUrl" value="{{ route('admin/project/task/action-items/changeCheckStatus', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnUpdateActionItemUrl" value="{{ route('admin/project/task/action-items/updateItem', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnRemoveActionItemUrl" value="{{ route('admin/project/task/action-items/removeItem', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnRemoveActionUrl" value="{{ route('admin/project/task/action-items/remove', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}">
    <input type="hidden" id="hdnRemoveMemberUrl" value="{{ route('admin/project/task/assignMember/remove', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id, 'assign_to_id' => 'assign_to_id']) }}">
    @include('admin.pages.project.task.details-modal')

@endsection

@section('script')
    <script src="{{ asset('core/resources/js/Task.js') }}"></script>
    <script>
        const task = new Task({{ \App\Utility\Helpers::getParamValue('id') }});

    </script>
@endsection

@section('styles')
    <style>
        .wb-task-status-label {
            font-size: 14px;
            font-weight: 500;
            color: rgb(42, 46, 52);
        }

        .custom-sub-nav .nav-link {
            color: #2A2E34;
            border-radius: 6px;
            padding: 0 6px 6px 6px;
            margin-right: 10px;
        }

        .custom-sub-nav .nav-item:hover .custom-sub-nav .nav-item .nav-link {
            color: red;
            background: #e9ebec;
        }

        .custom-sub-nav .nav-item .nav-link.active {
            color: #2A2E34;
            background: transparent;
        }

        .accordion-button:not(.collapsed) {
            background-color: #fff;
        }

        .wb-task-title-fld {
            height: 45px;
            font-size: 30px;
            font-weight: bold;
            border: none;
            color: #2a2e34;
            padding: 0;
        }
    </style>
@endsection
