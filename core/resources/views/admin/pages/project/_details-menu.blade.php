<ul class="nav nav-tabs-custom border-bottom-0">
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_OVERVIEW)
    <li class="nav-item">
        <a class="nav-link fw-semibold"
           href="{{ route('admin/project/overview', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
            Overview
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::PR_SERVICE))
    <li class="nav-item">
        <a class="nav-link fw-semibold"
           href="{{ route('admin/project/service/gridView', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
            Services
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::PR_DOCUMENT))
    <li class="nav-item">
        <a class="nav-link fw-semibold"
           href="{{ route('admin/project/document/index', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
            Documents
        </a>
    </li>
    @endcan
{{--    <li class="nav-item">--}}
{{--        <a class="nav-link fw-semibold" href="#project-activities">--}}
{{--            Client--}}
{{--        </a>--}}
{{--    </li>--}}
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_ACTIVITIES_VIEW)
    <li class="nav-item">
        <a class="nav-link fw-semibold"
           href="{{ route('admin/project/activity/index', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
            Activities
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::PR_TEAM))
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TEAM_ALL)
    <li class="nav-item">
        <a class="nav-link fw-semibold"
           href="{{ route('admin/project/team/index', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
            Team
        </a>
    </li>
    @endcan
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::PR_TASK))
    <li class="nav-item">
        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ALL)
        <a class="nav-link fw-semibold"
           href="{{ route('admin/project/task/index', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'v' => \App\Constants\Task\ListViewType::LIST]) }}">
            Tasks
        </a>
        @endcan
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::PR_ACCESS))
    <li class="nav-item">
        <a class="nav-link fw-semibold" href="{{ route('admin/project/access/index', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">
            Access & Sample
        </a>
    </li>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAllRuleByGroup(App\Constants\Authorization\AccessGroup::PR_INTEGRATION_CONFIGURATION))
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_INTEGRATION_CONFIG_ALL)
    <li class="nav-item">
        <a class="nav-link fw-semibold" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Integration Config
        </a>
        <div class="dropdown-menu dropdown-menu-end" style="">
            <a class="dropdown-item" href="{{ route('admin/project/integrationConfig/keyword/index', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}">Keyword</a>
        </div>
    </li>
    @endcan
    @endcan
</ul>
