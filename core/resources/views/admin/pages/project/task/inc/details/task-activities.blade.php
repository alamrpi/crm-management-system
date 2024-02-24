<div class="table-responsive table-card m-0">
    <table class="table table-sm fs-14">
        <thead class="table-light text-muted">
        <tr>
            <th scope="col">Activity</th>
            <th scope="col">Date-Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($activities as $row)
            <tr>
            <td>
                {!! \App\Utility\Helpers::replaceUserName($row->activity, $row->created_by, $row->created_user_name) !!}
            </td>
            <td>{{ \App\Utility\Helpers::ConvertDateFormat($row->created_at, 'd/m/y h:i:s A') }}</td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>