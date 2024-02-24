@extends('admin.layout')

@section('title') Chat | Admin @endsection


@section('content')
    <div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">
        <div class="chat-leftsidebar border">
            <div class="px-4 pt-4 mb-4">
                <div class="d-flex align-items-start">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 d-block d-lg-none me-3">
                            <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 chat-user-img online user-own-img align-self-center me-3 ms-0">
                                    <img src="{{ asset($profile->photo) }}" class="rounded-circle avatar-xs" alt="">
                                    <span class="user-status"></span>
                                </div>
                                <div class="flex-grow-1 overflow-hidden">
                                    <h5 class="text-truncate mb-0 fs-16"><a class="text-reset username" data-bs-toggle="offcanvas" href="#userProfileCanvasExample" aria-controls="userProfileCanvasExample">{{ $profile->name }}</a></h5>
                                    <p class="text-truncate text-muted fs-14 mb-0 userStatus"><small>Online</small></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-shrink-0" style="position: absolute;right: 6px;">
                        <div class="dropdown">
                            <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-vertical"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" style="">
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#createNewGroupModal">New Group</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="search-box mt-3">
                    <input type="text" class="form-control bg-light border-light" placeholder="Search here...">
                    <i class="ri-search-2-line search-icon"></i>
                </div>
            </div> <!-- .p-4 -->

            <ul class="nav nav-tabs nav-tabs-custom nav-info nav-justified" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" data-bs-toggle="tab" href="#chats" role="tab" aria-selected="false" tabindex="-1" onclick="chat.genarateGroupList('{{ route('admin/chat/history') }}', 'userList', 'No chat history found !')">
                        Chats
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#contacts" role="tab" aria-selected="true" onclick="chat.getContactList('{{ route('admin/chat/group/create/memberSuggestion') }}', 'contactsList', 'No contacts found !')">
                        Contacts
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" data-bs-toggle="tab" href="#groups" role="tab" aria-selected="true" onclick="chat.genarateGroupList('{{ route('admin/chat/group/getGroupsByUserId') }}', 'groupsList', 'No group created !')">
                        Groups
                    </a>
                </li>
            </ul>

            <div class="tab-content text-muted">
                <div class="tab-pane  active show" id="chats" role="tabpanel">
                    <div class="chat-room-list pt-3 simplebar-scrollable-y" data-simplebar="init">
                        <div class="simplebar-wrapper" style="margin: -16px 0px 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                         aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                        <div class="simplebar-content" style="padding: 16px 0px 0px;">

                                            <div class="chat-message-list">

                                                <ul class="list-unstyled chat-list chat-user-list" id="userList">

                                                </ul>
                                            </div>

                                            <!-- End chat-message-list -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 298px; height: 653px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                            <div class="simplebar-scrollbar"
                                 style="height: 579px; transform: translate3d(0px, 0px, 0px); display: block;"></div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="contacts" role="tabpanel">
                    <div class="chat-room-list pt-3 simplebar-scrollable-y" data-simplebar="init"
                         style="max-height: calc(100vh - 305px);">
                        <div class="simplebar-wrapper" style="margin: -16px 0px 0px;">
                            <div class="simplebar-height-auto-observer-wrapper">
                                <div class="simplebar-height-auto-observer"></div>
                            </div>
                            <div class="simplebar-mask">
                                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                    <div class="simplebar-content-wrapper" tabindex="0" role="region"
                                         aria-label="scrollable content" style="height: auto; overflow: hidden scroll;">
                                        <div class="simplebar-content" style="padding: 16px 0px 0px;">
                                            <div class="sort-contact" id="contactsList">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="simplebar-placeholder" style="width: 298px; height: 1442px;"></div>
                        </div>
                        <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;">
                            <div class="simplebar-scrollbar" style="width: 0px; display: none;"></div>
                        </div>
                        <div class="simplebar-track simplebar-vertical" style="visibility: visible;">
                            <div class="simplebar-scrollbar"
                                 style="height: 254px; display: block; transform: translate3d(0px, 0px, 0px);"></div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="groups" role="tabpanel">
                    <ul class="list-unstyled chat-list chat-user-list mt-3" id="groupsList">

                    </ul>
                </div>
            </div>
            <!-- end tab contact -->
        </div>
        <!-- end chat leftsidebar -->
        <!-- Start User chat -->
        <div class="user-chat w-100 overflow-hidden border">

            <div class="chat-content d-lg-flex">
                <!-- start chat conversation section -->
                <div class="w-100 overflow-hidden position-relative">
                    <!-- conversation user -->
                    <div class="position-relative">
                        <div class="position-relative" id="users-chat" style="display: block;">
                            <div class="p-3 user-chat-topbar">
                                <div class="row align-items-center">
                                    <div class="col-sm-4 col-8">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 d-block d-lg-none me-3">
                                                <a href="javascript: void(0);" class="user-chat-remove fs-18 p-1"><i class="ri-arrow-left-s-line align-bottom"></i></a>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden" id="chat-header-wraper">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 col-4">
                                        <ul class="list-inline user-chat-nav text-end mb-0" id="chatCanvasAction" style="display: none;">
                                            <li class="list-inline-item m-0">
                                                <div class="dropdown">
                                                    <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search icon-sm"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                                                    </button>
                                                    <div class="dropdown-menu p-0 dropdown-menu-end dropdown-menu-lg" style="">
                                                        <div class="p-2">
                                                            <div class="search-box">
                                                                <input type="text" class="form-control bg-light border-light" placeholder="Search here..." onkeyup="searchMessages()" id="searchMessage">
                                                                <i class="ri-search-2-line search-icon"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="list-inline-item m-0">
                                                <div class="dropdown">
                                                    <button class="btn btn-ghost-secondary btn-icon" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical icon-sm"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end" style="">
                                                        <a id="chatProfileModalTrigger" class="dropdown-item" href="javascript: void(0);" type="button" class="dropdown-item" data-bs-toggle="modal" onclick="chat.viewChatProfile(0)"><i class="ri-profile-line align-bottom text-muted me-2"></i> View Profile</a>
                                                        <a class="dropdown-item" href="#"><i class="ri-image-line align-bottom text-muted me-2"></i> Media & File</a>
                                                        <a class="dropdown-item" href="#"><i class="ri-delete-bin-5-line align-bottom text-muted me-2"></i> Remove</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                            <!-- end chat user head -->
                            @include('modules.chat.elements._canvas')
                        </div>


                        <div class="chat-input-section p-3 p-lg-4">
                            @include('modules.chat.elements._user-message-input')
                        </div>

                        <div class="replyCard">
                            <div class="card mb-0">
                                <div class="card-body py-3">
                                    <div class="replymessage-block mb-0 d-flex align-items-start">
                                        <div class="flex-grow-1">
                                            <h5 class="conversation-name"></h5>
                                            <p class="mb-0"></p>
                                        </div>
                                        <div class="flex-shrink-0">
                                            <button type="button" id="close_toggle" class="btn btn-sm btn-link mt-n2 me-n3 fs-18">
                                                <i class="bx bx-x align-middle"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    modals--}}
    <div class="modal" id="createNewGroupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createNewGroupModal" aria-hidden="true">
        @include('modules.chat.modals.new-group')
    </div>
    <div class="modal" id="chatProfileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="chatProfileModal" aria-hidden="true">
        @include('modules.chat.modals.chat-profile')
    </div>
@endsection

@section('script')
    <!-- glightbox js -->
    <script src="{{ asset('assets/libs/glightbox/js/glightbox.min.js') }}"></script>

    <!-- fgEmojiPicker js -->
    <script src="{{ asset('assets/libs/fg-emoji-picker/fgEmojiPicker.js') }}"></script>

    <!-- chat init js -->
{{--    <script src="{{ asset('assets/js/pages/chat.init.js') }}"></script>--}}
    <script src="{{ asset('assets/js/pages/notify.js') }}"></script>
    <script src="{{ asset('core/resources/js/modules/Chat.js') }}"></script>
    <script src="{{ asset('core/resources/js/modules/chat.init.js') }}"></script>
    <script>
        const chat = new Chat();
    </script>
@endsection
