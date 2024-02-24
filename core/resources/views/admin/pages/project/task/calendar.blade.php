@extends('admin.layout')

@section('title')
    Tasks - Calendar View - Project Name
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="card border-0">
                <div class="card-body pb-0 px-4">
                    <x-pr-top-view/>
                    @include('admin.pages.project._details-menu')
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            @include('admin.shared.alert-template')
        </div>
    </div>

    @include('admin.pages.project.task.inc._top-menu')

    <div class="row">
        <div class="col-lg-12">
            <div class="collapse" id="collapseSearch">
                <form action="#" method="get" class="mt-2">
                    <div class="row g-1">
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-sm" name="name" id="name" value=""
                                   placeholder="Task">
                        </div>
                        <div class="col-sm-2">
                            <select name="department_id" id="department_id" class="form-select form-select-sm">
                                <option value="">-- Status --</option>
                                <option value="1">TO DO</option>
                                <option value="1">IN PROGRESS</option>
                                <option value="1">IN REVIEW</option>
                                <option value="1">COMPLETE</option>
                                <option value="1">COMPLETE</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="department_id" id="department_id" class="form-select form-select-sm">
                                <option value="">-- Priority --</option>
                                <option value="1">LOW</option>
                                <option value="1">MEDIUM</option>
                                <option value="1">HIGH</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <select name="department_id" id="department_id" class="form-select form-select-sm">
                                <option value="">-- Assignee --</option>
                                <option value="1">A</option>
                                <option value="1">B</option>
                                <option value="1">C</option>
                            </select>
                        </div>
                        <div class="col-sm-1">
                            <select name="department_id" id="department_id" class="form-select form-select-sm">
                                <option value="">-- More --</option>
                                <option value="1">Revision</option>
                                <option value="1">Late</option>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-light btn-sm waves-effect waves-light">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

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
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck6" checked>
                                        <label class="form-check-label" for="formCheck6">
                                            All
                                        </label>
                                    </div>
                                    <div class="form-check form-check-danger mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck10" checked>
                                        <label class="form-check-label" for="formCheck10">
                                            TO DO
                                        </label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck6" checked>
                                        <label class="form-check-label" for="formCheck6">
                                            IN PROGRESS
                                        </label>
                                    </div>
                                    <div class="form-check form-check-warning mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck9" checked>
                                        <label class="form-check-label" for="formCheck9">
                                            COMPLETED
                                        </label>
                                    </div>
                                    <div class="form-check form-check-success mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck8" checked>
                                        <label class="form-check-label" for="formCheck8">
                                            IN REVIEW
                                        </label>
                                    </div>
                                    <div class="form-check form-check-info mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck11" checked>
                                        <label class="form-check-label" for="formCheck11">
                                            SUBMITED
                                        </label>
                                    </div>
                                    <div class="form-check form-check-info mb-3">
                                        <input class="form-check-input" type="checkbox" id="formCheck11" checked>
                                        <label class="form-check-label" for="formCheck11">
                                            ACCEPTED
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
    @include('admin.pages.project.task.modals._completed-task')
    @include('admin.pages.project.task.modals._due-task')
    @include('admin.pages.project.task.modals._to-do-task')
@endsection

@section('script')
    <script src='{{ asset('core/resources/js/fullcalendar/dist/index.global.min.js') }}'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek'
                },
                initialDate: '2023-12-12',
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                select: function (arg) {
                    var title = prompt('Event Title:');
                    if (title) {
                        calendar.addEvent({
                            title: title,
                            start: arg.start,
                            end: arg.end,
                            allDay: arg.allDay
                        })
                    }
                    calendar.unselect()
                },
                eventClick: function (arg) {
                    console.log(arg.event);
                    common.toggleModal(arg.event.extendedProps.modal, 'show');
                },
                dayMaxEvents: true, // allow "more" link when too many events
                events: [
                    {
                        title: 'Completed (8)',
                        start: '2023-12-07',
                        className: 'p-0 bg-success',
                        cursor: 'pointer',
                        extendedProps: {
                            modal: 'completed-modal'
                        }
                    },
                    {
                        title: 'Due (11)',
                        start: '2023-12-07',
                        className: 'p-0',
                        extendedProps: {
                            modal: 'due-modal'
                        }
                    },
                    {
                        title: 'To Do (5)',
                        start: '2023-12-07',
                        className: 'p-0',
                        extendedProps: {
                            modal: 'to-do-modal'
                        }
                    },
                    {
                        title: 'Completed (9)',
                        start: '2023-12-13',
                        className: 'p-0',
                        extendedProps: {
                            modal: 'completed-modal'
                        }
                    },
                    {
                        title: 'Due (3)',
                        start: '2023-12-13',
                        className: 'p-0',
                        extendedProps: {
                            modal: 'due-modal'
                        }
                    },
                    {
                        title: 'To Do (17)',
                        start: '2023-12-13',
                        className: 'p-0',
                        extendedProps: {
                            modal: 'to-do-modal'
                        }
                    },
                    {
                        title: 'Personal',
                        start: '2023-12-17',
                        className: 'p-0 bg-danger',
                        extendedProps: {
                            modal: 'completed-modal'
                        }
                    }
                ]
            }).render();

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
