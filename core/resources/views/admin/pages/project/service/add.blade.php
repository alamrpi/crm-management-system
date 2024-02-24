<div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_SERVICE_ADD)
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Service</h1>
            @endcan
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <x-pr-add-service-form formUrl="{{ route('admin/project/store-service', ['id' => \App\Utility\Helpers::getParamValue('id'), 'f' => 'o'])  }}"/>
        </div>
    </div>
</div>



