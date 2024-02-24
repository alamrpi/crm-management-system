<div class="modal-dialog modal-dialog-centered modal-xs">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Assign Member</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin/chat/group/create') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="memberSuggestion" class="form-label">Manager<span class="text-danger">*</span></label>
                    <select class="form-select select2" id="memberSuggestion" name="memberSuggestion[]" multiple required onclick="chat.getRequiredData('{{ route('admin/chat/group/create/memberSuggestion') }}')">
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-lg-11">
                        <button type="button" id="btn_request_submit" class="btn btn-primary float-end w-md" onclick="chat.getRequiredData('{{ route('admin/chat/group/create/memberSuggestion') }}')">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
