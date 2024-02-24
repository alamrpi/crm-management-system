<form action="{{ $url }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="department_id">Department<small class="text-danger">*</small></label>
        <select class="form-select form-select-sm select2 @error('department_id') is-invalid @enderror" id="department_id" name="department_id" required onchange="project.getServicesByDepartmentId(this.value, '#service_id', '{{ route('admin/department/service/getsForDdl') }}')">
            <option value="">--Select--</option>
            @foreach($departments as $department)
                <option value="{{ $department->id }}" {{ old('department') == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
            @endforeach
        </select>
        @error('department_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="service_id">Service<small class="text-danger">*</small></label>
        <select class="form-select form-select-sm @error('service_id') is-invalid @enderror" id="service_id" name="service_id" required>
            <option value="">--Select Department--</option>
        </select>
        @error('service_id')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="purchase-type">Purchase Type<small class="text-danger">*</small></label>
        <select class="form-select form-select-sm @error('purchase_type') is-invalid @enderror" id="purchase-type" name="purchase_type" required onchange="project.purchaseTypeHandler(this.value)">
            @foreach(\App\Constants\PurchaseType::GetTypes() as $value => $type)
                <option value="{{ $value }}" {{ old('purchase_type-type') == $value ? 'selected' : ''}}>{{ $type }}</option>
            @endforeach
        </select>
        @error('purchase_type')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    <div id="PerDayHour">

    </div>
    <div class="mb-3">
        <label for="total_hour" class="form-label"><span id="spnTotalHour">Hour</span><small class="text-danger">*</small></label>
        <input type="number" class="form-control form-control-sm @error('total_hour') is-invalid @enderror" id="total_hour" name="total_hour" required {{ old('total_hour') }}>
        @error('total_hour')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="text-end mb-4">
        <button type="submit" class="btn btn-primary w-sm btn-sm">Save</button>
    </div>
</form>

<div hidden id="hdnPerDayHourFields">
    <div class="mb-3">
        <label for="hour" class="form-label">Daily Hour<small class="text-danger">*</small></label>
        <input type="number" class="form-control form-control-sm" id="hour" name="hour" oninput="project.calculateTotalHourForService()" required>
    </div>
    <div class="mb-3">
        <label for="number_of_employee" class="form-label">Number of Employee<small class="text-danger">*</small></label>
        <input type="number" class="form-control form-control-sm" id="number_of_employee" name="number_of_employee" oninput="project.calculateTotalHourForService()" required>
    </div>
    <div class="mb-3">
        <label for="working_day" class="form-label">Working Day<small class="text-danger">*</small></label>
        <input type="number" class="form-control form-control-sm" id="working_day" name="working_day" oninput="project.calculateTotalHourForService()" required>
    </div>
</div>
