<div class="table table-responsive bg-white">
    <table class="table table-sm fs-14 table-bordered table-hover">
        <thead class="text-muted fs-12">
        <tr class="bg-light-subtle">
            <th class="ps-3">TASK</th>
            <th>DEPT & SERVICE</th>
            <th class="text-center">STATUS</th>
            <th>ASSIGNEE</th>
            <th>DUE DATE</th>
            <th>PRIORITY</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td class="align-middle ps-3">
                    {{-- <a href="#" class="me-2">{{ $task->task_id }}</a> --}}
                    <a href="javascript:void(0)" onclick="task.openTaskDetailsModal({{ $task->id }})" data-bs-target="//#taskModal">{{ $task->task_name }}</a>
                </td>
                <td>
                    <p class="text-body mb-0">{{ $task->department_name }}</p>
                    <p class="text-muted mb-0">{{ $task->service_name }}</p>
                </td>
                <td class="text-center">
                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true"
                       class="btn {{ \App\Constants\TaskStatus::getBtnColor($task->status) }} btn-sm">
                        {{ strtoupper(\App\Constants\TaskStatus::ConvertNumberToText($task->status)) }}
                    </a>
                    <ul class="dropdown-menu">
                        @include('admin.pages.project.task.inc._task-statuses')
                    </ul>
                </td>
                <td>
                    @include('admin.pages.project.task.inc._assignee')
                </td>
                <td>{{ \App\Utility\Helpers::ConvertDateFormat($task->due_date, "d M, Y") }}</td>
                <td>
                    <span class="badge {{ \App\Constants\Priority::getBgColor($task->priority) }} text-uppercase">{{ \App\Constants\Priority::ConvertNumberToText($task->priority) }}</span>
                </td>
                <td class="text-center">
                    @include('admin.pages.project.task.inc._action-menu')
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
