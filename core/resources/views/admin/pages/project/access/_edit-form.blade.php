<form action="{{ route('admin/project/access/update', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'access_id' => $access->id])}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3 text-right">
        <div class="col-lg-3">
            <label for="request_id" class="form-label float-end">Access Request :</label>
        </div>
        <div class="col-lg-8">
            <select name="request_id" id="request_id" class="form-control form-select">
                <option value="">None</option>
                @foreach($access_requests as $access_request)
                    <option value="{{ $access_request->id }}" {{ $access->request_id == $access_request->id ? 'selected' : '' }}>{{ $access_request->request_title}}</option>
                @endforeach
            </select>
            @error('request_id')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-3 text-right">
        <div class="col-lg-3">
            <label for="name" class="form-label float-end">Access Title<span class="text-danger">*</span> :</label>
        </div>
        <div class="col-lg-8">
            <input type="text" class="form-control @error('access_title') is-invalid @enderror" id="access_title" name="access_title" required value="{{ $access->access_title }}">
            @error('access_title')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-3 text-right">
        <div class="col-lg-3">
            <label for="data" class="form-label float-end">Access Details:</label>
        </div>
        <div class="col-lg-8">
            <textarea class="form-control @error('access_details') is-invalid @enderror" name="access_details" id="access_details" cols="30" rows="5">{{ $access->access_details }}</textarea>
            @error('access_details')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-3">
            <label for="icon" class="form-label float-end">File:</label>
        </div>
        <div class="col-lg-8">
            <input class="form-control @error('file') is-invalid @enderror" type="file" id="file" name="file">
            @error('file')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-11">
            <button type="submit" class="btn btn-primary float-end">Update</button>
        </div>
    </div>
</form>
