<div class="card-body">
    <div class="d-flex align-items-center">
        <div class="avatar-sm flex-shrink-0">
            <span
                class="avatar-title bg-light text-primary rounded-circle fs-3">
                <i class="ri-line-chart-fill align-middle"></i>
            </span>
        </div>
        <div class="flex-grow-1 ms-3">
            <p class="text-uppercase fw-semibold fs-12 text-muted mb-1">
                Total Projects</p>
            <h4 class=" mb-0" id="totalProjectCount">{{ $projects->count() }} {{ $projects->count() > 1 ? 'Projects' : 'Project' }}</h4>
        </div>

    </div>

    <div class="mt-3">
        <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-1">
            <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-success align-middle me-2"></i> Completed</p>
            <div>
                <span class="text-muted pe-5" id="completedProjectCount">{{ $projectGroup['completed'] ? $projectGroup['completed'] : '0' }} {{ $projectGroup['completed'] > 1 ? 'Projects' : 'Project' }}</span>
            </div>
        </div><!-- end -->
        <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-1">
            <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-primary align-middle me-2"></i> In Progress</p>
            <div>
                <span class="text-muted pe-5" id="inProgressProjectCount">{{ $projectGroup['in_progress'] ? $projectGroup['in_progress'] : '0'}} {{ $projectGroup['in_progress'] > 1 ? 'Projects' : 'Project' }}</span>
            </div>
        </div><!-- end -->
        <div class="d-flex justify-content-between border-bottom border-bottom-dashed py-1">
            <p class="fw-medium mb-0"><i class="ri-checkbox-blank-circle-fill text-warning align-middle me-2"></i> Not Started Yet</p>
            <div>
                <span class="text-muted pe-5" id="notStartedProjectCount">{{ $projectGroup['not_started'] ? $projectGroup['not_started'] : '0' }} {{ $projectGroup['not_started'] > 1 ? 'Projects' : 'Project' }}</span>
            </div>
        </div>
    </div>
</div><!-- end card body -->
