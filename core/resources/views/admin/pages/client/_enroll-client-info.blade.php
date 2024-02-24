<div class="card" >
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0">
                <div class="avatar-lg rounded"><img src="{{ asset($client->photo) }}" alt="" class="member-img img-fluid d-block rounded">
                </div>
                <div class="col-lg mt-2 text-center w-100">
                    <a href="{{ route('admin/client/enrollStore', ['id' => $client->id]) }}" onclick="common.confirmAlert(event, this)" class="btn btn-sm btn-soft-success btn-icon waves-effect w-100"><i class="ri-attachment-2 me-1"></i> Enroll Now</a>
                </div>
            </div>
            <div class="flex-grow-1 ms-3"><a href="#"><h5 class="fs-16 mb-1">{{ $client->name }}</h5></a>
                <p class="text-muted mb-2">{{ $client->email }}</p>
                <div class="d-flex flex-wrap gap-2 align-items-center text-muted">
                    <a href="#">{{ $client->company_name }}</a>
                </div>
                <div class="d-flex gap-4 mt-2 text-muted">
                    <div><i class="ri-map-pin-2-line text-primary me-1 align-bottom"></i>
                        {{ $client->address }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
