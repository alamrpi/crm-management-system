<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light-subtle align-items-center d-flex">
            <h4 class="modal-title mb-0 flex-grow-1 fs-14"> <button type="button" onclick="task.closeTrackerEditForm()" class="btn btn-sm btn-info" style="display: none" id="btn-back"><i class="mdi mdi-arrow-left" ></i> Back</button> Working Hour List</h4>
            <button type="button" class="btn-close" onclick="task.closeWorkingHourModal()"></button>
        </div>
        <div class="modal-body">
           <div class="table-responsive" id="list-hours">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Assignee</th>
                            <th>Hour</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hours as $i => $row)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $row->member_name }}</td>
                            <td>{{ implode(':', explode('.', $row->working_hour)) }}</td>
                            <td>
                            @if(!empty ($row->start_time))
                                {{ App\Utility\Helpers::ConvertDateFormat($row->start_time, 'h:i A') }}
                            @endif
                            </td>
                            <td>
                            @if(!empty($row->end_time))
                                {{ App\Utility\Helpers::ConvertDateFormat($row->end_time, 'h:i A') }}
                            @endif
                            </td>
                            <td>{{ App\Utility\Helpers::ConvertDateFormat($row->created_at) }}</td>
                            <td class="text-center">
                                @if($row->start_time != $row->created_at)
                                    <button class="btn btn-sm btn-info" type="button" onclick="task.editTimeTracker({{ $row->id }})"><i class="bx bx-edit"></i></button>
                                    <button class="btn btn-sm btn-danger" type="button" onclick="task.removeTimeTracker({{ $row->id }})"><i class="bx bx-trash"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
           </div>
           <div id="edit-form-placeholder">

           </div>
        </div>
    </div>
</div>
