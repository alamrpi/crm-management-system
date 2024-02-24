let ClientInfo = {
    id: '',
    name: '',
    email: '',
    companyName: '',
    address: '',
    photo: ''
}


var Client = function () {
    // binding events as soon as the object is instantiated
    this.bindEvents();
};


Client.prototype = {

    bindEvents: function () {
        this.init();
    },

    init: function () {

    },

    getClientInfo: function (id, url)
    {
        common.showLoader();
        $.ajax({
            url: url,
            type: "post",
            data: {'client_id':id,'_token': token},
            dataType: "json",
            success: function({status, data})
            {
                if(status === 200){
                    $('#client_info').html(data);
                }else if(status === 400){
                    common.showAlert("Client not found!", 'error');
                }else{
                    common.showAlert('Something went wrong', 'error');
                }
                common.hideLoader();
            }
        });
    }
};





