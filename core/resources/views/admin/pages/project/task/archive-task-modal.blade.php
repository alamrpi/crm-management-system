<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Task Archive Confirmation</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="#">
                        <div class="mb-2">
                            <label for="archive_note">Note</label>
                            <textarea name="archive_note" class="form-control form-control-sm" id="archive_note" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-2 float-end">
                            <button type="button" class="btn btn-sm btn-primary" onclick="task.taskArchiveHandler()"><i class="bx bx-save"></i> Archive Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
