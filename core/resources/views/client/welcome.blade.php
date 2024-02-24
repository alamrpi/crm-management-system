@extends('client.layout')

@section('title') Welcome @endsection

@section('content')
    <div class="row">
        <div class="col-sm-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <iframe style="width: 100%; height:60vh;" src="https://www.youtube.com/embed/SlhESAKF1Tk"></iframe>
                </div>
            </div>

            @if($current_project != null)
                <p class="text-center mt-2"><a href="{{ route('clientarea/project/dashboard', ['slug'=> $current_project['slug']]) }}" class="btn btn-success">Skip & Go Dashboard</a></p>
            @endif
        </div><!-- end col -->
    </div><!-- end row -->
@endsection
