<a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="text-muted"><i class="ri-settings-4-line align-middle me-1 fs-14"></i></span>
</a>
<div class="dropdown-menu dropdown-menu-end border dontClose">
    <ul class="nav nav-tabs nav-tabs-custom nav-success nav-justified mb-3" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link text-nowrap active" data-bs-toggle="tab" href="#time-tracker-manual" role="tab" aria-selected="false" tabindex="-1" onclick="this.parentNode.parentNode.parentNode.classList.add('show')">
                <i class="mdi mdi-file-document-edit-outline"></i> Manual
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link text-nowrap" data-bs-toggle="tab" href="#time-tracker-range" role="tab" aria-selected="true">
                <i class="mdi mdi-arrow-expand-horizontal"></i> Range
            </a>
        </li>
    </ul>
    <div class="tab-content text-muted">
        <div class="tab-pane active" id="time-tracker-manual" role="tabpanel">
            <div class="card border-0">
                <div class="card-body">
                    <input type="text" class="form-control form-control-sm" id="hour" placeholder="Enter time e.g. 3:20">
                    <button class="btn btn-sm btn-soft-success w-100 mt-2" onclick="task.saveHourTimeTrackerHandler()">Save</button>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="time-tracker-range" role="tabpanel">
            <div class="card border-0">
                <div class="card-body">
                    <div class="input-group">
                        <input type="time" id="fromTime" class="form-control form-control-sm">
                        <span class="input-group-text py-0 px-1">TO</span>
                        <input type="time" id="endTime" class="form-control form-control-sm">
                    </div>
                    <button class="btn btn-sm btn-soft-success w-100 mt-2" onclick="task.saveManualTrackingHandler()">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
