
<!-- Modal -->
<div class="modal custom-modal" id="requestAddOrEditModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header pb-3 bg-light-subtle">
                <h1 class="modal-title fs-5" id="requestAddOrEditModalTitle">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" id="requestForm" method="post">
                            @csrf
                            <div class="row mb-3 text-right">
                                <div class="col-lg-3">
                                    <label for="request_title" class="form-label float-end">Request Title<span class="text-danger">*</span> :</label>
                                </div>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control @error('request_title') is-invalid @enderror" id="request_title" name="request_title" required="" value="{{ old('request_title') }}">
                                </div>
                            </div>
                            <div class="row mb-3 text-right">
                                <div class="col-lg-3">
                                    <label for="request_details" class="form-label float-end">Request Details:</label>
                                </div>
                                <div class="col-lg-8">
                                    <textarea class="form-control @error('request_details') is-invalid @enderror" name="request_details" id="request_details" cols="30" rows="5">{{ old('request_details') }}</textarea>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-11">
                                    <button type="submit" id="btn_request_submit" class="btn btn-primary float-end w-md">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
