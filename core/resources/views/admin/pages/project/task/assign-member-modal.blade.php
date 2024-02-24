 <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Assign Member</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('admin/project/task/assignMember/store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => \App\Utility\Helpers::getParamValue('task_id')]) }}" onsubmit="task.storeMemberAssignHandler(event, this)" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label for="department_id">Member</label>
                            <select name="team_member_id" id="team_member_id" class="form-select form-select-sm select2" required>
                                <option value="">--Select--</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="task_name">Assign Hour</label>
                            <input type="text" name="assigned_hour" id="assigned_hour" class="form-control form-control-sm" required>
                        </div>
                        <div class="mb-2">
                            <label for="assigned_note">Note</label>
                            <textarea name="assigned_note" class="form-control form-control-sm" id="assigned_note" cols="30" rows="10"></textarea>
                        </div>
                        <div class="mb-2 float-end">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bx bx-save"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
