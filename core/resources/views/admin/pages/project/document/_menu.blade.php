<div class="nav flex-column nav-pills bg-light-subtle">
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_DOCUMENT_ALL)
    <a class="nav-link mb-2" href="{{ route('admin/project/document/index', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}">All Document</a>
    <a class="nav-link mb-2" href="{{ route('admin/project/document/index', ['id' => \App\Utility\Helpers::getParamValue('id'), 'type' => \App\Constants\DocumentType::PROJECT]) }}">Project Document</a>
    <a class="nav-link mb-2" href="{{ route('admin/project/document/index', ['id' => \App\Utility\Helpers::getParamValue('id'), 'type' => \App\Constants\DocumentType::RESEARCH]) }}">Research Document</a>
    @endcan
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_DOCUMENT_ADD)
    <a class="nav-link" href="{{ route('admin/project/document/create', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}">Add Document</a>
    @endcan
</div>
