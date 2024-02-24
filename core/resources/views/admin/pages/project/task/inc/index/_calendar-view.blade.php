<div class="row">
{{--    <div class="col-lg-12">--}}
{{--        <div class="collapse" id="collapseSearch">--}}
{{--            <form action="#" method="get" class="mt-2">--}}
{{--                <div class="row g-1">--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <input type="text" class="form-control form-control-sm" name="name" id="name" value=""--}}
{{--                               placeholder="Task">--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <select name="department_id" id="department_id" class="form-select form-select-sm">--}}
{{--                            <option value="">-- Status --</option>--}}
{{--                            <option value="1">TO DO</option>--}}
{{--                            <option value="1">IN PROGRESS</option>--}}
{{--                            <option value="1">IN REVIEW</option>--}}
{{--                            <option value="1">COMPLETE</option>--}}
{{--                            <option value="1">COMPLETE</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <select name="department_id" id="department_id" class="form-select form-select-sm">--}}
{{--                            <option value="">-- Priority --</option>--}}
{{--                            <option value="1">LOW</option>--}}
{{--                            <option value="1">MEDIUM</option>--}}
{{--                            <option value="1">HIGH</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <select name="department_id" id="department_id" class="form-select form-select-sm">--}}
{{--                            <option value="">-- Assignee --</option>--}}
{{--                            <option value="1">A</option>--}}
{{--                            <option value="1">B</option>--}}
{{--                            <option value="1">C</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-1">--}}
{{--                        <select name="department_id" id="department_id" class="form-select form-select-sm">--}}
{{--                            <option value="">-- More --</option>--}}
{{--                            <option value="1">Revision</option>--}}
{{--                            <option value="1">Late</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-2">--}}
{{--                        <button type="submit" class="btn btn-light btn-sm waves-effect waves-light">Search</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="row mt-2">
        <div class="col-md-4">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="calendar-preview" id='calendar2' class="mb-4"></div>
                        </div>
                        <div class="card-body">
                            <div class="card-header">
                                <h4 class="card-title">Filter</h4>
                            </div>
                            <div class="ps-3">
                                <!-- Custom Checkboxes Color -->
                                <div class="form-check form-check-dark mb-3">
                                    <input class="form-check-input" name="calendarFilterStatus" value="all" type="checkbox" id="formCheck6" checked>
                                    <label class="form-check-label" for="formCheck6">
                                        All
                                    </label>
                                </div>
                                <div class="form-check form-check-secondary mb-3">
                                    <input class="form-check-input" name="calendarFilterStatus" value="todo" type="checkbox" id="formCheck10" checked>
                                    <label class="form-check-label" for="formCheck10">
                                        TO DO
                                    </label>
                                </div>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" name="calendarFilterStatus" value="in_progress" type="checkbox" id="formCheck6" checked>
                                    <label class="form-check-label" for="formCheck6">
                                        IN PROGRESS
                                    </label>
                                </div>
                                <div class="form-check form-check-success mb-3">
                                    <input class="form-check-input" name="calendarFilterStatus" value="completed" type="checkbox" id="formCheck9" checked>
                                    <label class="form-check-label" for="formCheck9">
                                        COMPLETED
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <div id='calendar' class="mb-4"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script src='{{ asset('core/resources/js/fullcalendar/dist/index.global.min.js') }}'></script>
    <script src='{{ asset('core/resources/js/Task.js') }}'></script>

    <script>
        const task = new Task({{ \App\Utility\Helpers::getParamValue('id') }});
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                initialDate: new Date().toISOString().slice(0, 10),
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                // select: function (arg) {
                //     var title = prompt('Event Title:');
                //     if (title) {
                //         calendar.addEvent({
                //             title: title,
                //             start: arg.start,
                //             end: arg.end,
                //             allDay: arg.allDay
                //         })
                //     }
                //     calendar.unselect()
                // },
                eventClick: function (arg) {
                    // console.log(arg.event);
                    task.openCreateModalByURL(arg.event.extendedProps.dataCallUrl);
                },
                dayMaxEvents: true, // allow "more" link when too many events
                events: [
                    @foreach($tasks->groupBy('due_date') as $dates)
                        @foreach($dates->groupBy('status') as $status)
                            @if($status[0]->status == \App\Constants\TaskStatus::COMPlETE)
                            {
                                title: 'COMPLETED ({{ $status->count() }})',
                                start: '{{ $status[0]->due_date }}',
                                className: 'p-0 {{ \App\Constants\TaskStatus::getBgColor($status[0]->status) }}',
                                cursor: 'pointer',
                                groupId: 'completed',
                                extendedProps: {
                                    dataCallUrl: '{{ route('admin/project/task/calendar-view-filter', ['id' => \App\Utility\Helpers::getParamValue('id'),'task_status'=>$status[0]->status, 'task_date'=>$status[0]->due_date]) }}',
                                }
                            },
                            @endif
                            @if($status[0]->status == \App\Constants\TaskStatus::IN_PROGRESS)
                            {
                                title: 'IN-PROGRESS ({{ $status->count() }})',
                                start: '{{ $status[0]->due_date }}',
                                className: 'p-0 {{ \App\Constants\TaskStatus::getBgColor($status[0]->status) }}',
                                cursor: 'pointer',
                                groupId: 'in_progress',
                                extendedProps: {
                                    dataCallUrl: '{{ route('admin/project/task/calendar-view-filter', ['id' => \App\Utility\Helpers::getParamValue('id'),'task_status'=>$status[0]->status, 'task_date'=>$status[0]->due_date]) }}',
                                }
                            },
                            @endif
                            @if($status[0]->status == \App\Constants\TaskStatus::TODO)
                            {
                                title: 'TODO ({{ $status->count() }})',
                                start: '{{ $status[0]->due_date }}',
                                className: 'p-0 {{ \App\Constants\TaskStatus::getBgColor($status[0]->status) }}',
                                cursor: 'pointer',
                                groupId: 'todo',
                                extendedProps: {
                                    dataCallUrl: '{{ route('admin/project/task/calendar-view-filter', ['id' => \App\Utility\Helpers::getParamValue('id'),'task_status'=>$status[0]->status, 'task_date'=>$status[0]->due_date]) }}',
                                }
                            },
                            @endif
                            @if($status[0]->status == \App\Constants\TaskStatus::IN_PROGRESS)
                            {
                                title: 'TODO ({{ $status->count() }})',
                                start: '{{ $status[0]->due_date }}',
                                className: 'p-0 {{ \App\Constants\TaskStatus::getBgColor($status[0]->status) }}',
                                cursor: 'pointer',
                                groupId: 'todo',
                                extendedProps: {
                                    dataCallUrl: '{{ route('admin/project/task/calendar-view-filter', ['id' => \App\Utility\Helpers::getParamValue('id'),'task_status'=>$status[0]->status, 'task_date'=>$status[0]->due_date]) }}',
                                }
                            },
                            @endif
                        @endforeach

                    @endforeach
                ]
            });
            calendar.render();

            $('input[name="calendarFilterStatus"]').change(function(){
                var events = calendar.getEvents();
                events.forEach((e)=>{
                    if((this.checked) && (e.groupId === this.value)){
                        e.setProp('display', 'auto');
                    }
                    if((this.checked) && (this.value === 'all')){
                        $('input[name="calendarFilterStatus"]').attr('checked', true);
                        e.setProp('display', 'auto');
                    }

                    if((!this.checked) && (e.groupId === this.value)){
                        e.setProp('display', 'none');
                    }
                    if((!this.checked) && (this.value === 'all')){
                        $('input[name="calendarFilterStatus"]').removeAttr('checked');
                        e.setProp('display', 'none');
                    }
                });
            });

            var calendar2El = document.getElementById('calendar2');
            new FullCalendar.Calendar(calendar2El,{
                initialDate: new Date().toISOString().slice(0, 10),
                contentHeight: 'auto',
                height: '500',
                dateClick: function(info) {
                    var elements = document.querySelectorAll('.calendar-preview td.bg-primary');
                    elements.forEach(e => e.classList.remove('bg-primary'));
                    info.dayEl.classList.add("bg-primary");
                }
            }).render();
        });

    </script>
@endsection
