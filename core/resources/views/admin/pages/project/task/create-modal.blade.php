<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Create Task</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <div class="row">
               <div class="col-md-12">
                   <form action="{{ route('admin/project/task/store', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}" onsubmit="task.storeSubmitHandler(event, this)" method="POST">
                        @csrf
                       <input type="hidden" name="v" value="{{ request()->input('v') }}">
                       <input type="hidden" name="main_task_id" id="main_task_id" value="0">
                        <div class="mb-2">
                            <label for="task_name">Task Name</label>
                            <input type="text" name="task_name" id="task_name" class="form-control" required>
                        </div>
                       <div class="mb-2">
                           <label for="department_id">Department</label>
                           <select name="department_id" id="department_id" class="form-select select2" onchange="task.getServiceByDepartment(this, '#service_id')" required>
                               <option value="">--Select--</option>
                               @foreach($departments as $row)
                                   <option value="{{ $row->id }}">{{ $row->name }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="service_id">Service</label>
                           <select name="service_id" id="service_id" class="form-select select2" required>
                               <option value="">--Select--</option>
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="task_status">Status</label>
                           <select name="status" id="task_status" class="form-select select2" required>
                               @foreach(\App\Constants\TaskStatus::Gets() as $value => $text)
                                   <option value="{{ $value }}">{{ $text }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="priority">Priority</label>
                           <select name="priority" id="priority" class="form-select select2" required>
                               @foreach(\App\Constants\Priority::GetPriorities() as $value => $text)
                                   <option value="{{ $value }}">{{ $text }}</option>
                               @endforeach
                           </select>
                       </div>
                       <div class="mb-2">
                           <label for="due_date">Due Date</label>
                           <input type="date" name="due_date" id="due_date" class="form-control" required>
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
