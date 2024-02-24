@extends('admin.layout')

@section('title') Time & Activity Report | Admin @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Time & Activity Report</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-8">
            <form action="" method="GET">
                <div class="row gx-2">
                    <div class="col">
                        <label for="">Project</label>
                        <select class="col form-select" aria-label="Default select example select2" id="project_id" name="project_id">
                            <option value="">--All--</option>
                            @foreach($projects as $project)
                                <option value="{{ $project->id }}" {{ $project->id == request()->input('project_id') ? 'selected' : '' }}>{{ $project->project_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                        <div class="col">
                            <label for="">Member</label>
                            <select id="member_id" name="member_id" class="col form-select" aria-label="Default select example">
                                <option value="">--All--</option>
                                @foreach($members as $member)
                                    <option value="{{ $member->id }}" {{ request()->input('member_id') == $member->id ? 'selected' : '' }}>{{ $member->member_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <div class="col-auto">
                        <div class="row">
                            <label for="">Date Range</label>
                        </div>
                        <div class="row">
                            <div class="col pe-1">
                                <input class="form-control" id="from_date" name="from_date" value="{{ request()->input('from_date') }}" type="date" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" />
                            </div>
                            <div class="col-auto align-items-center justify-content-center d-flex px-0">To</div>
                            <div class="col ps-1">
                                <input class="form-control" id="to_date" name="to_date" value="{{ request()->input('to_date') }}" type="date" data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true">
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="row" style="opacity: 0;"><label for="">filter</label></div>
                        <div class="row">
                            <div class="col">
                                <button type="submit"  class="col btn btn-success waves-effect waves-light">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-body">
                    @foreach($rows->groupBy('created_date') as $data)
                        <h5 class="h5">{{ \App\Utility\Helpers::ConvertDateFormat($data[0]->created_at, "d M Y") }}</h5>
                        <div class="blockquote custom-blockquote blockquote-outline blockquote-primary border-bottom-0 border-top-0 border-end-0 ms-3 mb-3">
                            <table class="table table-borderless table-striped table-responsive">
                                <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Member</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Time Worked</th>
                                    <th scope="col">Tracker Time</th>
                                    <th scope="col">Manual Time</th>
                                    <th scope="col">Notes</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $row)
                                    <tr>
                                        <td>
                                            <img src="{{ asset($row->photo) }}" alt="" class="avatar-xs rounded-3 me-2"> {{ $row->user_name }}
                                        </td>
                                        <td>{{ $row->project_name }}</td>
                                        <td>{{ $row->task_name }}</td>
                                        <td>{{ implode(':', explode('.', $row->working_hour) )}}</td>
                                        <td>
                                            @if(!empty($row->end_time) && !empty($row->start_time))
                                                {{ \App\Utility\Helpers::ConvertDateFormat($row->start_time, "d/m/y H:i") }} - {{  \App\Utility\Helpers::ConvertDateFormat($row->end_time, 'd/m/y H:i') }}
                                            @endif
                                        </td>
                                        <td>
                                            @if(empty($row->end_time) && empty($row->start_time))
                                                {{ implode(':', explode('.', $row->working_hour) )}}
                                            @endif
                                        </td>
                                        <td><a href="#" onclick="noteModal('{{ $row->note }}')" class="link-primary">Notes</a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer">
                    {{ $rows->links() }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="noteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="note_text"></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function noteModal(note){
            $('#note_text').text(note);
            $('#noteModal').modal('show');
        }
    </script>
@endsection
