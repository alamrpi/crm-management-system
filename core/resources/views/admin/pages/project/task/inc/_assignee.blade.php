<div class="avatar-group">
    <div class="member-place-holder_{{ $task->id }}">
        @foreach($task->assignMembers as $member)
            <a href="javascript: void(0);" onclick="task.openAssignMemberEditModal(this, {{ $task->id }},{{ $member->id }}, '.member-place-holder_{{ $task->id }}')" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="{{ $member->name }}" data-bs-original-title="{{ $member->name }}">
                <img src="{{ asset($member->photo) }}" alt="" class="rounded-circle avatar-xxs">
            </a>
        @endforeach
    </div>
    @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ASSIGN)
    <a href="javascript: void(0);" onclick="task.openAssignMemberModal(this, {{ $task->id }}, '.member-place-holder_{{ $task->id }}')" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="New Assign" data-bs-original-title="New Assign">
        <div class="avatar-xxs">
            <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                <i class="bx bx-plus"></i>
            </div>
        </div>
    </a>
    @endcan
</div>
