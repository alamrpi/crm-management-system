@foreach(\App\Constants\TaskStatus::Gets() as $value => $text)
    <li>
        <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, {{ $value }}, {{ $task->id }}, {{ isset($is_details) ?? 0 }})">
            <i class="ri-radio-button-line me-2 align-bottom {{ \App\Constants\TaskStatus::getTextColor($value) }}"></i>
            {{ strtoupper($text) }}
            @if($task->status == $value)
                <i class="ri-check-line me-2 align-bottom text-success-emphasis ms-3"></i>
            @endif
        </a>
    </li>
@endforeach
