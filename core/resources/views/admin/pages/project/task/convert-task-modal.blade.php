<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Create Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="#">
                        <div class="mb-2">
                            <label for="main_task_id">Main Task</label>
                            <select name="main_task_id" id="main_task_id" class="form-select form-select-sm select2" required>
                                <option value="">--Select--</option>
                                @foreach($main_tasks as $main_task)
                                    <option value="{{ $main_task->id }}">{{ $main_task->task_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2 float-end">
                            <button type="button" class="btn btn-sm btn-primary" onclick="task.convertTaskHandler({{ \App\Constants\TaskType::SUB }})"><i class="bx bx-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
