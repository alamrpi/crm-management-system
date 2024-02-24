<ul class="nav nav-tabs-custom">
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_ALL)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/client/index') }}">
            <i class="fas fa-home"></i>
            All Client
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_ADD)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/client/create') }}">
            <i class="far fa-user"></i>
            Add Client
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::CLIENT_ENROLL)
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin/client/enroll') }}">
            <i class="far fa-user"></i>
            Enroll Client
        </a>
    </li>
    @endcan
</ul>
