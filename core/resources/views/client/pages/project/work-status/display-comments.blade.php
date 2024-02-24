@foreach($comments as $comment)
    <div class="d-flex mb-4">
        <div class="flex-shrink-0">
            <img src="{{ asset($comment->sender_photo) }}" alt="" class="avatar-xs rounded-circle">
        </div>
        <div class="flex-grow-1 ms-3">
            <h5 class="fs-13">
                <a href="#">{{ $comment->sender_name }}</a>
                <small class="text-muted">{{ \App\Utility\Helpers::ConvertDateFormat($comment->created_at, 'd M Y - h:s A') }}</small>
            </h5>
            <p class="text-muted">{{ $comment->message }}</p>
            @if(count($comment->attachments) > 0)
                <div class="row g-2 mb-3">
                    @foreach($comment->attachments as $attachment)
                        <div class="col-lg-1 col-sm-2 col-6">
                            <a href="javascript:void(0);" onclick="common.openFileViewModel('{{ asset($attachment->file_path) }}', '{{ $attachment->file_name }}')">{{ $attachment->file_name }}</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>
@endforeach
