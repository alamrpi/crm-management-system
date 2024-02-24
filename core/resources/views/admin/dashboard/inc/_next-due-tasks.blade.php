@foreach($nextDueTasks as $task)
<div class="card-body py-0">
    <div class="card card-animate border border-1 mb-1">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <a  href="{{ route('admin/project/task/detailsView', ['id'=>$task->project_id, 'task_id'=> $task->id]) }}" target="_blank"><h5 class="fs-14 fw-semibold cursor-pointer">{{ $task->task_name }}</h5></a>

                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="d-flex align-items-center" style="width: 100px;">
                        <div class="flex-shrink-0 me-1 text-muted fs-10">{{ $task->total_hour ? (((int)$task->completed_hour / (int)$task->total_hour)*100) : 0}}%</div>
                        <div class="progress progress-sm  flex-grow-1" style="width: 68%;">
                            <div class="progress-bar bg-primary rounded" role="progressbar" style="width: {{ $task->total_hour ? (((int)$task->completed_hour / (int)$task->total_hour)*100) : 0}}%" aria-valuenow="{{ $task->total_hour ? (((int)$task->completed_hour / (int)$task->total_hour)*100) : 0}}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <p class="text-muted fs-12">{{ $task->total_hour }}/{{ $task->completed_hour }} Hrs</p>
                </div>
                <div class="col-4 fs-12">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Due Date</p>
                    {{ \Carbon\Carbon::createFromDate($task->due_date)->format('d-m-Y') }}
                </div>
                <div class="col-4 fs-12">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Remain Day</p>
                    <span class="text-success">{{ $diff = \Carbon\Carbon::today('Asia/Dhaka')->diffInDays(\Carbon\Carbon::createFromFormat('Y-m-d',$task->due_date)) }} {{ $diff > 1 ? 'days' : 'day' }}</span>
                </div>
            </div>
            <div class="row mt-n2">
                <div class="col-12 fs-12">
                    Project: <span class="text-muted">{{ $task->project_name }}</span> |
                    Dept: <span class="text-muted">{{ $task->department_name }}</span> |
                    Service: <span class="text-muted">{{ $task->service_name  }}</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach
