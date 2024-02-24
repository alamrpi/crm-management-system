<div class="card card-height-100">
    <div class="card-body">
        <div class="d-flex">
        <h4 class="card-title mb-0 flex-grow-1">Tasks: {{ $selected_dept }}</h4>
        <div class="d-flex flex-grow-1">
            <label for="" class="flex-grow-1 text-end p-1 m-0"><strong>SORT BY DEPARTMENT: </strong></label>
            <select class="form-select form-control-sm float-end border-0 w-50 p-1" onchange="workStatus.loadTasks(this.value)" aria-label="Default select example">
                <option value="">All</option>
                @foreach ($departments as $dept)
                    <option value="{{ $dept->id }}" {{ $department_id == $dept->id ? 'selected' : '' }}>{{ $dept->name }}</option>
                @endforeach
            </select>
        </div>
        </div>
        <div class="card-body">
                <div class="accordion custom-accordionwithicon custom-accordion-border accordion-border-box"
                     id="accordionFill2">
                     @foreach ($main_tasks as $i => $task)
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="accordionFill{{ $i }}Example1">
                            <button class="accordion-button fw-bold collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#accor_fill2{{ $i }}"
                                    aria-expanded="false" aria-controls="accor_fill2{{ $i }}" style="z-index: unset;">
                                <strong class="me-1">{{ $i+1 }})</strong>{{ $task->task_name }}<span class="badge {{ App\Constants\TaskStatus::getBgSubTitleColor($task->status) }} {{ App\Constants\TaskStatus::getTextColor($task->status) }} ms-3">{{ App\Constants\TaskStatus::ConvertNumberToText($task->status) }}</span>
                            </button>

                            <div class="d-flex align-items-center" style="width: 150px;float: right;margin-top: -45px;position: relative;margin-right: 50px;">
                                @foreach ($task->assignees as $assignee)
                                    <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="{{ $assignee->name }}">
                                        <img src="{{ asset($assignee->photo) }}" alt="{{ $assignee->name }}" class="rounded-circle avatar-xxs">
                                    </a>
                                @endforeach
                            </div>

                        </h2>
                        <div id="accor_fill2{{ $i }}" class="accordion-collapse collapse"
                             aria-labelledby="accordionFill{{ $i }}Example1" data-bs-parent="#accordionFill{{ $i }}"
                             style="">
                            <div class="accordion-body">

                                <div class="mb-4">
                                   {{ $task->description }}
                                   <button type="button" class="btn btn-sm float-end btn-ghost-primary waves-effect waves-light" onclick="workStatus.openTaskDetailModal({{ $task->id }})">Details</button>
                                </div>

                                @if(count($task->sub_tasks) > 0)
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-nowrap table-centered align-middle mb-0 table-hover table-sm">
                                        <thead class="table-light text-muted">
                                    
                                        <tr>
                                            <th scope="col">Task</th>
                                            <th scope="col">Dedline</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Assignee</th>
                                        </tr>
                                        </thead><!-- end thead -->
                                        <tbody>
                                            @foreach ($task->sub_tasks as $idx => $item)
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-ghost-primary waves-effect waves-light" onclick="workStatus.openTaskDetailModal({{ $item->id }})">{{ $idx+1 }}. {{ $item->task_name }}</button>
                                                    </td>
                                                    <td class="text-muted">{{ App\Utility\Helpers::ConvertDateFormat($item->due_date, "d M Y") }}</td>
                                                    <td>
                                                        <span class="badge {{ App\Constants\TaskStatus::getBgSubTitleColor($item->status) }} {{ App\Constants\TaskStatus::getTextColor($item->status) }} ms-3">{{ App\Constants\TaskStatus::ConvertNumberToText($item->status) }}</span>
                                                    </td>
                                                    <td>
                                                        @foreach ($item->assignees as $ass)
                                                        <a href="javascript: void(0);" class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="{{  $ass->name }}">
                                                            <img src="{{ asset($ass->photo) }}" alt="{{  $ass->name }}" class="rounded-circle avatar-xxs">
                                                        </a>
                                                        @endforeach
                                                    </td>
                                                </tr><!-- end -->
                                            @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                     @endforeach
        
                </div>
            </div><!-- end card-body -->
    </div><!-- end card-body -->
</div><!-- end card -->