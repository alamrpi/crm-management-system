<tr>
    <td>
        @if($is_sub_task && $task->task_type == \App\Constants\TaskType::MAIN)
            <button class="btn btn-ghost-dark waves-effect waves-light btn-sm" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panels_sub_task_{{ $task->id }}"><i class=" ri-arrow-right-s-fill"></i></button>
        @endif
    </td>
    <td class="align-middle">
        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_SUB_TASK_ADD)
        @if($task->task_type == \App\Constants\TaskType::MAIN)
            <span style="width: 40px;" class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                  data-bs-trigger="hover focus" data-bs-content="Add Subtask" data-bs-placement="top">
              <button class="btn btn-sm btn-ghost-dark waves-effect waves-light me-2" type="button"
                      onclick="task.openCreateModal({{ $task->id  }})"><i class="ri-add-line"></i></button>
            </span>
        @else
            <span style="width: 40px;" class="d-inline-block" tabindex="0" data-bs-toggle="popover"
                  data-bs-trigger="hover focus" data-bs-content="Add Subtask" data-bs-placement="top">
            </span>
        @endif
        @endcan

        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
            <i class="ri-radio-button-line me-2 align-middle {{ \App\Constants\TaskStatus::getTextColor($task->status) }}"></i>
        </a>
        <ul class="dropdown-menu dropdown-menu-start"
            style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(-77px, -155px);"
            data-popper-placement="top-end" data-popper-reference-hidden="">
            @include('admin.pages.project.task.inc._task-statuses')
        </ul>
        {{-- <a href="javascript:void(0);" class="me-2"
           onclick="task.openTaskDetailsModal({{ $task->id }})">{{ $task->task_id }}</a> --}}
        <a href="javascript:void(0);" onclick="task.openTaskDetailsModal({{ $task->id }})">{{ $task->task_name }}</a>
    </td>

    <td>
        @include('admin.pages.project.task.inc._assignee')
    </td>
    <td>{{ \App\Utility\Helpers::ConvertDateFormat($task->due_date, "d M, Y") }}</td>
    <td>
        <span
            class="badge {{ \App\Constants\Priority::getBgColor($task->priority) }} text-uppercase">{{ \App\Constants\Priority::ConvertNumberToText($task->priority) }}</span>
    </td>
    <td class="text-center">
        @include('admin.pages.project.task.inc._action-menu')
    </td>
</tr>
