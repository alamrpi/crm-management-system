<form method="post" enctype="multipart/form-data" action="{{ route('admin/project/team/assign-member', ['id'=>\App\Utility\Helpers::getParamValue('id')]) }}" id="assignMemberAccessForm">
    @csrf
    <input type="hidden" name="project_id" value="{{\App\Utility\Helpers::getParamValue('id')}}">
    <div class="mb-3">
        <label class="form-label" for="department_id">Department<small class="text-danger">*</small></label>
        <select class="form-select select2" id="department_id" name="department_id" required onchange="project.getMemberByDepartmentId(this.value, '{{ route('admin/project/team/getMemberByDepartmentId', ['id'=>$project_id]) }}')">
            <option value="">-- Select --</option>
            @foreach($project_departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="manager_id" class="form-label">Manager<span class="text-danger">*</span></label>
        <select class="form-select select2" id="manager_id" name="manager_ids[]" multiple required>
        </select>
    </div>

    <div class="mb-3">
        <label for="executive_id" class="form-label">Executive<span class="text-danger">*</span></label>
        <select class="form-select select2" id="executive_id" name="executive_ids[]" multiple required>

        </select>
    </div>

    <div class="text-end mb-4">
        <button type="button" class="btn btn-primary w-sm" onclick="project.assignMember()">Save</button>
    </div>
</form>
