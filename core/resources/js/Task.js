let projectId;
let taskId;
let localbaseUrl;
let taskCreateFrom = '';

const statuses = {
    1: "TODO",
    2: "IN PROGRESS",
    3: "COMPLETED"
}

const statusBtnColors = {
    1: "btn-secondary",
    2: "btn-primary",
    3: "btn-success"
}

//Timer related
let startTime = null; // Set the specific start time new Date('2023-12-03 15:00:00')
let counterElement; // Get the element to display the time
let timerInterval = null; // Variable to store the timer interval
let elapsedTime = 0;



const commonModalSelector = '#commonModal';
let assigneePlaceholderSelector;

let Task = function (project_id) {
    projectId = project_id;
    localbaseUrl = $('#hdnBaseUrl').val();
    this.bindEvents();
};


Task.prototype = {
    bindEvents: function () {
        //CSRF token set for Ajax call on post-method
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        this.init();
    },

    init: function () {

    },

    /**
     * Open Task create modal
     *
     * @param mainTaskId If task is sub that time pass the main task id otherwise 0
     * @param call_from This is flag for subtask create from details modal
     */
    openCreateModal: function (mainTaskId = 0, call_from = '') {
        common.showLoader();
        common.ajaxCallGetRequest($('#hdnCreateModalOpenUrl').val(), ({data}) => {
            $(commonModalSelector).html(data).modal('show');
            $('#main_task_id').val(mainTaskId);
            taskCreateFrom = call_from;
        });
    },

    editTaskModal: function (taskId) {
        const url = $('#hdnEditTaskModal').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data}) => {
            $(commonModalSelector).html(data).modal('show');
        });
    },

    /**
     * Open Task create modal
     *
     * @param url
     */
    openCreateModalByURL: function (url) {
        common.showLoader();
        common.ajaxCallGetRequest(url, ({data}) => {
            $(commonModalSelector).html(data).modal('show');
        });
    },

    /**
     * Get services by the department
     *
     * @param selectedDdl department dropdown selector which is changed
     * @param bindValueSelector Service dropdown selector where bind service
     */
    getServiceByDepartment: (selectedDdl, bindValueSelector) => {
        const department_id = $(selectedDdl).val();
        $(bindValueSelector).empty();
        $(bindValueSelector).append('<option value="">Loading...</option>');

        if(!Task.prototype.isNullOrWhitespace(department_id)){
            const url = `${localbaseUrl}admin/project/${projectId}/service/${department_id}/get-by-department`;
            common.ajaxCallGetRequest(url, ({data}) => {
                $(bindValueSelector).empty();
                Task.prototype.bindDropdown(data, bindValueSelector);
            })
        }
    },

    /**
     * Submit create form
     *
     * @param e JS Event
     * @param form Submittable form
     */
    storeSubmitHandler: (e, form) => {
        e.preventDefault();
        common.ajaxCallPostRequest($(form).attr('action'), $(form).serialize(), ({data}) => {
            $(commonModalSelector).modal('hide');
            Task.prototype.openTaskDetailsModal(data);
        });
    },

    /**
     * Open Assign team member modal
     *
     * @param btnAdd which button called this function
     * @param task_id Task ID
     * @param placeholderSelector This selector bind the newly assigned member
     */
    openAssignMemberEditModal: function (btnAdd, task_id, task_assign_to_id, placeholderSelector) {
        common.showLoader();
        taskId = task_id;
        taskAssignToId = task_assign_to_id;
        assigneePlaceholderSelector = placeholderSelector;

        Task.prototype.openModal($('#hdnAssignMemberEditModalOpenUrl').val().replace('task_id', task_id).replace('assign_to_id', task_assign_to_id));
    },
    removeAssignMemberItems: (assign_to_id) => {
        common.confirmAlertCallback(() => {
            const payload = {
                'assign_to_id': assign_to_id
            };
            const url = $('#hdnRemoveMemberUrl').val().replace('task_id', taskId).replace('assign_to_id', assign_to_id);

            common.ajaxCallPostRequest(url, payload, () => {
                Task.prototype.loadActionItems();
                Task.prototype.loadActivities();
                Task.prototype.pageReload();
            });
        })
    },

    /**
     * Open Assign team member modal
     *
     * @param btnAdd which button called this function
     * @param task_id Task ID
     * @param placeholderSelector This selector bind the newly assigned member
     */
    openAssignMemberModal: function (btnAdd, task_id, placeholderSelector) {
        common.showLoader();
        taskId = task_id;
        assigneePlaceholderSelector = placeholderSelector;

        Task.prototype.openModal($('#hdnAssignMemberModalOpenUrl').val().replace('task_id', task_id))
    },
    /**
     * Submit assign member form
     *
     * @param e Event
     * @param form current form
     */
    storeMemberAssignHandler: (e, form) => {
        e.preventDefault();

        common.ajaxCallPostRequest($(form).attr('action'), $(form).serialize(), ({data}) => {
            Task.prototype.pageReload();
            $(assigneePlaceholderSelector).append(Task.prototype.generateAssignMember(data));
            $(commonModalSelector).modal('hide');
        });
    },

    /**
     * Change task status
     *
     * @param currentStatus
     * @param status update status
     * @param task_id Task Id who is update status
     * @param is_details Is that method call from details page or not
     */
    changeTaskStatusHandler: (currentStatus, status, task_id = taskId, is_details = 0) => {
        const url = $('#hdnChangeTaskStatusUrl').val().replace('task_id', task_id);
        const payload = {
            'status': status
        };

        common.ajaxCallPostRequest(url, payload, (res) => {
            if(is_details === 0){
                Task.prototype.pageReload();
            }else{
                const btn = '#status-btn';
                $(btn).text(statuses[status]);
                const element = document.getElementById('status-btn');
                element.className = '';
                $(btn).addClass(`btn btn-sm ${statusBtnColors[status]}`);
                $(currentStatus).parent().parent().html(res.data);
                Task.prototype.loadActivities();
                if(status === 3)
                {
                    $('#tab-review').show();
                }
                else
                {
                    $('#tab-review').hide();
                }
            }

        });
    },

    /**
     * Open modal for archive task confirmation
     *
     * @param task_id
     */
    openArchiveModal: (task_id) => {
        common.showLoader();
        taskId = task_id;
        const url = $('#hdnOpenTaskArchiveModalUrl').val().replace('task_id', task_id);
        Task.prototype.openModal(url)
    },

    /**
     * Task archived handler
     *
     * @param task_id
     */
    taskArchiveHandler: (task_id = taskId) => {

        const url = $('#hdnTaskArchiveUrl').val().replace('task_id', task_id);
        const payload = {
            'note': $('#archive_note').val()
        };

        common.ajaxCallPostRequest(url, payload, (res) => {
            // common.showToast("Task has been converted!");
            Task.prototype.pageReload();
        });
    },

    /**
     * Open modal for convert sub task
     *
     * @param task_id
     */
    openConvertSubTaskModal: (task_id) => {
        common.showLoader();
        taskId = task_id;
        const url = $('#hdnTaskConvertModalOpenUrl').val().replace('task_id', task_id);
        Task.prototype.openModal(url)
    },

    /**
     * Task convert handler
     *
     * @param taskType
     * @param task_id
     */
    convertTaskHandler: (taskType, task_id = taskId) => {
        const main_task_id = taskType === 0 ? 0: $('#main_task_id').val();

        const url = $('#hdnConvertTaskUrl').val().replace('task_id', task_id);
        const payload = {
            'task_type': taskType,
            'main_task_id': main_task_id
        };

        common.ajaxCallPostRequest(url, payload, (res) => {
            if(taskType !== 0)
                $(commonModalSelector).modal('hide');

            // common.showToast("Task has been converted!");
            Task.prototype.pageReload();
        });
    },

    openTaskDetailsModal: (task_id) => {
        taskId = task_id;
        const url = $('#hdnOpenTaskDetailsModalUrl').val().replace('task_id', task_id);
        common.ajaxCallGetRequest(url, ({data}) => {
            $('#taskModal').html(data.model_view).modal('show');
            counterElement = document.getElementById('timer');
            if(data.tracker_start)
            {
                startTime = new Date(data.tracker_start);
                Task.prototype.startTimer();
            }

            //load activities
            Task.prototype.loadActivities();

             //load attachments
            Task.prototype.loadAttachments();

            //Load Comments
            Task.prototype.loadComments();
            if(data.type === 1){
                Task.prototype.loadSubtask()
            }
            Task.prototype.loadActionItems();
        });
    },

    openReviewModal: () => {
        const url = $('#hdnOpenTaskReviewModalUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data}) => {
            $('#taskModal').html(data).modal('show');
            Task.prototype.loadReviewComments();
        });
    },

    openSubmissionModal: () => {
        const url = $('#hdnOpenTaskSubmissionModalUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data}) => {
            $('#taskModal').html(data).modal('show');
            Task.prototype.loadSubmissionComments();
        });
    },

    loadSubmissionComments: () => {
        const url = $('#hdnLoadSubmissionCommentsUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data, total}) => {
            $('#submission-comment-placeholder').html(data)
        });
    },

    loadReviewComments: () => {
        const url = $('#hdnLoadReviewCommentsUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data, total}) => {
            $('#display-review-placeholder').html(data)
        });
    },

    loadSubtask: () => {
        const url = $('#hdnLoadSubtaskUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data}) => {
            $('#sub-task-placeholder').html(data.sub_tasks)
        });
    },
    loadActivities: () => {
        const url = $('#hdnLoadActivitiesUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data}) => {
            $('#task-activities-placeholder').html(data)
        });
    },

    taskNameInputHandler: (input) => {
        $('#dt_task_name').text($(input).val());
    },

    taskNameBlurHandle: (input) => {
        const url = $('#hdnChangeTaskNameUrl').val().replace('task_id', taskId);
        common.ajaxCallPostRequest(url, {'task_name': $(input).val()}, () => {
            Task.prototype.loadActivities();
        })
    },
    approved: (approveBtn) => {
        const url = $('#hdnTaskApproveUrl').val().replace('task_id', taskId);
        common.ajaxCallPostRequest(url, {}, () => {
            $(approveBtn).hide();
            Task.prototype.openReviewModal();
        })
    },
    changeAcceptanceStatus: (btn, status) => {
        const url = $('#hdnChangeAcceptanceStatusUrl').val().replace('task_id', taskId);
        common.ajaxCallPostRequest(url, {status: status},() => {
           $(btn).hide();
           Task.prototype.openSubmissionModal();
        });
    },
    openWorkingHourModal: (task_id = taskId) => {
        $taskId = task_id;
        const url = $('#hdnTaskWorkingHourModalUrl').val().replace('task_id', task_id);
        Task.prototype.openModal(url)
    },
    editTimeTracker: (tracker_id) => {
        const url = $('#hdnTaskTimeTrackerEditUrl').val().replace('task_id', taskId)+"?tracker_id="+tracker_id;
        common.ajaxCallGetRequest(url, ({data}) => {
            $('#edit-form-placeholder').html(data);
            $('#list-hours').hide();
            $('#btn-back').show();
        });
    },

    closeTrackerEditForm: () => {
        $('#btn-back').hide();
        $('#list-hours').show();
        $('#edit-form-placeholder').html('');
    },
    submitTrackerUpdateForm: (e, form) => {
        e.preventDefault();
        common.ajaxCallPostRequest($(form).attr('action'), $(form).serialize(), ({data}) => {
            Task.prototype.openWorkingHourModal();
        });
    },
    closeWorkingHourModal: () => {
        $(commonModalSelector).html('').modal('hide');
        Task.prototype.openTaskDetailsModal(taskId);
    },
    removeTimeTracker: (tracker_id) => {
        common.confirmAlertCallback(() => {
            const payload = {
                'tracker_id': tracker_id,
            };
            const url = $('#hdnTaskTimeTrackerRemoveUrl').val().replace('task_id', taskId);

            common.ajaxCallPostRequest(url, payload, () => {
                Task.prototype.openWorkingHourModal();
            });
        })
    },
    startTimerHandler: () => {
        const url = $('#hdnStartTimerUrl').val().replace('task_id', taskId);
        common.ajaxCallPostRequest(url, {}, (res) => {
            startTime = new Date(res.data);
            Task.prototype.startTimer();
            Task.prototype.loadActivities();
        });
    },
    stopTimerConfirmHandler: () => {
        $('#modal-stop-timer-note').modal('show');
    },
    stopTimerHandler: () => {
        const url = $('#hdnStopTimerUrl').val().replace('task_id', taskId);
        const note = $('#tracker_note').val();
        if(note === '')
        {
            common.showAlert('Note field is required', 'error');
            return;
        }
        common.ajaxCallPostRequest(url, {
            note: note
        }, (res) => {
            startTime = null;
            clearInterval(timerInterval)
            counterElement.textContent = '00:00:00';
            $('#counter-section').html(`
                 <button class="btn btn-sm btn-light" onclick="task.startTimerHandler()" data-bs-toggle="tooltip" data-bs-placement="top" title="Start Timer">
                    <i class="ri-play-fill text-success"></i>
                 </button>
            `);

            Task.prototype.loadActivities();
        });
    },

    saveHourTimeTrackerHandler: () => {
        const hour = $('#hour').val();
        if(common.isNullOrWhitespace(hour)){
            alert('Hour is required!');
            return;
        }
        const url = $('#hdnAddTrackingHourUrl').val().replace('task_id', taskId);
        common.ajaxCallPostRequest(url, {hour: hour}, (res) => {
            $('#hour').val('');
            Task.prototype.loadActivities();
        });
    },

    saveManualTrackingHandler: () => {
        const fromTime = $('#fromTime').val();
        const endTime = $('#endTime').val();

        if(common.isNullOrWhitespace(fromTime)){
            alert('From time is required!');
            return;
        }

        if(common.isNullOrWhitespace(endTime)){
            alert('End time is required!');
            return;
        }

        const url = $('#hdnsaveManualTrackingUrl').val().replace('task_id', taskId);
        const payload = {
            fromTime: fromTime,
            endTime: endTime
        }
        common.ajaxCallPostRequest(url, payload, (res) => {
            $('#fromTime').val('');
            $('#endTime').val('');
            Task.prototype.loadActivities();
        });
    },
    descriptionSaveHandler: (isSaveClose = 0) => {
        const url = $('#hdnDescriptionSaveUrl').val().replace('task_id', taskId);
        const payload = {
            'task_description' : $('#task_description').val()
        }
        common.ajaxCallPostRequest(url, payload, (res) => {
            if(isSaveClose === 1){
                Task.prototype.pageReload();
            }else{
                Task.prototype.loadActivities();
            }
        });
    },

    addDetailsFormToggle: (flag = 0) => {
        const detailFormSection = '#add-detail-section';
        if(flag === 1){
            $(detailFormSection).show();
        }else{
            $('#field_name').val('');
            $('#field_value').val('');
            $(detailFormSection).hide();
        }
    },
    saveTaskDetailHandler: (e, form) => {
        e.preventDefault();
        common.ajaxCallPostRequest($(form).attr('action'), $(form).serialize(), ({data}) => {
            Task.prototype.addDetailsFormToggle(0);
            Task.prototype.loadActivities();
          $('#details-placeholder').append(`
            <tr>
                <th style="width: 200px;">${data.field_name}</th>
                <td>${data.field_value}</td>
                <td class="text-center">
                    <button class="btn btn-sm btn-light" data-bs-toggle="tooltip" data-bs-placement="top" type="button" title="Remove" onclick="task.removeTaskDetailHandler(${data.id}, this)">
                        <i class="mdi mdi-trash-can-outline text-danger"></i>
                    </button>
                </td>
            </tr>
          `)
        });
    },

    removeTaskDetailHandler: (detail_id, current) => {
        common.confirmAlertCallback(() => {
            const url = $('#hdnDeleteTaskDetailUrl').val().replace('task_id', taskId);
            common.ajaxCallPostRequest(url, {'id': detail_id}, ({data}) => {
                $(current).parent().parent().remove();
                Task.prototype.loadActivities();
            });
        })
    },

    loadAttachments: () => {
        const url = $('#hdnLoadAttachmentsUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data, total}) => {
            $('#attachments-placeholder').html(data)
            $('#task-count').text(total);
        });
    },

    addAttachmentFormToggle: (flag = 0) => {
        const addAttachmentForm = '#attachment-section';
        if(flag === 1){
            $(addAttachmentForm).show();
        }else{
            $('#attachments').val('');
            $(addAttachmentForm).hide();
        }
    },

    attachmentFormSubmitHandler: (action) => {
        const url = $('#hdnStoreAttachmentUrl').val().replace('task_id', taskId);
        var formData = new FormData();

        // Append all selected files
        $.each($('#attachments')[0].files, function(i, file) {
            formData.append('files[]', file);
        });

        common.ajaxCallPostRequestWithFile(url, formData, () => {
            Task.prototype.addAttachmentFormToggle(0);
            Task.prototype.loadAttachments();
            Task.prototype.loadActivities();
        });
    },

    deleteAttachmentHandler: (attachment_id, url, current) => {
        common.confirmAlertCallback(() => {
            common.ajaxCallPostRequest(url.replace('task_id', taskId), {'id': attachment_id}, ({data}) => {
                $(current).parent().parent().parent().parent().remove();
                Task.prototype.loadActivities();
            });
        })
    },

    loadComments: () => {
        const url = $('#hdnLoadCommentsUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data, total}) => {
            $('#display-comment-placeholder').html(data)
        });
    },

    storeCommentHandler: (type = 2) => {
        const url = $('#hdnStoreCommentUrl').val().replace('task_id', taskId);
        let formData = new FormData();
        // Append all selected files
        $.each($('#attachments')[0].files, function(i, file) {
            formData.append('files[]', file);
        });

        formData.append('message', $('#message').val());
        formData.append('type', type);

        common.ajaxCallPostRequestWithFile(url, formData, () => {
            if(type === 2){
                Task.prototype.loadComments();
                $('#message').val('');
                Task.prototype.loadActivities();
            }else if(type === 3){
                Task.prototype.openReviewModal();
            }else if(type === 1){
                Task.prototype.loadSubmissionComments();
            }
            $('#message').val('')
        });
    },

    detailFieldNameBlurHandler: (input) => {
        const url = $('#hdnChangeCustomFieldLabelUrl').val().replace('task_id', taskId);
        common.ajaxCallPostRequest(url, {'label_name': $(input).val()}, () => {
            Task.prototype.loadActivities();
        });
    },

    loadActionItems: () => {
        const url = $('#hdnLoadActionItems').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data, total}) => {
            $('#total_action_items').text(total)
            $('#wb-task-action-items').html(data)
        });
    },
    createActionItems: () => {
        const url = $('#hdnAddActionItemsUrl').val().replace('task_id', taskId);
        common.ajaxCallGetRequest(url, ({data}) => {
            $('#wb-task-action-items').html(data)
        });
    },

    addMoreActionItems: () => {
        $('#action_items_placeholder').append(`
        <tr>
            <td>
                <input type="text" name="action_items[]" class="form-control form-control-sm" required>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger float-end" title="add more" onclick="task.removeMoreActionItems(this)"><i class="bx bx-trash"></i></button>
            </td>
        </tr>
        `)
    },

    removeMoreActionItems: (clickedBtn) => {
        $(clickedBtn).parent().parent().remove();
    },

    storeActionItems: (e, form) => {
        e.preventDefault();
        common.ajaxCallPostRequest($(form).attr('action'), $(form).serialize(), () => {
            Task.prototype.loadActionItems();
            Task.prototype.loadActivities();
        });
    },
    changeActionName: (input, action_id) => {
        const payload = {
            'action_name': $(input).val(),
            'action_id': action_id
        };
        const url = $('#hdnTaskActionRenameUrl').val().replace('task_id', taskId);
        common.ajaxCallPostRequest(url, payload, () => {
            Task.prototype.loadActivities();
        });
    },

    insertActionItemForm: (action_id) => {
        $(`#insert_form_${action_id}`).removeClass('d-none').addClass('d-flex');
        $(`#insert_btn_section_${action_id}`).hide();
    },

    hideActionItemInsertForm: (action_id) => {
        $(`#insert_form_${action_id}`).removeClass('d-flex').addClass('d-none');
        $(`#insert_btn_section_${action_id}`).show();
    },
    insertActionItemHandler: (action_id) => {
        const item_name = $('#item_name_'+action_id).val();
        if(common.isNullOrWhitespace(item_name)){
            alert('Item name is required!');
            return;
        }

        const payload = {
            'item_name': item_name,
            'action_id': action_id
        };
        const url = $('#hdnInsertActionItemUrl').val().replace('task_id', taskId);

        common.ajaxCallPostRequest(url, payload, () => {
            Task.prototype.loadActionItems();
            Task.prototype.loadActivities();
        });
    },
    changeCheckStatusHandler: (chkBox, action_id, item_id) => {
        const payload = {
            'item_id': item_id,
            'action_id': action_id,
            'is_checked': $(chkBox).is(":checked") ? 1 : 0
        };
        const url = $('#hdnChangeCheckStatusActionItemUrl').val().replace('task_id', taskId);

        common.ajaxCallPostRequest(url, payload, () => {
            Task.prototype.loadActionItems();
            Task.prototype.loadActivities();
        });
    },

    removeActionItems: (action_id, item_id) => {
        common.confirmAlertCallback(() => {
            const payload = {
                'item_id': item_id,
                'action_id': action_id,
            };
            const url = $('#hdnRemoveActionItemUrl').val().replace('task_id', taskId);

            common.ajaxCallPostRequest(url, payload, () => {
                Task.prototype.loadActionItems();
                Task.prototype.loadActivities();
            });
        })
    },
    deleteActionHandler: (action_id) => {
        common.confirmAlertCallback(() => {
            const payload = {
                'action_id': action_id,
            };
            const url = $('#hdnRemoveActionUrl').val().replace('task_id', taskId);

            common.ajaxCallPostRequest(url, payload, () => {
                Task.prototype.loadActionItems();
                Task.prototype.loadActivities();
            });
        })
    },

    editActionItem: (clickedBtn, action_id, item_id, item_name) => {
        $(clickedBtn).parent().parent().html(Task.prototype.getActionItemEditForm(action_id, item_id, item_name));
    },

    updateActionItemHandler: (action_id, item_id) => {
        const item_name = $('#item_name_'+item_id).val();
        if(common.isNullOrWhitespace(item_name)){
            alert('Item name is required!');
            return;
        }

        const payload = {
            'item_name': item_name,
            'action_id': action_id,
            'item_id': item_id
        };
        const url = $('#hdnUpdateActionItemUrl').val().replace('task_id', taskId);

        common.ajaxCallPostRequest(url, payload, () => {
            Task.prototype.loadActionItems();
            Task.prototype.loadActivities();
        });
    },


    ///Helper functions
    /**
     *
     *
     * @param url
     */
    openModal: (url) => {
        common.ajaxCallGetRequest(url, (response) => {
            $(commonModalSelector).html(response.data).modal('show');
        })
    },
    generateAssignMember : ({name, photo}) => {
        return `
          <a href="javascript: void(0);" class="avatar-group-item" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="${name}" data-bs-original-title="${name}">
               <img src="${photo}" alt="${name}" class="rounded-circle avatar-xxs">
           </a>
        `;
    },

    getActionItemEditForm : (action_id, item_id, item_name) => {
        return `
        <div class="d-flex flex-grow-1 align-items-center">
            <div class="form-group">
                <input type="text" class="form-control form-control-sm" value="${item_name}" id="item_name_${item_id}">
            </div>
            </div>
            <div class="d-flex justify-content-end flex-grow-0">
                <a href="javascript:void(0);" class="btn btn-sm bg-transparent text-primary fs-16 py-0" onclick="task.updateActionItemHandler(${action_id}, ${item_id})"><i class="bx bx-save"></i></a>
                <a href="javascript:void(0);" class="btn btn-sm bg-transparent text-danger fs-16 py-0" onclick="task.loadActionItems()"><i class="bx bx-trash"></i></a>
            </div>
        `
    },
    /**
     * Bind dropdown options
     *
     * @param rows dropdown values as json
     * @param selector The dropdown where bind options
     * @param valueProp Which property is value for dropdown
     * @param textProp Which property is display text for dropdown
     */
    bindDropdown: (rows, selector, valueProp = 'id', textProp = 'name') => {
        if(rows.length > 0){
            $(selector).append('<option value="">--Select--</option>');
            rows.forEach((row, i) => {
                $(selector).append(`<option value="${row[valueProp]}">${row[textProp]}</option>`);
            });
        }else{
            $(selector).append('<option value="">Not Available</option>');
        }
    },

    /**
     * Check the value is null or whitespace
     *
     * @param value value for check
     * @returns {boolean} if value is null or whitespace then return true otherwise return false
     */
    isNullOrWhitespace: (value) => {
        return value === null || value.trim() === '';
    },

    /**
     * Reload current page
     *
     */
    pageReload: () => {
        window.location.reload();
    },

    startTimer: () => {
        if (startTime) {
            $('#counter-section').html(`
                 <button class="btn btn-sm btn-light" onclick="task.stopTimerConfirmHandler()" data-bs-toggle="tooltip" data-bs-placement="top" title="Stop Timer">
                    <i class="ri-pause-fill text-danger"></i>
                 </button>
            `)

            timerInterval = setInterval(() => {
                Task.prototype.updateTimer();
            }, 10);

        }
    },
    updateTimer: () => {
        const currentTime = new Date();
        const elapsedMilliseconds = currentTime.getTime() - startTime.getTime();
        const seconds = elapsedMilliseconds / 1000;
        const minutes = Math.floor(seconds / 60);
        const hours = Math.floor(minutes / 60);
        counterElement.textContent = `${hours}:${Math.floor(minutes % 60)}:${Math.floor(seconds % 60)}`;

    }

};




