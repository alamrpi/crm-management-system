<div class="row mb-3">
    <div class="col-md">
        <div class="row align-items-center g-3">
            <div class="col-md-auto">
                <div class="avatar-md">
                    <div class="avatar-title bg-light rounded-circle">
                        <img src="{{ asset($project_view->thumbnail) }}" alt="" class="avatar-xs">
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div>
                    <h4 class="fw-bold">{{ $project_view->project_name }}</h4>
                    <div class="hstack gap-3 flex-wrap">
                        <div>Clinet: {{ $project_view->client_name }}, {{ $project_view->address }}</div>
                        <div class="vr"></div>
                        <div>Create Date : <span
                                    class="fw-medium">{{ \App\Utility\Helpers::ConvertDateFormat($project_view->created_at, 'd M, Y') }}</span>
                        </div>
                        <div class="vr"></div>
                        <div>Deadline : <span
                                    class="fw-medium">{{ \App\Utility\Helpers::ConvertDateFormat($project_view->deadline, 'd M, Y') }}</span>
                        </div>
                        <div class="vr"></div>
                        <div>Target : <span
                                    class="fw-medium">{{ \App\Utility\Helpers::ConvertDateFormat($project_view->target, 'd M, Y') }}</span>
                        </div>
                        <div class="vr"></div>
                        <div class="badge rounded-pill {{ \App\Constants\ProjectStatus::GetColorClassName($project_view->status) }} fs-12">{{ \App\Constants\ProjectStatus::ConvertNumberToText($project_view->status) }}</div>
                        <div class="badge rounded-pill {{ \App\Constants\Priority::GetColorName($project_view->priority) }} fs-12">{{ \App\Constants\Priority::ConvertNumberToText($project_view->priority) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
