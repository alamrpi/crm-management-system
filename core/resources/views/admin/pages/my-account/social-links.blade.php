@extends('admin.layout')

@section('title') Social Links @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Social Links</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    @include('admin.pages.my-account._menu')
                </div>
                <div class="card-body p-2">
                    @include('admin.shared.alert-template')
                    <div class="card-body p-2">
                       <div class="border p-4 rounded">
                           <form action="{{ route('admin/socialLinks/store') }}" method="post" class="">
                               @csrf
                               <div class="mb-2">Add New</div>
                               <div class="row g-1">
                                   <div class="col-sm-3">
                                       <select class="form-control form-control-sm" name="media_name" id="media_name" required>
                                           <option value="">-- Select --</option>
                                           @foreach($socialNetworks as $network)
                                               <option value="{{ $network->id }}">{{ $network->name }}</option>
                                           @endforeach
                                       </select>
                                   </div>
                                   <div class="col-sm-6">
                                       <input type="text" class="form-control form-control-sm" name="profile_url" id="profile_url" required placeholder="Link" autocomplete="off">
                                   </div>
                                   <div class="col-sm-2">
                                       <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-plus"></i> Add</button>
                                   </div>
                               </div>
                           </form>
                       </div>

                        <div class="table- mt-2">
                            <table class="table table-striped table-borderless table-sm align-middle mb-0">
                                <tbody>
                                @foreach($social_links as $social_link)
                                    <tr class="ts-12">
                                        <td>{!! $social_link->icon !!} {{ $social_link->name }}</td>
                                        <td>
                                            <a href="{{ $social_link->profile_url }}" target="_blank">View Profile</a></td>
                                        <td style="width: 120px;">
                                            <button class="btn btn-link text-primary" type="button" onclick="copyLink('#tempTextArea_{{ $social_link->id }}', this)">Copy Link</button>
                                            <textarea id="tempTextArea_{{ $social_link->id }}" style="display: none;">{{ $social_link->profile_url }}</textarea>
                                        </td>
                                        <td><a class="btn btn-link text-danger confirm-alert" href="{{ route('admin/socialLinks/delete', ['media_id' => $social_link->id]) }}">x</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        async function copyLink(textSelector, btn){
            const tempTextArea = $(textSelector).val();
            await navigator.clipboard.writeText(tempTextArea);
            $(btn).text('Copied').prop('disabled', true);
            setTimeout(() => {
                $(btn).text('Copy Link').prop('disabled', false);
            }, 2000)
        }
    </script>
@endsection
