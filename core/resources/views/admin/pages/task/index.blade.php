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
                    <form action="#" method="get" class="pb-2">
                        <div class="row g-1">
                            <div class="col-sm-2">
                                <input type="text" class="form-control form-control-sm" name="name" id="name" value="" placeholder="Task">
                            </div>
                            <div class="col-sm-2">
                                <select name="department_id" id="department_id" class="form-select form-select-sm">
                                    <option value="">-- Status --</option>
                                    <option value="1">TO DO</option>
                                    <option value="1">IN PROGRESS</option>
                                    <option value="1">IN REVIEW</option>
                                    <option value="1">SUBMITTED</option>
                                    <option value="1">ACCEPTED</option>
                                    <option value="1">ARCHIVED</option>
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
                            <div class="col-sm-2">
                                <select name="department_id" id="department_id" class="form-select form-select-sm">
                                    <option value="">-- More --</option>
                                    <option value="1">Revision</option>
                                    <option value="1">Over Due</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-primary btn-sm waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-sm fs-14 table-borderless table-hover">
                            <thead class="text-muted fs-12">
                            <tr class="table-light">
                                <th>TASK</th>
                                <th>DEPT & SERVICE</th>
                                <th>PROJECT</th>
                                <th class="text-center">STATUS</th>
                                <th>ASSIGNEE</th>
                                <th>HOUR</th>
                                <th>DUE DATE</th>
                                <th>PRIORITY</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="align-middle">

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#taskModal">Keyword Research</a>
                                </td>
                                <td>
                                    <p class="text-body mb-0">SEO</p>
                                    <p class="text-muted">Local SEO</p>
                                </td>
                                <td>WinHub</td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" class="btn btn-secondary btn-sm">
                                        TODO
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 1, 2, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-secondary"></i>
                                                TODO
                                                <i class="ri-check-line me-2 align-bottom text-success-emphasis ms-3"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 2, 2, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-primary"></i>
                                                IN REVIEW
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 3, 2, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-info"></i>
                                                IN PROGRESS
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 4, 2, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-success"></i>
                                                COMPLETE
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="avatar-group">
                                        <div class="member-place-holder_2">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Minhaz Hosen" data-bs-original-title="Minhaz Hosen">
                                                <img src="https://wbcrm.zillu.net/uploads/users/photo//wb_20231217_e04fd379-75f7-4d65-a79c-c8ddb7c90cab.png" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Rakib" data-bs-original-title="Rakib">
                                                <img src="https://wbcrm.zillu.net/uploads/users/photo//wb_20231219_ab7c1c9c-86e8-49d8-8ff8-154c3947b845.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                        <a href="javascript: void(0);" onclick="task.openAssignMemberModal(this, 2, '.member-place-holder_2')" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="New Assign" data-bs-original-title="New Assign">
                                            <div class="avatar-xxs">
                                                <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                    <i class="bx bx-plus"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td>510</td>
                                <td>25 Dec, 2023</td>
                                <td>
                                    <span class="badge bg-danger text-uppercase">High</span>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                        <i class="ri-more-fill fs-17"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openCreateModal(2)"><i class="ri-add-line text-muted me-2 align-bottom"></i>Add Subtask</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openConvertSubTaskModal(2)"><i class="ri-refresh-line text-muted me-2 align-bottom"></i>Convert to Subtask</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-file-copy-line text-muted me-2 align-bottom"></i>Duplicate</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openArchiveModal(2)"><i class="ri-inbox-archive-line text-muted me-2 align-bottom"></i>Archive</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-6-line text-danger me-2 align-bottom"></i>Delete</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#taskModal">BACKLINK</a>
                                </td>
                                <td>
                                    <p class="text-body mb-0">Digital Marketing</p>
                                    <p class="text-muted">Pay-Per-Click (PPC) Advertising</p>
                                </td>
                                <td>WinHub</td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" class="btn btn-secondary btn-sm">
                                        TODO
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 1, 4, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-secondary"></i>
                                                TODO
                                                <i class="ri-check-line me-2 align-bottom text-success-emphasis ms-3"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 2, 4, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-primary"></i>
                                                IN REVIEW
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 3, 4, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-info"></i>
                                                IN PROGRESS
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 4, 4, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-success"></i>
                                                COMPLETE
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="avatar-group">
                                        <div class="member-place-holder_4">
                                        </div>
                                        <a href="javascript: void(0);" onclick="task.openAssignMemberModal(this, 4, '.member-place-holder_4')" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="New Assign" data-bs-original-title="New Assign">
                                            <div class="avatar-xxs">
                                                <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                    <i class="bx bx-plus"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td>510</td>
                                <td>22 Dec, 2023</td>
                                <td>
                                    <span class="badge bg-danger text-uppercase">High</span>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                        <i class="ri-more-fill fs-17"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.convertTaskHandler(1, 4)"><i class="ri-refresh-line text-muted me-2 align-bottom"></i>Convert to Main Task</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-file-copy-line text-muted me-2 align-bottom"></i>Duplicate</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openArchiveModal(4)"><i class="ri-inbox-archive-line text-muted me-2 align-bottom"></i>Archive</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-6-line text-danger me-2 align-bottom"></i>Delete</a></li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td class="align-middle">

                                    <a href="#" data-bs-toggle="modal" data-bs-target="#taskModal">Backlink</a>
                                </td>
                                <td>
                                    <p class="text-body mb-0">SEO</p>
                                    <p class="text-muted">Local SEO</p>
                                </td>
                                <td>WinHub</td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true" class="btn btn-secondary btn-sm">
                                        TODO
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 1, 5, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-secondary"></i>
                                                TODO
                                                <i class="ri-check-line me-2 align-bottom text-success-emphasis ms-3"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 2, 5, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-primary"></i>
                                                IN REVIEW
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 3, 5, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-info"></i>
                                                IN PROGRESS
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 4, 5, )">
                                                <i class="ri-radio-button-line me-2 align-bottom text-success"></i>
                                                COMPLETE
                                            </a>
                                        </li>
                                    </ul>
                                </td>
                                <td>
                                    <div class="avatar-group">
                                        <div class="member-place-holder_5">
                                            <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Rakib" data-bs-original-title="Rakib">
                                                <img src="https://wbcrm.zillu.net/uploads/users/photo//wb_20231219_ab7c1c9c-86e8-49d8-8ff8-154c3947b845.jpg" alt="" class="rounded-circle avatar-xxs">
                                            </a>
                                        </div>
                                        <a href="javascript: void(0);" onclick="task.openAssignMemberModal(this, 5, '.member-place-holder_5')" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="New Assign" data-bs-original-title="New Assign">
                                            <div class="avatar-xxs">
                                                <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                    <i class="bx bx-plus"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </td>
                                <td>510</td>
                                <td>20 Dec, 2023</td>
                                <td>
                                    <span class="badge bg-warning text-uppercase">Medium</span>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                        <i class="ri-more-fill fs-17"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" style="">
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openCreateModal(5)"><i class="ri-add-line text-muted me-2 align-bottom"></i>Add Subtask</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openConvertSubTaskModal(5)"><i class="ri-refresh-line text-muted me-2 align-bottom"></i>Convert to Subtask</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-file-copy-line text-muted me-2 align-bottom"></i>Duplicate</a></li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openArchiveModal(5)"><i class="ri-inbox-archive-line text-muted me-2 align-bottom"></i>Archive</a></li>
                                        <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-6-line text-danger me-2 align-bottom"></i>Delete</a></li>
                                    </ul>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
