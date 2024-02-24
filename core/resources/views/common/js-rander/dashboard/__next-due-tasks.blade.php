@foreach($tasks as $task)
    <div class="card-body py-0">
    <div class="card card-animate border border-1 mb-1">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h5 class="fs-14 fw-semibold">Task - website layout design</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="d-flex align-items-center" style="width: 100px;">
                        <div class="flex-shrink-0 me-1 text-muted fs-10">53%</div>
                        <div class="progress progress-sm  flex-grow-1" style="width: 68%;">
                            <div class="progress-bar bg-primary rounded" role="progressbar" style="width: 53%" aria-valuenow="53" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <p class="text-muted fs-12">5/10 Tasks | 10/5 Hrs</p>
                </div>
                <div class="col-4 fs-12">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Due Date</p>
                    {{ date('m/d/Y') }}
                </div>
                <div class="col-4 fs-12">
                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Remain Day</p>
                    <span class="text-success">3 Days</span>
                </div>
            </div>
            <div class="row mt-n2">
                <div class="col-12 fs-12">
                    Dept: <span class="text-muted">Department Name</span> |
                    Service: <span class="text-muted">Service Name</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach
