let Project = function () {
    // binding events as soon as the object is instantiated
    this.bindEvents();
};


Project.prototype = {

    bindEvents: function () {
        this.init();
    },

    init: function () {

    },

    /**
     * Get Services by the department
     *
     * @param id department id
     * @param dropdownSelector This is the select id where bind dropdown options
     * @param url ajax call end point to getting data for dropdown
     */
    getServicesByDepartmentId: function (id, dropdownSelector, url )
    {
        common.showLoader();
        $(dropdownSelector).html('<option value=""> Loading.. </option>');
        if(id !== ''){
            $.ajax({
                url: url,
                type: "post",
                data: {
                    'department_id':id,
                    '_token': token
                },
                dataType: "json",
                success: function({status, data})
                {
                    if(status === 200){
                        $(dropdownSelector).html(data);
                    }else{
                        common.showAlert('Something went wrong', 'error');
                    }
                    common.hideLoader();
                }
            });
        }else{
            $(dropdownSelector).html('<option value=""> Not available </option>');
        }
    },

    /**
     * Handle the purchase type select element from the purchase service form
     * @param type which type is selected
     */
    purchaseTypeHandler: (type) =>
    {
        const labelTxt = '#spnTotalHour';
        const perDayFormContainer = '#PerDayHour';
        const totalHourInput = '#total_hour'

        if(type === '2')
        {
            $(totalHourInput).prop('readonly', true);
            $(labelTxt).text('Total Hour');
            $(perDayFormContainer).html($('#hdnPerDayHourFields').html());
        }else{
            $(totalHourInput).prop('readonly', false);
            $(labelTxt).text('Hour');
            $(perDayFormContainer).html('')
            $(totalHourInput).val('');
        }
    },

    /**
     * Handle the purchase type select element from the purchase service form
     * @param type which type is selected
     */
    modalPurchaseTypeHandler: (type) =>
    {
        const labelTxt = '#modalspnTotalHour';
        const perDayFormContainer = '#modalPerDayHour';
        const totalHourInput = '#modaltotal_hour'

        if(type === '2')
        {
            $(totalHourInput).prop('readonly', true);
            $(labelTxt).text('Total Hour');
            $(perDayFormContainer).html($('#modalhdnPerDayHourFields').html());
        }else{
            $(totalHourInput).prop('readonly', false);
            $(labelTxt).text('Hour');
            $(perDayFormContainer).html('')
            $(totalHourInput).val('');
        }
    },
    /**
     * Calculate total hour when the purchase type is select "Per Day Hour" option.
     */
    calculateTotalHourForService: () => {
        const purchaseType = $('#purchase-type').val();
        if(purchaseType === '2'){
            const hour = Number($('#PerDayHour').find('#hour').val());
            const employee = Number($('#PerDayHour').find('#number_of_employee').val());
            const working_day = Number($('#PerDayHour').find('#working_day').val());
            $('#total_hour').val((hour * employee * working_day));
        }
    },
    modalcalculateTotalHourForService: () => {
        const purchaseType = $('#modalpurchase-type').val();
        if(purchaseType === '2'){
            const hour = Number($('#modalPerDayHour').find('#modalhour').val());
            const employee = Number($('#modalPerDayHour').find('#modalnumber_of_employee').val());
            const working_day = Number($('#modalPerDayHour').find('#modalworking_day').val());
            $('#modaltotal_hour').val((hour * employee * working_day));
        }
    },

    requestAddOrEditModal: (url, title = '', details = '', isEdit = 0) => {
        const titleSelector = '#requestAddOrEditModalTitle';
        const submitBtnSelector = '#btn_request_submit';
        $('#requestForm').attr('action', url)
        if(isEdit === 0){
            $(titleSelector).text('New Request');
            $(submitBtnSelector).text('Save');
        }else{
            $('#request_title').val(title);
            $('#request_details').val(details);
            $(titleSelector).text('Update Request');
            $(submitBtnSelector).text('Update');
        }
        $('#requestAddOrEditModal').modal('show');
    },
    changeAccessRequestDdlHandler: (ddl) =>{
        const accessTitleSelector = '#access_title';
        const selectedText = $(ddl).find('option:selected').text();
        if(selectedText !== 'None')
            $(accessTitleSelector).val(selectedText);
        else
            $(accessTitleSelector).val('');
    },
    isNullOrWhitespace: (value) => {
        return value === null || value.trim() === '';
    },
    getMemberByDepartmentId: function (deptId = null, url = null){
        common.showLoader();
        $('#manager_id').html('<option> Loading.. </option>');
        $('#executive_id').html('<option> Loading.. </option>');
        if(deptId !== ''){
            $.ajax({
                url: url,
                type: "get",
                data: {
                    'department_id':deptId,
                    '_token': token
                },
                dataType: "json",
                success: function({status, data})
                {
                    if(status === 200){
                        let manager = '';
                        let executive= '';
                        data.forEach((employee) => {
                            if (employee.employee_type == 1){
                                manager+=`<option value="${employee.id}">${employee.name}</option>`;
                            }
                            if (employee.employee_type == 2){
                                executive+=`<option value="${employee.id}">${employee.name}</option>>`;
                            }
                        });
                        $('#manager_id').html(manager);
                        $('#executive_id').html(executive);
                    }else{
                        common.showAlert('Something went wrong', 'error');

                    }
                    common.hideLoader();
                },
                error: function(data){
                }
            });
        }else{
            $('#manager_id').html('<option value=""> Not available </option>');
        }
    },
    assignMember: function() {
        event.preventDefault();
        let manager_ids = $('select[name="manager_ids[]"]').val();
        let executive_ids = $('select[name="executive_ids[]"]').val();
        let url = $('#assignMemberAccessForm').attr('action');
        if (manager_ids.length !== 0 || executive_ids.length !== 0) {
            $.ajax({
                url: url,
                type: "post",
                data: {
                    data: {
                        'manager_ids': manager_ids,
                        'executive_ids': executive_ids,
                    },
                    '_token': token
                },
                dataType: "json",
                success: function ({status, data}) {
                    if (status === 200) {
                        window.location = '';
                    } else {
                        common.showAlert('Something went wrong', 'error');
                    }
                    common.hideLoader();
                },
                error: function(data){
                    console.log(data);
                }
            });
        }else{
            common.showAlert('Manager Or Executive Must be Selected!',  'error');
        }
    },
    chngeProjectStatus: function(url, status){
        $.ajax({
            url: url,
            type: "post",
            data: {
                status: status,
                '_token': token
            },
            dataType: "json",
            success: function ({status, data}) {
                console.log(status);
                if (status === 200) {
                    if(data == 'success'){
                        window.location = '';
                    }else{
                        common.showAlert(data, 'warning');
                    }
                } else {
                    common.showAlert('Something went wrong', 'error');
                }
            },
            error: function(data){
                console.log(data);
            }
        });
    },
    /*****
     * Project ststus pie chart
     * @param ProjectId ******
     * ******/
    editPurchaseService:(btn, serviceId)=>{
        let url = $('#hndPurchaseEditUrl').val().replace('--purchase_id--', serviceId)
        Project.prototype.openModal(url)
    },
    openModal: (url) => {
        common.ajaxCallGetRequest(url, (response) => {
            $('#commonModal').html(response.data).modal('show');
        })
    },
};




