@extends('admin.layout')

@section('title') All Tasks @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Tasks</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs nav-tabs-custom custom-sub-nav">
                <li>
                    <a class="nav-link fw-semibold" href="{{ route('admin/tasks') }}">
                        <i class="ri-list-unordered mt-1 position-relative" style="top: 2px;"></i> Table
                    </a>
                </li>
                <li>
                    <a class="nav-link fw-semibold" href="{{ route('admin/tasks/calendar') }}">
                        <i class="ri-calendar-line mt-1 position-relative" style="top: 2px;"></i> Calendar
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @include('super-admin.shared._message')
                    <form action="#" method="get" class="pb-2 mb-1">
                        <div class="row g-1">
                            <div class="col-md-3">
                                <select name="department_id" id="department_id" class="form-control form-control-sm">
                                    <option value="">-- Project --</option>
                                    <option value="1">WinHub</option>
                                </select>
                            </div>
                        </div>
                    </form>

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
            </div>
        </div>
    </div>
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
