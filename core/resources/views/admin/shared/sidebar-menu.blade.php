<div id="two-column-menu">
</div>
<ul class="navbar-nav" id="navbar-nav">
    <li class="nav-item">
        <a href="{{ route('admin/dashboard') }}" class="nav-link"> <i data-feather="home" class="icon-dual"></i> Dashboard</a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin/time-and-activity/index') }}" class="nav-link"> <i data-feather="clock" class="icon-dual"></i> Time & Activity Report</a>
    </li>

    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::PROJECT))
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarProject" data-bs-toggle="collapse" role="button">
            <i data-feather="trending-up" class="icon-dual"></i> Project
        </a>
        <div class="menu-dropdown collapse" id="sidebarProject" style="">
            <ul class="nav nav-sm flex-column">
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ALL)
                <li class="nav-item">
                    <a href="{{ route('admin/project/index') }}" class="nav-link">All Projects</a>
                </li>
                @endcan
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ALL)
                <li class="nav-item">
                    <a href="{{ route('admin/project/project-by-member') }}" class="nav-link">Projects by Member</a>
                </li>
                @endcan
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ADD)
                <li class="nav-item">
                    <a href="{{ route('admin/project/create') }}" class="nav-link">New Project</a>
                </li>
                @endcan
            </ul>
        </div>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::TASK))
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::TASKS_ALL)
    <li class="nav-item">
        <a href="{{ route('admin/tasks') }}" class="nav-link"> <i class="mdi mdi-format-list-checkbox icon-dual text-dark"></i> Tasks</a>
    </li>
    @endcan
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::REQUEST))
    <li class="nav-item">
        <a href="{{ route('admin/request/index') }}" class="nav-link"> <i class="mdi mdi-note-check-outline icon-dual text-dark"></i> Requests</a>
    </li>
    @endcan
    <li class="nav-item">
        <a href="{{ route('admin/chat') }}" class="nav-link"> <i data-feather="message-square" class="icon-dual"></i> Chat</a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/notes/index') }}"> <i class="bx bx-note"></i> Notes</a>
    </li>

    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::CLIENT))
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarClient" data-bs-toggle="collapse" role="button">
            <i class="mdi mdi-account-tie-outline mdi-24px icon-dual" style="margin-left: -3px; margin-right: 4px;"></i> Client</a>
        </a>
        <div class="menu-dropdown collapse" id="sidebarClient" style="">
            <ul class="nav nav-sm flex-column">
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_ALL)
                <li class="nav-item">
                    <a href="{{ route('admin/client/index') }}" class="nav-link">All Client</a>
                </li>
                @endcan
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_ADD)
                <li class="nav-item">
                    <a href="{{ route('admin/client/create') }}" class="nav-link">Add Client</a>
                </li>
                @endcan
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_ENROLL)
                <li class="nav-item">
                    <a href="{{ route('admin/client/enroll') }}" class="nav-link">Enroll Client</a>
                </li>
                @endcan
            </ul>
        </div>
    </li>
    @endcan

    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::FEEDBACK_ALL)
    <li class="nav-item">
        <a href="{{ route('admin/feedbacks') }}" class="nav-link"> <i class="mdi mdi-thumbs-up-down-outline icon-dual text-dark"></i> Feedbacks</a>
    </li>
    @endcan

    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::EMPLOYEE))
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarEmployee" data-bs-toggle="collapse" role="button">
            <i data-feather="users" class="icon-dual"></i> Employee
        </a>
        <div class="menu-dropdown collapse" id="sidebarEmployee" style="">
            <ul class="nav nav-sm flex-column">
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_ALL)
                <li class="nav-item">
                    <a href="{{ route('admin/employee/index') }}" class="nav-link">All Employee</a>
                </li>
                @endcan
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_ADD)
                <li class="nav-item">
                    <a href="{{ route('admin/employee/create') }}" class="nav-link">Add Employee</a>
                </li>
                @endcan
            </ul>
        </div>
    </li>
    @endcan

    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::DEPARTMENT))
        <li class="nav-item">
            <a class="nav-link menu-link" href="#sidebarDepartment" data-bs-toggle="collapse" role="button">
                <i data-feather="grid" class="icon-dual"></i> Department</a>
            </a>
            <div class="menu-dropdown collapse" id="sidebarDepartment" style="">
                <ul class="nav nav-sm flex-column">
                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::DEPT_ALL]))
                    <li class="nav-item">
                        <a href="{{ route('admin/department/index') }}" class="nav-link">All Department</a>
                    </li>
                    @endcan
                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::DEPT_ADD ]))
                        <li class="nav-item">
                            <a href="{{ route('admin/department/create') }}" class="nav-link">Add Department</a>
                        </li>
                    @endcan
                </ul>
            </div>
        </li>

    @endcan

    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarUsers" data-bs-toggle="collapse" role="button">
            <i data-feather="user" class="icon-dual"></i> Users</a>
        </a>
        <div class="menu-dropdown collapse" id="sidebarUsers" style="">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin/users/index') }}" class="nav-link">All User</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin/role/index') }}" class="nav-link">Roles</a>
                </li>
            </ul>
        </div>
    </li>
    @endif
</ul>
