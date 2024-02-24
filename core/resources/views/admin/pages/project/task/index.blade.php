@extends('admin.layout')

@section('title')
    Tasks - List View - Project Name
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body pb-0 px-4">
                    <x-pr-top-view/>
                    @include('admin.pages.project._details-menu')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('admin.shared.alert-template')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('admin.pages.project.task.inc._top-menu')
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            @include('admin.pages.project.task.inc.index._filter-form')
        </div>
        <div class="col-lg-12">
            @if(count($tasks) > 0)
                @if(request()->input('v') === \App\Constants\Task\ListViewType::LIST)
                    @foreach($tasks->groupBy('status') as $i => $group_tasks)
                        @include('admin.pages.project.task.inc.index._list-view', ['group_tasks' => $group_tasks, 'i' => $i])
                    @endforeach

                @elseif(request()->input('v') === \App\Constants\Task\ListViewType::TABLE)
                    @include('admin.pages.project.task.inc.index._table-view')

                @elseif(request()->input('v') === \App\Constants\Task\ListViewType::CALENDER)
                    @include('admin.pages.project.task.inc.index._calendar-view')
                @endif
            @else
                <div class="alert alert-warning">
                    <span>Task empty!</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal-stop-timer-note" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 text-danger" id="exampleModalLabel">Confirmation!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="#" onsubmit="task.stopTimerHandler()">
                        <div class="form-group">
                            <textarea name="tracker_note" class="form-control" required id="tracker_note" cols="30" rows="10" placeholder="Note.."></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-success float-end">Ok</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Some links for the ajax call-->
    <input type="hidden" id="hdnCreateModalOpenUrl" value="{{ route('admin/project/task/create', ['id' => \App\Utility\Helpers::getParamValue('id'), 'v' => request()->input('v')]) }}">
    <input type="hidden" id="hdnAssignMemberModalOpenUrl" value="{{ route('admin/project/task/assignMember', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnAssignMemberEditModalOpenUrl" value="{{ route('admin/project/task/assignMember/edit', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id', 'assign_to_id'=>'assign_to_id']) }}">
    <input type="hidden" id="hdnChangeTaskStatusUrl" value="{{ route('admin/project/task/change-status', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnTaskConvertModalOpenUrl" value="{{ route('admin/project/task/convert-task', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnEditTaskModal" value="{{ route('admin/project/task/edit', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id', 'v' => request()->input('v')]) }}">

    <input type="hidden" id="hdnTaskApproveUrl" value="{{ route('admin/project/task/approve', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnChangeAcceptanceStatusUrl" value="{{ route('admin/project/task/changeAcceptanceStatus', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnTaskWorkingHourModalUrl" value="{{ route('admin/project/task/working-hour-modal', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnTaskTimeTrackerEditUrl" value="{{ route('admin/project/task/edit-tracker', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnTaskTimeTrackerRemoveUrl" value="{{ route('admin/project/task/remove-tracker', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnConvertTaskUrl" value="{{ route('admin/project/task/convert-task-store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnOpenTaskArchiveModalUrl" value="{{ route('admin/project/task/archiveModal', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnTaskArchiveUrl" value="{{ route('admin/project/task/archive', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnOpenTaskDetailsModalUrl" value="{{ route('admin/project/task/details', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnOpenTaskReviewModalUrl" value="{{ route('admin/project/task/review', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnOpenTaskSubmissionModalUrl" value="{{ route('admin/project/task/submission', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnChangeTaskNameUrl" value="{{ route('admin/project/task/change-name', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnStartTimerUrl" value="{{ route('admin/project/task/start-timer', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnStopTimerUrl" value="{{ route('admin/project/task/stop-timer', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnAddTrackingHourUrl" value="{{ route('admin/project/task/add-tracking-hour', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnsaveManualTrackingUrl" value="{{ route('admin/project/task/save-manual-tracking', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnDescriptionSaveUrl" value="{{ route('admin/project/task/save-description', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnDeleteTaskDetailUrl" value="{{ route('admin/project/task/save-delete', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnLoadAttachmentsUrl" value="{{ route('admin/project/task/attachments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnStoreAttachmentUrl" value="{{ route('admin/project/task/attachments/store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnLoadReviewCommentsUrl" value="{{ route('admin/project/task/review/comments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnLoadSubmissionCommentsUrl" value="{{ route('admin/project/task/submission/comments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnLoadCommentsUrl" value="{{ route('admin/project/task/comments', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnStoreCommentUrl" value="{{ route('admin/project/task/comments/store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnLoadSubtaskUrl" value="{{ route('admin/project/task/sub-task', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnLoadActivitiesUrl" value="{{ route('admin/project/task/activities', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnChangeCustomFieldLabelUrl" value="{{ route('admin/project/task/change-detail-label', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">

    <input type="hidden" id="hdnLoadActionItems" value="{{ route('admin/project/task/action-items', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnAddActionItemsUrl" value="{{ route('admin/project/task/action-items/add', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnTaskActionRenameUrl" value="{{ route('admin/project/task/action-items/rename', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnInsertActionItemUrl" value="{{ route('admin/project/task/action-items/insertItem', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnChangeCheckStatusActionItemUrl" value="{{ route('admin/project/task/action-items/changeCheckStatus', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnUpdateActionItemUrl" value="{{ route('admin/project/task/action-items/updateItem', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnRemoveActionItemUrl" value="{{ route('admin/project/task/action-items/removeItem', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnRemoveActionUrl" value="{{ route('admin/project/task/action-items/remove', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}">
    <input type="hidden" id="hdnRemoveMemberUrl" value="{{ route('admin/project/task/assignMember/remove', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id', 'assign_to_id' => 'assign_to_id']) }}">
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
