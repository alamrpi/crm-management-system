<div class="align-items-center d-flex">
    <div class="flex-grow-1">
        <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav">
            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ALL)
            <li class="nav-item">
                <a class="nav-link fw-semibold"
                   href="{{ route('admin/project/task/index', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'v' => \App\Constants\Task\ListViewType::LIST]) }}">
                    <i class="ri-list-unordered mt-1 position-relative" style="top: 2px;"></i> List
                </a>
            </li>
            <li>
                <a class="nav-link fw-semibold"
                   href="{{ route('admin/project/task/index', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'v' => \App\Constants\Task\ListViewType::TABLE]) }}">
                    <i class="ri-list-unordered mt-1 position-relative" style="top: 2px;"></i> Table
                </a>
            </li>
            @endcan
            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_CALENDER)
            <li>
                <a class="nav-link fw-semibold" href="{{ route('admin/project/task/index', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'v' => \App\Constants\Task\ListViewType::CALENDER]) }}">
                    <i class="ri-calendar-line mt-1 position-relative" style="top: 2px;"></i> Calendar
                </a>
            </li>
            @endcan
{{--            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ACTIVITIES)--}}
{{--            <li>--}}
{{--                <a class="nav-link fw-semibold" href="#">--}}
{{--                    <i class="ri-line-chart-fill mt-1 position-relative" style="top: 2px;"></i> Activity--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            @endcan--}}
        </ul>
    </div>

    <div class="flex-shrink-0 ms-2">
        <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav">
            <li class="nav-item">
                <a class="nav-link fw-semibold" data-bs-toggle="collapse" href="#collapseSearch" role="button">
                    <i class=" ri-search-line mt-1 position-relative" style="top: 2px;"></i> Search
                </a>
            </li>
            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ADD)
            <li>
                <a class="nav-link fw-semibold" href="javascript:void(0);" onclick="task.openCreateModal()">
                    <i class="ri-add-line mt-1 position-relative" style="top: 2px;"></i> Add Task
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>

