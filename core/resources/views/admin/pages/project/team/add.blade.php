<div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Assign Member</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <x-project-assign-member :projectId="$project_id"/>
        </div>
    </div>
</div>
