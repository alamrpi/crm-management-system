<form id="chatinput-form" enctype="multipart/form-data" onsubmit="event.preventDefault();chat.sendMessage(this)" action="{{ route('admin/chat/send') }}" data-groupId="">
    @csrf
    <div class="row g-0 align-items-center">
        <div class="col-auto">
            <div class="chat-input-links me-2">
                <div class="links-list-item">
                    <button type="button" class="btn btn-link text-decoration-none emoji-btn" id="emoji-btn">
                        <i class="bx bx-smile align-middle"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="chat-input-feedback">
                Please Enter a Message
            </div>
            <div id="chat-file-count"></div>
            <div class="d-flex">
                <input type="text" name="chatMessage" class="form-control chat-input bg-light border-light fs-13" id="chat-input" placeholder="Type your message..." autocomplete="off">
                <label for="chatFiles" style="font-size: 35px; line-height: 30px;"><i class="ri-attachment-2"></i></label>
            </div>
            <input type="file" name="chatFiles[]" id="chatFiles" onchange="chat.chatFileInputCount(this)" style="display: none" multiple>
        </div>
        <div class="col-auto">
            <div class="chat-input-links ms-2">
                <div class="links-list-item">
                    <button type="submit" class="btn btn-success chat-send waves-effect waves-light fs-13">
                        <i class="ri-send-plane-2-fill align-bottom"></i>
                    </button>
                </div>
            </div>
        </div>

    </div>
</form>
