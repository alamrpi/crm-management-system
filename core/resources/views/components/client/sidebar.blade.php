<div id="two-column-menu">
</div>
<ul class="navbar-nav" id="navbar-nav">
    @if($current_project != null)
        <li class="nav-item ps-4 pe-4">
            <form action="{{ route('clientarea/switchProject') }}" method="get">
                <input type="hidden" name="previous_path" value="{{ request()->path() }}">
                <select class="form-select rounded-pill mb-2 mt-2" id="switchable-project-list" name="pid" onchange="console.log(this.parent)">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $project->id == $current_project['id'] ? 'selected' : '' }}>{{ $project->project_name }}</option>
                    @endforeach
                </select>
            </form>
        </li>

        <li class="nav-item">
            <a href="{{ route('clientarea/project/dashboard', ['slug'=>$current_project['slug']]) }}" class="nav-link"> <i data-feather="home" class="icon-dual"></i> Dashboard</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('clientarea/project/workStatus', ['slug'=>$current_project['slug']]) }}" class="nav-link"> <i class="ri-funds-box-line icon-dual"></i>  Work Status</a>
        </li>

        <li class="nav-item">
            <a href="{{ route('clientarea/project/team', ['slug'=>$current_project['slug']]) }}" class="nav-link"> <i class="ri-team-line icon-dual"></i>  Team</a>
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
                    <a href="{{ route('clientarea/project/report/integratedReport', ['slug'=>$current_project['slug']]) }}" class="nav-link">Integrated Report</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('clientarea/project/report/keywordRankingReport',  ['slug'=>$current_project['slug']]) }}" class="nav-link">Keyword Ranking Report</a>
                </li>
            </ul>
        </div>
    </li>
</ul>
@endif
