<div class="card-body">
    <div class="card-header mb-2">
        <div class="d-flex">
            <div class="d-flex flex-grow-1 align-items-center">
                <h4 class="card-title mb-0 me-3">Add Action Items</h4>
            </div>
            <div class="d-flex justify-content-end flex-grow-0">
                <a href="javascript:void(0);" onclick="task.loadActionItems()" class="btn btn-sm bg-transparent fs-16 py-0">x</a>
            </div>
        </div><!-- end card header -->
    </div>
   <form onsubmit="task.storeActionItems(event, this)" action="{{ route('admin/project/task/action-items/store', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => \App\Utility\Helpers::getParamValue('task_id')]) }}" method="POST">
    @csrf
    <table class="table table-sm table-bordered mt-2">
        <thead>
            <tr>
                <td colspan="2"> <input type="text" class="form-control form-control-sm" placeholder="Action Name" id="action_name" name="action_name" required></td>
            </tr>
        </thead>
        <tbody id="action_items_placeholder">
            <tr>
                <td>
                    <input type="text" name="action_items[]" class="form-control form-control-sm" required>
                </td>
                <td style="width: 5%">
                    <button type="button" class="btn btn-sm btn-success float-end" title="add more" onclick="task.addMoreActionItems()"><i class="bx bx-plus"></i></button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">
                    <button class="btn btn-sm btn-primary float-end" type="submit">Submit</button>
                </td>
            </tr>
        </tfoot>
    </table>
   </form>
</div>
