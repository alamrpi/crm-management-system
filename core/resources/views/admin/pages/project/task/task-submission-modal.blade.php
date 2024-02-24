<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Project Name / Task: <span class="text-muted" id="dt_task_name">{{ $task->task_name }}</span></h4>
            <div class="flex-shrink-0">
                <div class="dropdown card-header-dropdown">
                    <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="text-muted fs-18"><i class="ri-settings-4-line align-middle me-1 fs-18"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="">
                        @include('admin.pages.project.task.inc._task-actions')
                    </div>
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav mb-2 float-end" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-semibold" href="javascript:void(0);" onclick="task.openTaskDetailsModal({{ $task->id }})">
                                Details
                            </a>
                        </li>
                        @if($task->status === \App\Constants\TaskStatus::COMPlETE)
                         <li class="nav-item" role="presentation">
                            <a class="nav-link fw-semibold" href="javascript:void(0);" id="tab-review" onclick="task.openReviewModal()">
                                In Review
                            </a>
                        </li>
                        @endif
                        @if($task->in_review === 1)
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fw-semibold active" href="javascript:void(0);" id="tab-submission">
                                Submission
                            </a>
                        </li>
                       @endif
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title mb-4 fs-18">Submission Comments</h5>
                            </div>
                            <div class="col-md-6 text-end">
                                @if($task->completed_status == 0 || $task->completed_status == App\Constants\Task\AcceptedStatus::REVISION)
                                    <a class="btn btn-sm btn-success" href="javascript:void(0);" onclick="task.changeAcceptanceStatus(this, {{ App\Constants\Task\AcceptedStatus::SUBMIT }})">Submit</a>
                                @endif
                            </div>
                       </div>
                     
                        <div data-simplebar="init" class="px-3 mx-n3 mb-2 simplebar-scrollable-y">
                            <div class="simplebar-wrapper" style="margin: 0px -16px;">
                                <div class="simplebar-height-auto-observer-wrapper">
                                    <div class="simplebar-height-auto-observer"></div>
                                </div>
                                <div class="simplebar-mask">
                                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                                            <div class="simplebar-content" id="submission-comment-placeholder" style="padding: 0px 16px;">
                                                <!--Automatic comment generate -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="simplebar-placeholder" style="width: 1196px; height: 601px;"></div>
                            </div>
                            <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                                <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                            </div>
                            <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                                <div class="simplebar-scrollbar" style="height: 429px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                            </div>
                        </div>
                        <form class="mt-4">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    <textarea class="form-control bg-light border-light" id="message" name="message" rows="3" placeholder="Enter submission comment"></textarea>
                                </div>
                                <!--end col-->
                                <div class="col-12 text-end">
                                    <input type="file" multiple name="attachments[]" id="attachments" style="display: none;">
                                    <label for="attachments" type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></label>
                                    <button type="button" onclick="task.storeCommentHandler(1)" class="btn btn-soft-dark">Send</button>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
