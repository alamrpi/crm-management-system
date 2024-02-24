<ul class="navbar-nav" id="navbar-nav">
    <li class="menu-title"><span data-key="t-menu">Menu</span></li>
    <li class="nav-item">
        <a href="{{ route('doctor/dashboard') }}" class="nav-link" style="padding-left: 0;"> <i data-feather="home" class="icon-dual"></i> Dashboard</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('doctor/myPatient/index') }}" class="nav-link"><i data-feather="users" class="icon-dual"></i>My Patient</a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link"><i data-feather="file-plus" class="icon-dual"></i>Appointment</a>
    </li>

    <li class="nav-item">
        <a href="#" class="nav-link"><i data-feather="file-text" class="icon-dual"></i>Prescription</a>
    </li>
</ul>
