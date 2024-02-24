let token = '';
let currentUrl = '';
let assetsPath = '';


var Common = function () {
    // binding events as soon as the object is instantiated
    this.bindEvents();
};


Common.prototype = {

    bindEvents: function () {
        this.init();
    },

    init: function () {
        currentUrl = new URL(window.location);
        $('a[href="'+currentUrl+'"]').addClass('active');
        //$('a[href="'+currentUrl+'"]').parent().parent().addClass('show');
        $('a[href="'+currentUrl+'"]').parent().parent().parent().addClass('show');

        $('.select2').select2();
        token = $('meta[name=csrf-token]').attr("content");
        assetsPath = $('meta[name=assets-path]').attr("content");


        //
        $('.confirm-alert').confirm({
            title: '<span style="color: #ff0000;"><i class="fas fa-exclamation-triangle"></i> Confirmation Required</span>',
            content: '<span>Are you sure want to continue?</span>',
            buttons: {
                cancel: {
                    text: 'No',
                    btnClass: 'btn-danger btn-sm',
                    action: function(){}
                },
                confirm: {
                    text: 'Yes',
                    btnClass: 'btn-success btn-sm',
                    action: function(){
                        location.href = this.$target.attr('href');
                    }
                },
            }
        });
    },

    confirmAlert: (e, element, message = "Are you sure want to continue?", title = "Confirmation Required") => {
        e.preventDefault();
        $.confirm({
            title: `<span style="color: #ff0000;"><i class="fas fa-exclamation-triangle"></i> ${title}</span>`,
            content: `<span>${message}</span>`,
            buttons: {
                cancel: {
                    text: 'No',
                    btnClass: 'btn-danger btn-sm',
                    action: function(){}
                },
                confirm: {
                    text: 'Yes',
                    btnClass: 'btn-success btn-sm',
                    action: function(){
                        location.href =$(element).attr('href');
                    }
                },
            }
        });
    },
    confirmAlertForForm: (form, message = "Are you sure want to continue?", title = "Confirmation Required") => {
        $.confirm({
            title: `<span style="color: #ff0000;"><i class="fas fa-exclamation-triangle"></i> ${title}</span>`,
            content: `<span>${message}</span>`,
            buttons: {
                cancel: {
                    text: 'No',
                    btnClass: 'btn-danger btn-sm',
                    action: function(){}
                },
                confirm: {
                    text: 'Yes',
                    btnClass: 'btn-success btn-sm',
                    action: function(){
                        $(form).submit();
                    }
                },
            }
        });
    },
    confirmAlertCallback: (callback, message = "Are you sure want to continue?", title = "Confirmation Required") => {
        $.confirm({
            title: `<span style="color: #ff0000;"><i class="fas fa-exclamation-triangle"></i> ${title}</span>`,
            content: `<span>${message}</span>`,
            buttons: {
                cancel: {
                    text: 'No',
                    btnClass: 'btn-danger btn-sm',
                    action: function(){}
                },
                confirm: {
                    text: 'Yes',
                    btnClass: 'btn-success btn-sm',
                    action: function(){
                        callback();
                    }
                },
            }
        });
    },
    showLoader: () => {

    },
    hideLoader: () => {

    },
    showAlert:  (message, type)=> {
        let title = '', content = '';
        if(type === 'error'){
            title = `<span style="color: #ff0000;"><i data-feather="alert-triangle" class="icon-dual"></i>Error!</span>`;
            content = `<span class="text-danger">${message}</span>`;
        }

        if(type === 'warning'){
            title = `<span style="color: #f19606;"><i class="fas fa-exclamation-triangle"></i>Warning!</span>`;
            content = `<span class="text-warning">${message}</span>`;
        }

        if(type === 'success'){
            title = `<span style="color: #0AAC50;"><i class="fas fa-exclamation-triangle"></i>Success!</span>`;
            content = `<span class="text-success">${message}</span>`;
        }
        $.alert({
            title: title,
            content: content,
            buttons: {
                cancel: {
                    text: 'OK',
                    btnClass: 'btn-primary btn-sm',
                    action: function(){}
                }
            }
        });
    },
    openFileViewModel: (filePath, name = '') => {
        // debugger;
        if(!Common.prototype.isNullOrWhitespace(filePath))
        {
            const pdfViewer = '#fileViewModalPdfViewer';
            const imageViewer = '#fileViewModalImageViewer';
            const downloadOtherFile = '#downloadOtherFile';
            const imgExtensions = ['PNG', 'png','jpg', 'jpeg', 'JPG', 'JPEG', 'gif'];
            const filePaths = filePath.split('/');
            const fileType = filePath.split('.').pop();

            //all file viewers initially hide
            $(pdfViewer).hide();
            $(imageViewer).hide();
            $(downloadOtherFile).hide();

            if(name === '')
                name = filePaths[filePaths.length - 1];

            if(fileType === 'pdf')
            {
                $(pdfViewer).attr('src', filePath);
                $(pdfViewer).show();
            }else if(imgExtensions.includes(fileType)){
                $(imageViewer).attr('src', filePath);
                $(imageViewer).show();
            }else{
                $(downloadOtherFile).attr('href', filePath);
                $(downloadOtherFile).attr('download', name);
                $(downloadOtherFile).show();
            }

            $('#fileViewModalTitle').html(`${name}.<span class="text-muted">${fileType}</span>`);
            $('#fileViewModal').modal('show');
        }else{
            Common.prototype.showAlert("File not exists!", "warning")
        }
    },

    isNullOrWhitespace: (value) => {
        return value === null || value.trim() === '';
    },
    toggleModal:  (modalId, status)=> {
        $(`#${modalId}`).modal(status);
    },
    showToast:(message, variant = 'success')=> {
        $('body').append('<div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 99999">\n' +
            '    </div>');
        variant === 'error' ? variant = 'danger' : variant;
        var toastContainer = document.getElementById('toast-container');
        var toast = document.createElement('div');
        toast.classList.add('toast');
        toast.classList.add(`bg-${variant}`);
        toast.setAttribute('role', 'alert');
        toast.setAttribute('aria-live', 'assertive');
        toast.setAttribute('aria-atomic', 'true');
        var toastBody = document.createElement('div');
        toastBody.classList.add('toast-body');
        toastBody.classList.add('text-white');
        toastBody.innerHTML = message;
        toast.appendChild(toastBody);
        toastContainer.appendChild(toast);
        // Initialize Bootstrap toast and show
        var bootstrapToast = new bootstrap.Toast(toast);
        bootstrapToast.show();
        // Remove the toast after it's hidden
        toast.addEventListener('hidden.bs.toast', function () {
            toast.remove();
        });
    },
    submitForm: (event) => {
        const thisForm = $(event).closest('form');
        const url = thisForm.attr('action');
        let formData = new FormData(thisForm[0]);
        return $.ajax({
            url: url,
            type:'post',
            data: formData,
            processData: false,
            contentType: false,
            success: (response)=> {

            },
            error: (response) => {

            }
        });
    },

    getRequiredData: (url, requiredParameters = null) =>{
        let returnData = [];
        return $.ajax({
            url: url,
            type: "get",
            data: {
                '_token'    : token,
                'data'      : requiredParameters
            },
            dataType: "json",
            success: (data) =>{
                returnData.push(data);
            },
            error: (data) =>{
                returnData.push(data);
            }
        });
    },

    /**
     * Global Ajax call for post request
     *
     * @param url request url
     * @param payload Request body data
     * @param callback after success (If status code 200) call that method
     */
    ajaxCallPostRequest: (url, payload, callback) => {
        $.ajax({
            url: url,
            type: "POST",
            dataType: "json",
            data: payload,
            success: function(response)
            {
                if(response.status === 200)
                {
                    if(callback) callback(response);
                }
                else
                {
                    Common.prototype.showErrorAlert(response);
                }
            },
            error: (response) => {
                Common.prototype.showErrorAlert(response);
            }
        });
    },
    /**
     * Global Ajax call for post request with attached file
     *
     * @param url request url
     * @param payload Request body data
     * @param callback after success (If status code 200) call that method
     */
    ajaxCallPostRequestWithFile: (url, payload, callback) => {
        $.ajax({
            url: url,
            type: "POST",
            data: payload,
            processData: false,
            contentType: false,
            success: function(response)
            {
                if(response.status === 200)
                {
                    if(callback) callback(response);
                }
                else
                {
                    console.log(response);
                    Common.prototype.showErrorAlert(response);
                }
            },
            error: (response) => {
                Common.prototype.showErrorAlert(response);
            }
        });
    },

    /**
     * Global Ajax call for post request
     *
     * @param url request url
     * @param callback after success (If status code 200) call that method
     */
    ajaxCallGetRequest: (url, callback) =>{
        $.ajax({
            url: url,
            type: "get",
            dataType: "json",
            headers: {
                'Access-Control-Allow-Origin': '*',
                'Access-Control-Allow-Methods': '*',
                'Access-Control-Allow-Headers': '*',
                'Access-Control-Allow-Credentials': '*'
            },
            success: function(response)
            {
                Common.prototype.hideLoader();
                if(response.status === 200)
                {
                    if(callback) callback(response);
                }
                else
                {
                    Common.prototype.showErrorAlert(response);
                }
            },
            error: (response) => {
                Common.prototype.showErrorAlert(response);
            }
        });
    },

    /**
     * Handle all types of error
     *
     * @param status request status code
     * @param responseJSON
     * @param data
     * @param message
     */
    showErrorAlert({status, responseJSON, data, message}){
        let alertMessage = '';
        switch (status){
            case 500:
                alertMessage = "Something went wrong";
                break;
            case 400:
                alertMessage = message;
                break;
            case 401:
                alertMessage = "Un-authorize user";
                break;
            case 422:
                const {errors} = responseJSON;
                alertMessage = '<ul>';
                for (const key in errors) {
                    errors[key].forEach((error) => {
                        alertMessage += `<li>${error}</li>`;
                    })
                }
                alertMessage += '</ul>';
                break;
            default:
                alertMessage = "Something went wrong";
                break;
        }
        Common.prototype.showAlert(alertMessage, 'error');
    },
    previewBeforeUpload(event, previewHolder) {
        var output = document.getElementById(previewHolder);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src)
        }
    }
}




