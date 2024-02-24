<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14">Edit Service: <span class="text-muted"></span></h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="{{ route('admin/project/service/next/update', ['id'=> \App\Utility\Helpers::getParamValue('id')]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="purchase_id" value="{{ $purchaseService->id }}">
            <div class="mb-3">
                <label class="form-label" for="department_id">Department<small class="text-danger">*</small></label>
                <select class="form-select form-select-sm select2 @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required onchange="project.getServicesByDepartmentId(this.value, '#modalservice_id', '{{ route('admin/department/service/getsForDdl') }}')">
                    <option value="">--Select--</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ $purchaseService->dept_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label" for="service_id">Service<small class="text-danger">*</small></label>
                <select class="form-select form-select-sm @error('service_id') is-invalid @enderror" id="modalservice_id" name="service_id" required>
                    <option>--Select Department--</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $service->id == $purchaseService->service_id ? 'selected' : '' }}>{{ $service->service_name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="modalpurchase-type">Purchase Type<small class="text-danger">*</small></label>
                <select class="form-select form-select-sm @error('purchase_type') is-invalid @enderror" id="modalpurchase-type" name="purchase_type" required onchange="project.modalPurchaseTypeHandler(this.value)">
                    @foreach(\App\Constants\PurchaseType::GetTypes() as $value => $type)
                        <option value="{{ $value }}" {{ $purchaseService->purchase_type == $value ? 'selected' : ''}}>{{ $type }}</option>
                    @endforeach
                </select>
                @error('purchase_type')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div id="modalPerDayHour">

            </div>
            <div class="mb-3">
                <label for="modaltotal_hour" class="form-label"><span id="modalspnTotalHour">Hour</span><small class="text-danger">*</small></label>
                <input type="number" class="form-control form-control-sm @error('total_hour') is-invalid @enderror" id="modaltotal_hour" name="total_hour" required value="{{ $purchaseService->total_hour }}">
                @error('total_hour')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-end mb-4">
                <button type="submit" class="btn btn-primary w-sm btn-sm">Save</button>
            </div>
        </form>

        <div hidden id="modalhdnPerDayHourFields">
            <div class="mb-3">
                <label for="hour" class="form-label">Daily Hour<small class="text-danger">*</small></label>
                <input type="number" class="form-control form-control-sm" id="modalhour" name="hour" value="{{ $purchaseService->hour ?? 0 }}" oninput="project.modalcalculateTotalHourForService()" required>
            </div>
            <div class="mb-3">
                <label for="number_of_employee" class="form-label">Number of Employee<small class="text-danger">*</small></label>
                <input type="number" class="form-control form-control-sm" id="modalnumber_of_employee" name="number_of_employee" value="{{ $purchaseService->number_of_employee ?? 0 }}" oninput="project.modalcalculateTotalHourForService()" required>
            </div>
            <div class="mb-3">
                <label for="working_day" class="form-label">Working Day<small class="text-danger">*</small></label>
                <input type="number" class="form-control form-control-sm" id="modalworking_day" name="working_day" value="{{ $purchaseService->working_day ?? 0 }}" oninput="project.modalcalculateTotalHourForService()" required>
            </div>
        </div>
    </div>
</div>
</div>
