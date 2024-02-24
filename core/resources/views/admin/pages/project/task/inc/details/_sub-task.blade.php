<div class="card">
    <div class="card-header align-items-center d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Subtasks <span class="badge bg-dark-subtle text-body">{{ count($sub_tasks) }}</span></h4>
        <div class="flex-shrink-0">
            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_SUB_TASK_ADD)
            <a class="btn btn-ghost-dark waves-effect waves-light btn-sm" href="javascript:void(0);" onclick="task.openCreateModal({{ $task_id }}, 'details')">
                <i class="ri-add-line mt-1"></i> Add Subtask
            </a>
            @endcan
        </div>
    </div><!-- end card header -->
    <div class="card-body bg-light-subtle">
        <div class="table-responsive bg-white">
            <table class="table table-sm fs-14">
                <thead class="text-muted fs-12">
                <tr>
                    <th>TASK</th>
                    <th>ASSIGNEE</th>
                    <th>DUE DATE</th>
                    <th>PRIORITY</th>
                    <th class="text-center"><i class="ri-more-fill fs-17"></i></th>
                </tr>
                </thead>
                <tbody>
                @foreach($sub_tasks as $sub_task)
                    <tr>
                        <td class="align-middle">
                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class="ri-radio-button-line me-2 align-middle {{ \App\Constants\TaskStatus::getTextColor($sub_task->status) }}"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-start"
                                style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(-77px, -155px);"
                                data-popper-placement="top-end" data-popper-reference-hidden="">
                                @include('admin.pages.project.task.inc._task-statuses', ['task' => $sub_task])
                            </ul>

                            <a href="javascript:void(0);" class="me-2"
                               onclick="task.openTaskDetailsModal({{ $sub_task->id }})">{{ $sub_task->task_id }}</a>
                        </td>

                        <td>
                            <div class="avatar-group">
                                @include('admin.pages.project.task.inc._assignee', ['task' => $sub_task])
                            </div>
                        </td>
                        <td>{{ \App\Utility\Helpers::ConvertDateFormat($sub_task->due_date, "d M, Y") }}</td>
                        <td>
                            <span class="badge {{ \App\Constants\Priority::getBgColor($sub_task->priority) }} text-uppercase">{{ \App\Constants\Priority::ConvertNumberToText($sub_task->priority) }}</span>
                        </td>
                        <td class="text-center">
                            @include('admin.pages.project.task.inc._action-menu', ['task' => $sub_task])
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>
