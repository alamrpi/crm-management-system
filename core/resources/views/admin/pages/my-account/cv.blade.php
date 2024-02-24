@extends('admin.layout')

@section('title') CV @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">CV</h4>
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
                          <form action="{{ route('admin/cv/store') }}" method="post" enctype="multipart/form-data">
                              @csrf
                              <div class="mb-2">New Upload</div>
                              <div class="row g-1">
                                  <div class="col-sm-6">
                                      <input type="text" class="form-control form-control-sm" name="file_name" id="file_name" required placeholder="Name" autocomplete="off">
                                  </div>
                                  <div class="col-sm-3">
                                      <input type="file" class="form-control form-control-sm" id="file" name="file" required accept=".pdf,.doc,.docx">
                                  </div>
                                  <div class="col-sm-2">
                                      <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-cloud-upload-outline"></i> Upload</button>
                                  </div>
                              </div>
                          </form>
                      </div>

                        <div class="table- mt-2">
                            <table class="table table-striped table-borderless align-middle mb-0">
                                <tbody>
                                @foreach($cvs as $cv)
                                    <tr>
                                        <td>{!! pathinfo($cv->file_path)['extension'] == 'pdf' ? '<i class="mdi mdi-file-pdf-box"></i>' : '<i class="mdi mdi-file-word-outline"></i>' !!} {{ $cv->file_name }}</td>
                                        <td>{{ date('d/m/y', strtotime($cv->created_at)) }}</td>
                                        <td><a href="#" onclick="common.openFileViewModel('{{ asset($cv->file_path) }}', '{{ $cv->file_name }}')">View</a></td>
                                        <td><a class="btn btn-link text-danger confirm-alert" href="{{ route('admin/cv/delete', ['cv_id' => $cv->id]) }}">x</a></td>
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
