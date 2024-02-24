@can(App\Constants\Authorization\AuthGate::CHECK_AUTH, App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::PR_TASK_COMMENT_VIEW]),App\Utility\AuthHelper::getAccessIdsAsString([ App\Constants\Authorization\Access::PR_TASK_COMMENT_ADD]))
    <div class="card-body p-0">
        <h5 class="card-title mb-4 fs-18">Comments</h5>
        <div data-simplebar="init" style="height: 508px;" class="px-3 mx-n3 mb-2 simplebar-scrollable-y">
            <div class="simplebar-wrapper" style="margin: 0px -16px;">
                <div class="simplebar-height-auto-observer-wrapper">
                    <div class="simplebar-height-auto-observer"></div>
                </div>
                <div class="simplebar-mask">
                    <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                        <div class="simplebar-content-wrapper" tabindex="0" role="region" aria-label="scrollable content" style="height: 100%; overflow: hidden scroll;">
                            <div class="simplebar-content" id="display-comment-placeholder" style="padding: 0px 16px;">
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
                    <label for="message" class="form-label">Leave a Comments</label>
                    <textarea class="form-control bg-light border-light" id="message" name="message" rows="3" placeholder="Enter comments"></textarea>
                </div>
                <!--end col-->
                <div class="col-12 text-end">
                    <input type="file" multiple name="attachments[]" id="attachments" style="display: none;">
                    <label for="attachments" type="button" class="btn btn-ghost-secondary btn-icon waves-effect me-1"><i class="ri-attachment-line fs-16"></i></label>
                    <button type="button" onclick="task.storeCommentHandler()" class="btn btn-soft-dark">Post Comment</button>
                </div>
            </div>
            <!--end row-->
        </form>
    </div>
</div>
@endcan
