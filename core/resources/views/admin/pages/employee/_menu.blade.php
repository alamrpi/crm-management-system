<ul class="nav nav-tabs-custom">
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_ALL)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/employee/index') }}">
            <i class="fas fa-home"></i>
            All Employee
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_ADD)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/employee/create') }}">
            <i class="far fa-user"></i>
            Add Employee
        </a>
    </li>
    @endcan
</ul>
