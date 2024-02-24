<ul class="nav nav-tabs-custom">
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::DEPT_ALL]))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/department/index') }}">
            <i class="fas fa-home"></i>
            All Department
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::DEPT_ADD]))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/department/create') }}">
            <i class="far fa-user"></i>
            Add Department
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::DEPT_SERVICE_LIST, App\Constants\Authorization\Access::DEPT_SERVICE_ADD]))
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Service
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::DEPT_SERVICE_LIST]))
            <li><a class="dropdown-item" href="{{ route('admin/department/service/index') }}">All Service</a></li>
            @endcan
            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::DEPT_SERVICE_ADD]))
            <li><a class="dropdown-item" href="{{ route('admin/department/service/create') }}">Add Service</a></li>
            @endcan
        </ul>
    </li>
    @endcan
</ul>
