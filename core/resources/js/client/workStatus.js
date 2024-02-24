let project_id;
let taskId;

let WorkStatus = function (projectId) {
    // binding events as soon as the object is instantiated
    this.bindEvents();
    project_id = projectId;
};
WorkStatus.prototype = {

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
       WorkStatus.prototype.loadTasks();
    },
    loadTasks: (department_id = '') => {
        let url = $('#hdnLoadTasksUrl').val()+'?department_id='+department_id;
        common.ajaxCallGetRequest(url, ({content}) => {
            $('#tasks-placeholder').html(content);
        })
    },
    openTaskDetailModal: (task_id) => {
        taskId = task_id;
        let url = $('#hdnOpenTaskDetailModal').val().replace('--task_id--', task_id);
        common.ajaxCallGetRequest(url, ({content}) => {
            $('#taskModal').html(content);
            WorkStatus.prototype.loadComments();
            WorkStatus.prototype.loadSubmissionComments();
            $('#taskModal').modal('show');
        })
    },
    loadComments: () => {
        const url = $('#hdnLoadCommentsUrl').val().replace('--task_id--', taskId);
        common.ajaxCallGetRequest(url, ({data, total}) => {
            $('#display-comment-placeholder').html(data)
        });
    },

    storeCommentHandler: (type = 2) => {
        const url = $('#hdnStoreCommentUrl').val().replace('--task_id--', taskId);
        const messageSelector = type === 1 ? '#sub-message' : '#message';
        const attachmentSelector = type === 1 ? '#sub-attachments' : '#attachments';

        let formData = new FormData();
        // Append all selected files
        $.each($(attachmentSelector)[0].files, function(i, file) {
            formData.append('files[]', file);
        });

        formData.append('message', $(messageSelector).val());

        formData.append('type', type);

        common.ajaxCallPostRequestWithFile(url, formData, () => {
            if(type === 2){
                WorkStatus.prototype.loadComments();
            }else if(type === 1){
                WorkStatus.prototype.loadSubmissionComments();
            }
            $(messageSelector).val('')
        });
    },

    loadSubmissionComments: () => {
        const url = $('#hdnLoadSubmissionCommentsUrl').val().replace('--task_id--', taskId);
        common.ajaxCallGetRequest(url, ({data, total}) => {
            $('#submission-comment-placeholder').html(data)
        });
    },

    changeStatus: (status) => {
        const url = $('#hdnChangeAcceptanceStatusUrl').val().replace('--task_id--', taskId);
        common.ajaxCallPostRequest(url, {status: status},() => {
           $('#accepted-status-action').hide();
        });
    }
}
