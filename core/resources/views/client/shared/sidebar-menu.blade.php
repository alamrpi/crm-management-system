<div id="two-column-menu">
</div>
<ul class="navbar-nav" id="navbar-nav">
    <li class="nav-item ps-4 pe-4">
        <x-client.project-dropdown-list/>
    </li>


    <li class="nav-item">
        <a href="{{ route('clientarea/dashboard') }}" class="nav-link"> <i data-feather="home" class="icon-dual"></i> Dashboard</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('clientarea/project/workStatus', ['slug'=>1]) }}" class="nav-link"> <i class="ri-funds-box-line icon-dual"></i>  Project</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('clientarea/team/index') }}" class="nav-link"> <i class="ri-team-line icon-dual"></i>  Team</a>
    </li>

    <li class="nav-item">
        <a href="{{ route('clientarea/chat') }}" class="nav-link"> <i class="ri-message-2-line icon-dual"></i>  Chat</a>
    </li>

    <li class="nav-item">
        <a class="nav-link menu-link" href="#sidebarClient" data-bs-toggle="collapse" role="button">
            <i class="ri-file-chart-line icon-dual"></i>  Reports</a>
        </a>
        <div class="menu-dropdown collapse" id="sidebarClient" style="">
            <ul class="nav nav-sm flex-column">
                <li class="nav-item">
                    <a href="{{ route('clientarea/report/integratedReport') }}" class="nav-link">Integrated Report</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clientarea/project/report/keywordRankingReport') }}" class="nav-link">Keyword Ranking Report</a>
                </li>
            </ul>
        </div>
    </li>

</ul>
