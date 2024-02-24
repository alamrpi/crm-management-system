<div class="accordion lefticon-accordion custom-accordionwithicon accordion-border-box mt-2">
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingTaskInReview">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTaskInReview_{{ $i }}" aria-expanded="true" aria-controls="panelsStayOpen-collapseTaskInReview">
                <span class="badge {{ \App\Constants\TaskStatus::getBgColor($group_tasks[0]->status) }}"><i class="ri-radio-button-line"></i> {{ strtoupper(\App\Constants\TaskStatus::ConvertNumberToText($group_tasks[0]->status)) }}</span> <span class="badge rounded-pill bg-dark-subtle text-body">{{ count($group_tasks) }}</span>
            </button>
        </h2>
        <div id="panelsStayOpen-collapseTaskInReview_{{ $i }}" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTaskInReview">
            <div class="accordion-body">
                <div class="table-responsive bg-white">
                    <table class="table table-sm fs-14">
                        <thead class="text-muted fs-12">
                        <tr>
                            <th style="width:30px;"></th>
                            <th>TASK</th>
                            <th>ASSIGNEE</th>
                            <th>DUE DATE</th>
                            <th>PRIORITY</th>
                            <th class="text-center"><i class="ri-more-fill fs-17"></i></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($group_tasks as $task)
                            @include('admin.pages.project.task.inc.index._task', ['task' => $task, 'is_sub_task' => count($task->sub_tasks) > 0])
                            <tbody class="accordion-collapse collapse" id="panels_sub_task_{{ $task->id }}">
                                @foreach($task->sub_tasks as $sb_task)
                                    @include('admin.pages.project.task.inc.index._task', ['task' => $sb_task, 'is_sub_task' => false])
                                @endforeach
                            </tbody>
                        @endforeach
                        </tbody>
                    </table>

                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ADD)
                    <a class="btn btn-ghost-dark waves-effect waves-light btn-sm" href="javascript:void(0);" onclick="task.openCreateModal()">
                        <i class="ri-add-line mt-1"></i> Add Task
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
