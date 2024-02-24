<ul class="nav nav-tabs-custom">
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ALL)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/project/index') }}">
            <i class="fas fa-home"></i>
            All Project
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ADD)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/project/create') }}">
            <i class="far fa-user"></i>
            New Project
        </a>
    </li>
    @endcan
</ul>
