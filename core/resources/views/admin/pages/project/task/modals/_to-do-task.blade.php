<div class="modal" id="to-do-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createNewGroupModal" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header pb-3 bg-light">
                <h2 class="accordion-header" id="panelsStayOpen-headingTaskInReview">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTaskInReview_1" aria-expanded="true" aria-controls="panelsStayOpen-collapseTaskInReview">
                        <span class="badge bg-secondary"><i class="ri-radio-button-line"></i> TODO</span> <span class="badge rounded-pill bg-dark-subtle text-body">1</span>
                    </button>
                </h2>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="panelsStayOpen-collapseTaskInReview_1" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTaskInReview" style="">
                    <div class="accordion-body">
                        <div class="table-responsive bg-white">
                            <table class="table table-sm fs-14">
                                <thead class="text-muted fs-12">
                                <tr>
                                    <th style="width:30px;"></th>
                                    <th>TASK</th>
                                    <th>ASSIGNEE</th>
                                    <th>DUE DATE</th>
                                    <th>PRIORITY</th>
                                    <th class="text-center"><i class="ri-more-fill fs-17"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                    </td>
                                    <td class="align-middle">
                    <span style="width: 40px;" class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Add Subtask" data-bs-placement="top">
              <button class="btn btn-sm btn-ghost-dark waves-effect waves-light me-2" type="button" onclick="task.openCreateModal(1)"><i class="ri-add-line"></i></button>
            </span>

                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="ri-radio-button-line me-2 align-middle text-secondary"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-start" style="position: absolute; inset: auto 0px 0px auto; margin: 0px; transform: translate(-77px, -155px);" data-popper-placement="top-end" data-popper-reference-hidden="">
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 1, 1, )">
                                                    <i class="ri-radio-button-line me-2 align-bottom text-secondary"></i>
                                                    TODO
                                                    <i class="ri-check-line me-2 align-bottom text-success-emphasis ms-3"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 2, 1, )">
                                                    <i class="ri-radio-button-line me-2 align-bottom text-primary"></i>
                                                    IN REVIEW
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 3, 1, )">
                                                    <i class="ri-radio-button-line me-2 align-bottom text-info"></i>
                                                    IN PROGRESS
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0);" onclick="task.changeTaskStatusHandler(this, 4, 1, )">
                                                    <i class="ri-radio-button-line me-2 align-bottom text-success"></i>
                                                    COMPLETE
                                                </a>
                                            </li>
                                        </ul>
                                        <a href="javascript:void(0);" class="me-2" onclick="task.openTaskDetailsModal(1)">Task#1</a>
                                        <a href="javascript:void(0);" onclick="task.openTaskDetailsModal(1)">abc</a>
                                    </td>

                                    <td>
                                        <div class="avatar-group">
                                            <div class="member-place-holder_1">

                                                <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Colette Pollard" data-bs-original-title="Colette Pollard">
                                                    <img src="http://localhost/wbcrm/uploads/users/profile/wb_20231128_58cd4d3c-7108-4647-92dd-7741a9a34674.jpg" alt="Colette Pollard" class="rounded-circle avatar-xxs">
                                                </a>
                                            </div>
                                            <a href="javascript: void(0);" onclick="task.openAssignMemberModal(this, 1, '.member-place-holder_1')" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="New Assign" data-bs-original-title="New Assign">
                                                <div class="avatar-xxs">
                                                    <div class="avatar-title fs-16 rounded-circle bg-light border-dashed border text-primary">
                                                        <i class="bx bx-plus"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td>13 Dec, 2023</td>
                                    <td>
                                        <span class="badge bg-danger text-uppercase">High</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false" class="">
                                            <i class="ri-more-fill fs-17"></i>
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-end" style="">
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openCreateModal(1)"><i class="ri-add-line text-muted me-2 align-bottom"></i>Add Subtask</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openConvertSubTaskModal(1)"><i class="ri-refresh-line text-muted me-2 align-bottom"></i>Convert to Subtask</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-file-copy-line text-muted me-2 align-bottom"></i>Duplicate</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);" onclick="task.openArchiveModal(1)"><i class="ri-inbox-archive-line text-muted me-2 align-bottom"></i>Archive</a></li>
                                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="ri-delete-bin-6-line text-danger me-2 align-bottom"></i>Delete</a></li>
                                        </ul>
                                    </td>
                                </tr>
                                </tbody><tbody class="accordion-collapse collapse" id="panels_sub_task_1">
                                </tbody>

                            </table>

                            <a class="btn btn-ghost-dark waves-effect waves-light btn-sm" href="javascript:void(0);" onclick="task.openCreateModal()">
                                <i class="ri-add-line mt-1"></i> Add Task
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
