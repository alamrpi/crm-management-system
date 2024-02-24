<div class="table-responsive bg-white">
    <table class="table table-sm">
        <tbody>
        @forelse($tasks as $task)
            <tr>
                <td>
                    <a  href="{{ route('admin/project/task/detailsView', ['id'=>$task->project_id, 'task_id'=> $task->id]) }}" target="_blank"><h5 class="fs-14 fw-semibold cursor-pointer">{{ $task->task_name }}</h5></a>

                    <p class="fs-12 mb-1">{{ $task->project_name }}</p>
                </td>
                <td>
                    <span class="">{{ $task->total_hour }} Hrs</span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">
                    No Tasks Available!
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
