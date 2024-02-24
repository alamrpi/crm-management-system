<div class="collapse" id="collapseSearch">
    <form action="{{ route('admin/project/task/index', ['id' => \App\Utility\Helpers::getParamValue('id')]) }}" method="get" class="mt-2">
        <input type="hidden" name="v" value="{{ request()->input('v') }}">
        <div class="row g-1">
            <div class="col-sm-2">
                <input type="text" class="form-control form-control-sm" name="task_name" id="task_name" value="{{ request()->input('task_name') }}" placeholder="Task">
            </div>
            <div class="col-sm-2">
                <select name="task_status" id="task_status" class="form-select form-select-sm">
                    <option value="">-- All Status --</option>
                    @foreach(\App\Constants\TaskStatus::Gets() as $value => $text)
                        <option value="{{ $value }}" {{ request()->input('task_status') == $value ? 'selected' : '' }}>{{ strtoupper($text) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select name="priority" id="priority" class="form-select form-select-sm">
                    <option value="">-- All Priority --</option>
                    @foreach(\App\Constants\Priority::GetPriorities() as $value => $text)
                        <option value="{{ $value }}" {{ request()->input('priority') == $value ? 'selected' : '' }}>{{ strtoupper($text) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <select name="assign_member_id" id="assign_member_id" class="form-select form-select-sm">
                    <option value="">-- Assignee --</option>
                    @foreach($team_members as $team_member)
                        <option value="{{ $team_member->id }}" {{ request()->input('assign_member_id') == $team_member->id ? 'selected' : ''}}>{{ $team_member->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-1">
                <select name="more" id="more" class="form-select form-select-sm">
                    <option value="">-- More --</option>
                    <option value="1" {{ request()->input('more') == 1 ? 'selected' : '' }}>Revision</option>
                    <option value="2" {{ request()->input('more') == 2 ? 'selected' : '' }}>Late</option>
                </select>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-light btn-sm waves-effect waves-light">Search</button>
            </div>
        </div>
    </form>
</div>
