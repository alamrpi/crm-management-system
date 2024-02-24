
@foreach($attachments as $attachment)
    <tr>
        <td>
            <a href="javascript: void(0);" onclick="common.openFileViewModel('{{ asset($attachment->path) }}')">{{ $attachment->attachment_name }}</a>
        </td>
        <td>{{ round($attachment->size) }} KB</td>
        <td>
            <div class="avatar-group">
                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="{{ $attachment->user_name }}" data-bs-original-title="{{ $attachment->user_name }}">
                    <img src="{{ asset($attachment->photo) }}"  alt="{{ $attachment->user_name }}"  class="rounded-circle avatar-xxs">
                </a>
            </div>
        </td>
        <td>{{ \App\Utility\Helpers::ConvertDateFormat($attachment->created_at, 'd M, y') }}</td>
        <td class="text-center">
            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="">
                <i class="ri-more-fill fs-17"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" style="">
                <li><span class="dropdown-item-text fs-12">ATTACHMENT</span></li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-pencil text-muted me-2 align-bottom"></i>Rename</a>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);"><i class="mdi mdi-vector-polyline text-muted me-2 align-bottom"></i>Copy URL</a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ asset($attachment->path) }}" download="{{ $attachment->attachment_name }}"><i class="mdi mdi-download text-muted me-2 align-bottom"></i>Download</a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::PR_TASK_ATTACHMENT_REMOVE)
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" onclick="task.deleteAttachmentHandler({{ $attachment->id }}, '{{ route('admin/project/task/attachment/delete', ['id' => \App\Utility\Helpers::getParamValue('id'), 'task_id' => 'task_id']) }}', this)"><i  class="ri-delete-bin-6-line text-danger me-2 align-bottom"></i>Delete</a>
                </li>
                @endcan
            </ul>
        </td>
    </tr>
@endforeach

