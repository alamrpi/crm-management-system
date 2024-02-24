<div class="row">
    <div class="col">

        @if(!empty(session('success_msg')))
            <div class="alert alert-success border-0 alert-dismissible fade show mb-xl-0" role="alert">
                <strong>Success! </strong> {!! session('success_msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(!empty(session('error_msg')))
            <div class="alert alert-danger border-0 alert-dismissible fade show mb-xl-0" role="alert">
                <strong>Error! </strong> {!! session('error_msg') !!}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

    </div>
</div>
