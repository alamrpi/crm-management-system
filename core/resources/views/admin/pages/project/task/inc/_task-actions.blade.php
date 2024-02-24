@if($task->task_type == \App\Constants\TaskType::MAIN)
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_SUB_TASK_ADD)
    <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openCreateModal({{ $task->id }})"><i class="ri-add-line text-muted me-2 align-bottom"></i>Add Subtask</a></li>
    @endcan
@endif
@if($task->task_type == \App\Constants\TaskType::MAIN)
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_CONVERT_TO_SUBTASK)
    <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openConvertSubTaskModal({{ $task->id }})"><i class="ri-refresh-line text-muted me-2 align-bottom"></i>Convert to Subtask</a></li>
    @endcan
@else
    <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.convertTaskHandler({{ \App\Constants\TaskType::MAIN }}, {{ $task->id }})"><i class="ri-refresh-line text-muted me-2 align-bottom"></i>Convert to Main Task</a></li>
@endif
{{-- @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_DUPLICATE)
<li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-file-copy-line text-muted me-2 align-bottom"></i>Duplicate</a></li>
@endcan --}}
<li><a class="dropdown-item" href="javascript:void(0);" onclick="task.editTaskModal({{ $task->id }})"><i class="ri-file-copy-line text-muted me-2 align-bottom"></i>Edit</a></li>
<li><hr class="dropdown-divider"></li>
@can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ARCHIVE)
<li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openArchiveModal({{ $task->id }})"><i class="ri-inbox-archive-line text-muted me-2 align-bottom"></i>Archive</a></li>
@endcan
