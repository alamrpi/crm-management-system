<div class="table-responsive bg-white mt-3">
    <form action="#">
        <table class="table table-sm fs-14 table-bordered table-hover">
            <thead class="text-muted fs-12">
            <tr class="bg-light-subtle">
                <th>NAME</th>
                <th>SIZE</th>
                <th>AUTHOR</th>
                <th>DATE</th>
                <th class="text-center"></th>
            </tr>
            </thead>
            <tbody id="attachments-placeholder">

            </tbody>
            <tfoot id="attachment-section" style="display: none;">
            <tr>
                <td colspan="5">
                    <input type="file" multiple class="form-control form-control-sm" name="attachments[]" id="attachments" required>
                </td>
                <td>
                    <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Save" type="button" onclick="task.attachmentFormSubmitHandler('attach')"><i class="mdi mdi-check text-success"></i></button>
                    <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" type="button" onclick="task.addAttachmentFormToggle()"><i class="mdi mdi-close text-danger"></i></button>
                </td>
            </tr>
            </tfoot>
        </table>
    </form>

    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ATTACHMENT_ADD)
    <button type="button" class="btn btn-ghost-dark waves-effect waves-light btn-sm" onclick="task.addAttachmentFormToggle(1)">
        <i class="ri-add-line mt-1"></i> Add Attachment
    </button>
    @endcan
</div>

