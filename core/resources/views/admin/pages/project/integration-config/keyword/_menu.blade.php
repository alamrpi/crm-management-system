<div class="nav flex-column nav-pills wb-custom-nav border-end">
    <a class="nav-link mb-2" href="{{ route('admin/project/integrationConfig/keyword/keywordWebsite', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'cid'=> $config->id]) }}">Website</a>
    <a class="nav-link mb-2" href="{{ route('admin/project/integrationConfig/keyword/keywords', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'cid'=>$config->id]) }}">Keywords</a>
    <a class="nav-link mb-2" href="{{ route('admin/project/integrationConfig/keyword/keywordIDKey', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'cid'=>$config->id]) }}">ID & Key</a>
</div>
