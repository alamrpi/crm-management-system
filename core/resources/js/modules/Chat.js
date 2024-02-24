let caht = 'new chat';

let Chat = function () {
    // binding events as soon as the object is instantiated
    this.bindEvents();
};


Chat.prototype = {

    bindEvents: function () {
        this.init();

    },

    init: function () {
        Chat.prototype.genarateGroupList('./chat/get/history', 'userList', 'No chat history found !');
        var myModalEl = document.getElementById('createNewGroupModal');
        myModalEl.addEventListener('hidden.bs.modal', function (event) {
            document.getElementById('createNewGroupForm').reset();
            $('#groupParticipant').html('');
            $('#createGroupStepTwo').hide(200, function(){
                $('#createGroupStepOne').show(200);
            });
        });
    },
    createGroupNext: (dataSource) =>{
        let options = '';
        const groupName =$('input[name="group_name"]').val()
        const photo =$('input[name="photo"]').val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if(!allowedExtensions.exec(photo) || common.isNullOrWhitespace(groupName)){
            common.showAlert('Group name and photo are required !', 'error');
            return false;
        }
        $.ajax({
            url: dataSource,
            type: "get",
            data: {
                '_token'    : token
            },
            dataType: "json",
            success: (data) =>{
                data.data.forEach((suggestion) => {
                    options+=`<option value="${suggestion.id}">${suggestion.name}</option>`;
                });
                $('#groupParticipant').html(options);
                $('#createGroupStepOne').hide(200, function(){
                    $('#createGroupStepTwo').show(200);
                });
            },
            error: (data) =>{
                common.showAlert('Something went wrong! Reload page and try again!', 'warning')
            }
        });
    },
    submitNewGroup:(event, NextEventDataSource = null) =>{
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
                thisForm[0].reset();
                $('#groupParticipant').html('');
                $('#createGroupStepTwo').hide(200, function(){
                    $('#createGroupStepOne').show(200);
                });
                Chat.prototype.genarateGroupList(NextEventDataSource, 'groupsList', 'No group created !');
                Chat.prototype.startChat(response.data);
                common.showAlert('Group created successfully !', 'success');
                common.toggleModal('createNewGroupModal', 'hide');
            },
            error: (response, data) => {
                if (response.status ==422){
                    const errors = response.responseJSON.errors;
                    for (const index in errors) {
                        common.showToast(errors[index], 'error');
                    }

                }
            }
        });
    },
    backToGroupName(){
        $('#groupParticipant').html('');
        $('#createGroupStepTwo').hide(200, function(){
            $('#createGroupStepOne').show(200);
        });
    },
    genarateGroupList :( dataSource, holder, emptyMessage ) => {
        Chat.prototype.randerGroupList(holder);
        $.ajax({
            url: dataSource,
            type: "get",
            data: {
                '_token': token

            },
            dataType: "json",
            success: (response) => {
                let groupList = '';
                Chat.prototype.randerGroupList(holder , response.data, emptyMessage);
            },
            error: (data) => {
                common.showAlert('Something went wrong! Reload page and try again!', 'warning')
            }
        });
    },
    startChat: (groupId) =>{
        $('.user-chat').addClass('user-chat-show');
        const url = `chat/start/${groupId}/2`
        $.ajax({
            url: url,
            type: "get",
            data: {
                '_token': token
            },
            dataType: "json",
            success: (response) => {
                Chat.prototype.getMessage('chat/get/group/'+groupId);
                Chat.prototype.randerChatHeader(response.data.group);
            },
            error: (data) => {
                common.showAlert('Something went wrong! Reload page and try again!', 'warning')
            }
        });
    },
    viewChatProfile: (groupId) =>{
        if (groupId == 0){
            return common.showAlert('Please select a conversation from group list or chat list', 'error');
        }
        common.toggleModal('chatProfileModal', 'show');
        $('.user-chat').addClass('user-chat-show');
        const url = `chat/start/${groupId}/1`
        $.ajax({
            url: url,
            type: "get",
            data: {
                '_token': token
            },
            dataType: "json",
            success: (response) => {
                Chat.prototype.randerChatProfile(response.data);
            },
            error: (data) => {
                common.showAlert('Something went wrong! Reload page and try again!', 'warning')
            }
        });
    },
    chatFileInputCount: (event) => {
        var files = $(event)[0].files;
        const fileCount = files.length
        if(fileCount > 1){
            return $('#chat-file-count').text(`Selected Files : ${fileCount}`);
        }
        return $('#chat-file-count').text(`Selected File : ${fileCount}`);
    },
    sendMessage: (event) => {
        let url = event.getAttribute('action');
        let groupId = event.getAttribute('data-groupId');
        let formData = new FormData(event);
        formData.append("groupId", groupId);
        common.ajaxCallPostRequestWithFile(url, formData, (responnse) =>{
            event.reset();
            $('#chat-file-count').text('');
            $('input[name="chatMessage"]').focus();
            Chat.prototype.renderConversation(responnse, 1);
        })
    },
    getMessage: (url) => {
        Chat.prototype.ajaxCallGetRequest(url,(response) =>{
            Chat.prototype.renderConversation(response);
        });
    },
    getContactList: (dataSource, renderTo, emptyMessage) => {
        Chat.prototype.renderContactList(null, renderTo);
        Chat.prototype.ajaxCallGetRequest(dataSource,(response) =>{
            let data = response.data.reduce((r, e) => {
                // get first letter of name of current element
                let alphabet = e.name[0];
                // if there is no property in accumulator with this letter create it
                if (!r[alphabet]) r[alphabet] = { alphabet, record: [e] }
                // if there is push current element to children array for that letter
                else r[alphabet].record.push(e);
                // return accumulator
                return r;
            }, {});
            data = Object.values(data);
            Chat.prototype.renderContactList(data, renderTo, emptyMessage);

        });
    },
    newPersonalChat: (id) => {
        let url = 'chat/new-personal-chat'
        $.ajax({
            url: url,
            method: 'post',
            data: {
                '_token' : token,
                'user_id' : id
            },
            dataType: "json",
            success: (response) => {
                Chat.prototype.startChat(response.data.groupId);
            },
            error: (response) => {
                Common.prototype.showErrorAlert(response);
            }
        });
    },

    ajaxCallGetRequest: (url, callback) =>{
        $.ajax({
            url: url,
            type: "get",
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
    /************************************************
    @ HTML ELEMENT RANDER FUNCTIONS BELLOW HARE
    @
    @
     ***********************************************/
    randerChatHeader: (headerData) => {
        document.getElementById('chatCanvasAction').style.display = 'block';
        $('#chatProfileModalTrigger').attr('onclick', `chat.viewChatProfile('${headerData.id}')`);
        $('#chatinput-form').attr('data-groupId', headerData.id);
        const header = `<div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                        <img src="${assetsPath}/${headerData.photo}" class="rounded-circle avatar-xs" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">${headerData.group_name}</a></h5>
                                        <p class="text-truncate text-muted fs-14 mb-0 userStatus"><small>Online</small></p>
                                    </div>
                                </div>`;
        $('#chat-header-wraper').html(header);
    },
    randerChatProfile: (data) => {
        let chatParticipant = '';
        data.chatParticipants.forEach((participant) =>{
            chatParticipant+= `<li>
                                    <a href="javascript: void(0);">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                                                <div class="avatar-xxs"><img
                                                        src="${assetsPath}/${participant.photo}"
                                                        class="rounded-circle img-fluid userprofile"
                                                        alt=""><span class="user-status"></span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden"><p
                                                    class="text-truncate mb-0">${participant.name}</p></div>
                                        </div>
                                    </a>
                                </li>`;
        });
        let htmlContent = `<div class="row  justify-content-center">
                <div class="col-2">
                    <img class="w-100 rounded-circle" src="${assetsPath}/${data.group.photo}">
                </div>
                <div class="col-12">
                    <h3 class="text-center">${data.group.group_name}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card" style="height: 50vh">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h4>Participant List</h4>
                                </div>
                                <div class="col-3">
                                    <button class="btn btn-success">Add Member</button>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-auto card-body">
                            <ul class="list-unstyled chat-list">
                                ${chatParticipant}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>`;
        document.getElementById('profileModalBodyContent').innerHTML = htmlContent;
    },
    chatCanvasHeader: (headerData) =>{
        const header = `<div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                        <img src="${assetsPath}/${headerData.photo}" class="rounded-circle avatar-xs" alt="">
                                        <span class="user-status"></span>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">${headerData.group_name}</a></h5>
                                        <p class="text-truncate text-muted fs-14 mb-0 userStatus"><small>Online</small></p>
                                    </div>
                                </div>`;
        $('#chat-header-wraper').html(header);
    },
    randerGroupList: (holder, memberList = null, emptyMessage = null) =>{
        let groupList = '';
        if (memberList && memberList.length){
                memberList.forEach((group)=>{
                    groupList+= `<li id="contact-id-${group.id}-group" data-name="direct-message">
                            <a href="javascript: void(0);" onclick="chat.startChat(${group.id})">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                                        <div class="avatar-xxs"><img
                                                src="${group.photo ? assetsPath+group.photo : ''}"
                                                class="rounded-circle img-fluid userprofile"
                                                alt=""><span class="user-status"></span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden"><p
                                            class="text-truncate mb-0">${group.group_name}</p></div>
                                </div>
                            </a>
                        </li>`;
                });
        }else{
            groupList = `<li id="contact-id-1" data-name="direct-message">
                            <a href="javascript: void(0);">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                                        <div class="avatar-xxs"</span>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden"><p
                                            class="text-truncate mb-0">${emptyMessage !== null ? emptyMessage : 'Loading...'}</p></div>
                                </div>
                            </a>
                        </li>`;
        }
        document.getElementById(holder).innerHTML = groupList;
    },
    renderSendedMessage: (response) => {
        let conversationHtml
        let scrollTo = 0;
        response.data.data.reverse().forEach((item)=> {
            scrollTo = scrollTo < item.id ? item.id : scrollTo;
            conversationHtml = ` <li class="chat-list right" id="5">
                                <div class="conversation-list">
                                    <div class="user-chat-content">
                                        <div class="ctext-wrap">
                                            <div class="ctext-wrap-content" id="${item.id}">
                                                <p class="mb-0 ctext-content">${item.message}</p>
                                            </div>
                                            <div class="dropdown align-self-start message-box-drop"> <a
                                                    class="dropdown-toggle" href="#" role="button"
                                                    data-bs-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false"> <i class="ri-more-2-fill"></i> </a>
                                                <div class="dropdown-menu"> <a class="dropdown-item reply-message"
                                                                               href="#"><i
                                                            class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                                                    <a class="dropdown-item copy-message" href="#"><i
                                                            class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                                                    <a class="dropdown-item" href="#"><i
                                                            class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                                                    <a class="dropdown-item delete-item" href="#"><i
                                                            class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="conversation-name"><span class="d-none name">Frank
                                                Thomas</span><small class="text-muted time">09:30 am</small> <span
                                                class="text-success check-message-icon"><i
                                                    class="bx bx-check-double"></i></span></div>
                                    </div>
                                </div>
                            </li>`;
        });
        const messageContainer = $('#users-conversation');
        messageContainer.append(conversationHtml);
        window.location.hash=scrollTo;
    },
    renderConversation: (response, type = 0) => {
        let conversationHtml = '';
        let scrollTo = 0;
        response.data.data.reverse().forEach((item)=>{
            scrollTo = scrollTo < item.id ? item.id : scrollTo;
            let fileHtml = '';
            if(item.file_count){
                item.files.forEach((file) => {
                    fileHtml += `<div class="message-img mb-0">
                        <div class="message-img-list">
                            <div>
                                <a class="popup-img d-inline-block" href="javascript: void(0);" onclick="common.openFileViewModel('${assetsPath+'/'+file.path}')">
                                    <img src="https://placehold.co/600x400?text=${file.ext}" alt="" class="rounded border mb-1" />
                                </a>
                            </div>
                            <div class="message-img-link">
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="ri-more-fill"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="${assetsPath}/assets/images/small/img-2.jpg" download=""><i
                                                    class="ri-download-2-line me-2 text-muted align-bottom"></i>Download</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                                            <a class="dropdown-item" href="#"><i
                                                    class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                                            <a class="dropdown-item delete-image" href="#"><i
                                                    class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>`;
                });
            }
            if (response.user == item.participant_id){
                conversationHtml+= `<li class="chat-list right" id="${item.id}">
                    <div class="conversation-list">
                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                    ${fileHtml}
                                    <p class="mb-0 ctext-content">${item.message ? item.message : ''}</p>
                                </div>
                                <div class="dropdown align-self-start message-box-drop">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a>
                                    <div class="dropdown-menu"> <a class="dropdown-item reply-message" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                                        <a class="dropdown-item copy-message" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="conversation-name">
                                <span class="d-none name">${item.name}</span>
                                <small class="text-muted time">${item.created_at}</small>
                                <span class="text-success check-message-icon"><i class="bx bx-check-double"></i></span>
                            </div>
                        </div>
                    </div>
                </li>`;
            }else{
                conversationHtml+= `<li class="chat-list left" id="${item.id}">
                    <div class="conversation-list" title="${item.name}">
                        <div class="chat-avatar"><img src="${item.user ? assetsPath +'/'+ item.user : ''}" alt=""></div>
                        <div class="user-chat-content">
                            <div class="ctext-wrap">
                                <div class="ctext-wrap-content">
                                    <div>${fileHtml}</div>
                                    <p class="mb-0 ctext-content">${item.message ? item.message : ''}</p>
                                </div>
                                <div class="dropdown align-self-start message-box-drop">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ri-more-2-fill"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item reply-message" href="#"><i class="ri-reply-line me-2 text-muted align-bottom"></i>Reply</a>
                                        <a class="dropdown-item" href="#"><i class="ri-share-line me-2 text-muted align-bottom"></i>Forward</a>
                                        <a class="dropdown-item copy-message" href="#"><i class="ri-file-copy-line me-2 text-muted align-bottom"></i>Copy</a>
                                        <a class="dropdown-item" href="#"><i class="ri-bookmark-line me-2 text-muted align-bottom"></i>Bookmark</a>
                                        <a class="dropdown-item delete-item" href="#"><i class="ri-delete-bin-5-line me-2 text-muted align-bottom"></i>Delete</a>
                                    </div>
                                </div>
                            </div>
                            <div class="conversation-name">
                                <span class="name">${item.name}</span>
                                <small class="text-muted time">${item.created_at}</small>
                                <span class="text-success check-message-icon">
                                    <i class="bx bx-check-double"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </li>`;
            }
        });
        const messageContainer = $('#users-conversation');
        if (type) {
            messageContainer.append(conversationHtml);
        }else{
            messageContainer.html(conversationHtml);
        }
            setTimeout(function (){window.location.hash=scrollTo;}, 5000);
    },
    renderContactList: (response = null, renderTo = null, emptyMessage = null) =>{
        let htmlFroRender = '';
        if (response && response.length){
            response.forEach( (groups) => {
                let chieldElement = '';
                groups.record.forEach((item) => {
                    chieldElement += `<li class="cursor-pointer" onclick="chat.newPersonalChat(${item.id})">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 me-2">
                                <div class="avatar-xxs">
                                    <img class="img-fluid rounded-circle" src="${assetsPath}/${item.photo}" alt="">
                                </div>
                            </div>
                            <div class="flex-grow-1"><p class="text-truncate contactlist-name mb-0">${item.name}</p></div>
                            <div class="flex-shrink-0">
                                <div class="dropdown"><a href="#" class="text-muted" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a>
                                    <div class="dropdown-menu dropdown-menu-end"><a class="dropdown-item" href="#"><i class="ri-pencil-line text-muted me-2 align-bottom"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="ri-forbid-2-line text-muted me-2 align-bottom"></i>Block</a>
                                        <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-line text-muted me-2 align-bottom"></i>Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </li>`;
                });
                htmlFroRender += `<div class="mt-3">
                <div class="contact-list-title">${groups.alphabet}</div>
                <ul id="contact-sort-A" class="list-unstyled contact-list">
                    ${chieldElement}
                </ul>
            </div>`;
            });
            document.getElementById(renderTo).innerHTML = htmlFroRender;
        }else {
            htmlFroRender = `<ul class="list-unstyled chat-list chat-user-list mt-3">
                <li id="contact-id-1" data-name="direct-message">
                    <a href="javascript: void(0);">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                                <div class="avatar-xxs"></div>
                            </div>
                            <div class="flex-grow-1 overflow-hidden"><p class="text-truncate mb-0">${emptyMessage !== null ? emptyMessage : 'Loading...'}</p></div>
                        </div>
                    </a>
                </li>
            </ul>`;
            document.getElementById(renderTo).innerHTML = htmlFroRender;
        }
    }
};
