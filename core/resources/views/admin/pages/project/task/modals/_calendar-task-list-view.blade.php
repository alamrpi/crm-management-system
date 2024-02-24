<div class="modal-dialog modal-dialog-centered modal-xl" style="z-index: 1; position: relative;">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light">
            <h2 class="accordion-header" id="panelsStayOpen-headingTaskInReview">
                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseTaskInReview_1" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseTaskInReview">
                    <span class="badge {{ \App\Constants\TaskStatus::getBgColor($tasks[0]->status) }}"><i class="ri-radio-button-line"></i> {{ \App\Constants\TaskStatus::ConvertNumberToText($tasks[0]->status) }}</span>
                    <span class="badge rounded-pill bg-dark-subtle text-body">{{ $tasks->count() }}</span>
                </button>
            </h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="panelsStayOpen-collapseTaskInReview_1" class="accordion-collapse collapse show"
                 aria-labelledby="panelsStayOpen-headingTaskInReview" style="">
                <div class="accordion-body">
                    <div class="table-responsive bg-white">
                        <table class="table table-sm fs-14">
                            <thead class="text-muted fs-12">
                            <tr>
                                <th style="width: 30px"></th>
                                <th>TASK</th>
                                <th>ASSIGNEE</th>
                                <th>DUE DATE</th>
                                <th>PRIORITY</th>
                                <th class="text-center">
                                    <i class="ri-more-fill fs-17"></i>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td></td>
                                    <td class="align-middle">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ri-radio-button-line me-2 align-middle {{ \App\Constants\TaskStatus::getTextColor($task->status) }}"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-start"
                                            style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(-77px, -155px);"
                                            data-popper-placement="top-end" data-popper-reference-hidden="">
                                            @include('admin.pages.project.task.inc._task-statuses')
                                        </ul>
                                        <a href="javascript:void(0);" class="me-2"
                                           onclick="task.openTaskDetailsModal({{ $task->id }})">{{ $task->task_id }}</a>
                                        <a href="javascript:void(0);" onclick="task.openTaskDetailsModal({{ $task->id }})">{{ $task->task_name }}</a>
                                    </td>

                                    <td>
                                        <div class="avatar-group">
                                            @foreach(\App\Utility\ProjectTaskHelper::teamMemberbyTask( $task->id ) as $member)
                                                <div class="member-place-holder_{{ $member->id }}">
                                                    <a href="javascript: void(0);" class="avatar-group-item"
                                                       data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                       data-bs-placement="top" aria-label="{{ $member->name }}"
                                                       data-bs-original-title="{{ $member->name }}">
                                                        <img src="{{ asset($member->photo) }}"
                                                             alt="{{ $member->name }}" class="rounded-circle avatar-xxs" />
                                                    </a>
                                                </div>
                                            @endforeach
                                            <a href="javascript: void(0);"
                                               onclick="task.openAssignMemberModal(this, {{ $task->id }}, '.member-place-holder_{{ $task->id }}')"
                                               class="avatar-group-item" data-bs-toggle="tooltip"
                                               data-bs-trigger="hover" data-bs-placement="top" aria-label="New Assign"
                                               data-bs-original-title="New Assign">
                                                <div class="avatar-xxs">
                                                    <div
                                                        class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                        <i class="bx bx-plus"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td>13 Dec, 2023</td>
                                    <td>
                                        <span class="badge {{ \App\Constants\Priority::getBgColor($task->priority) }} text-uppercase">{{ \App\Constants\Priority::ConvertNumberToText($task->priority) }}</span>
                                    </td>
                                    <td class="text-center">
                                        @include('admin.pages.project.task.inc._action-menu')
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tbody class="accordion-collapse collapse" id="panels_sub_task_1"></tbody>
                        </table>

                        <a class="btn btn-ghost-dark waves-effect waves-light btn-sm" href="javascript:void(0);"
                           onclick="task.openCreateModal()">
                            <i class="ri-add-line mt-1"></i> Add Task
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
