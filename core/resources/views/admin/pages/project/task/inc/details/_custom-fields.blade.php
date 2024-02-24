<h6 class="mb-2 mt-3">
    <input type="text" class="form-control form-control-sm wb-task-title-fld-sm border-0" onblur="task.detailFieldNameBlurHandler(this)" value="{{ $task->details_field_name }}">
</h6>
<form action="{{ route('admin/project/task/save-details', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}" method="post" onsubmit="task.saveTaskDetailHandler(event, this)">
    <table class="table table-sm table-bordered">
        <tbody id="details-placeholder">
        @foreach($task->details as $detail)
            <tr>
                <th style="width: 200px;">{{ $detail->field_name }}</th>
                <td>{{ $detail->field_value }}</td>
                <td class="text-center">
                    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_DETAILS_REMOVE)
                    <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" type="button" title="Remove" onclick="task.removeTaskDetailHandler({{ $detail->id }}, this)">
                        <i class="mdi mdi-trash-can-outline text-danger"></i>
                    </button>
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot id="add-detail-section" style="display: none">
        <tr>
            <td>
                <input type="text" name="field_name" id="field_name" class="form-control form-control-sm" placeholder="Field name">
            </td>
            <td>
                <input type="text" name="field_value" id="field_value" class="form-control form-control-sm" placeholder="Field data">
            </td>
            <td class="text-nowrap text-center" style="width: 80px;">
                <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Save" type="submit"><i class="mdi mdi-check text-success"></i></button>
                <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" type="button" onclick="task.addDetailsFormToggle()"><i class="mdi mdi-close text-danger"></i></button>
            </td>
        </tr>
        </tfoot>
    </table>
</form>
@can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_DETAILS_ADD)
<button type="button" class="btn btn-ghost-dark waves-effect waves-light btn-sm" onclick="task.addDetailsFormToggle(1)">
    <i class="ri-add-line mt-1"></i> Add Field
</button>
@endcan
