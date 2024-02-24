<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Create Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <form action="{{ route('admin/project/task/update', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => $task->id]) }}" method="POST">
                        @csrf
                       <input type="hidden" name="v" value="{{ request()->input('v') }}">
                        <div class="mb-2">
                            <label for="task_name">Task Name</label>
                            <input type="text" name="task_name" id="task_name" class="form-control" value="{{ $task->task_name }}" required>
                        </div>
                       <div class="mb-2">
                           <label for="department_id">Department</label>
                           <select name="department_id" id="department_id" class="form-select select2" onchange="task.getServiceByDepartment(this, '#service_id')" required>
                               <option value="">--Select--</option>
                               @foreach($departments as $row)
                                   <option value="{{ $row->id }}" {{ $task->dept_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="service_id">Service</label>
                           <select name="service_id" id="service_id" class="form-select select2" required>
                               <option value="">--Select--</option>
                               @foreach ($services as $row)
                                <option value="{{ $row->id }}" {{ $task->service_id == $row->id ? 'selected' : '' }}>{{ $row->name }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="task_status">Status</label>
                           <select name="status" id="task_status" class="form-select select2" required>
                               @foreach(\App\Constants\TaskStatus::Gets() as $value => $text)
                                   <option value="{{ $value }}" {{ $task->status == $value ? 'selected' : '' }}>{{ $text }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="priority">Priority</label>
                           <select name="priority" id="priority" class="form-select select2" required>
                               @foreach(\App\Constants\Priority::GetPriorities() as $value => $text)
                                   <option value="{{ $value }}" {{ $task->priority == $value ? 'selected' : '' }}>{{ $text }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="due_date">Due Date</label>
                           <input type="date" name="due_date" id="due_date" class="form-control" value="{{ $task->due_date }}" required>
                       </div>
                       <div class="mb-2 float-end">
                           <button type="submit" class="btn btn-primary"><i class="bx bx-save"></i> Save</button>
                       </div>
                   </form>
               </div>
           </div>
        </div>
    </div>
</div>
