@if($tasks->count())
    <option selected>--Select--</option>
@endif
@forelse($tasks as $task)
    <option value="{{ $task->id }}">{{ $task->task_name }}</option>
@empty
    <option>No Task Available</option>
@endforelse
