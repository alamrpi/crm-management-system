<form onsubmit="task.submitTrackerUpdateForm(event, this)" action="{{ route('admin/project/task/update-tracker', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => \App\Utility\Helpers::getParamValue('task_id')]) }}" method="POST">
    @csrf
    <input type="hidden" name="tracker_id" value="{{ $tracker->id }}">
    @if($tracker->start_time == null && $tracker->end_time == null)
    <div class="form-group">
        <input type="text" class="form-control form-control-sm" value="{{ implode(':', explode('.', $tracker->working_hour)) }}" id="working_hour" name="working_hour" placeholder="Enter time e.g. 3:20">
    </div>
    @else
    <div class="input-group">
        <div class="input-group">
            <input type="time" id="startTime" name="startTime" class="form-control form-control-sm" value="{{ date('H:i', strtotime($tracker->start_time)) }}">
            <span class="input-group-text py-0 px-1">TO</span>
            <input type="time" id="endTime" name="endTime" class="form-control form-control-sm" value="{{ date('H:i', strtotime($tracker->end_time)) }}">
        </div>
    </div>
    @endif
    <div class="form-group">
        <button class="btn btn-sm btn-soft-success w-100 mt-2" type="submit">Update</button>
    </div>
</form>