<div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
        <div class="modal-header pb-3 bg-light">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Assign Member</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="profileModalBodyContent">
            <div class="row  justify-content-center">
                <div class="col-2">
                    <img class="w-100 rounded-circle" src="http://localhost/wbcrm//uploads/modules/chats/groups//wb_20231201_73f47654-1fc5-466e-853b-25e84a083b8c.jpg">
                </div>
                <div class="col-12">
                    <h3 class="text-center">Group Name</h3>
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
                                <li>
                                    <a href="javascript: void(0);">
                                        <div class="d-flex align-items-center">
                                            <div
                                                class="flex-shrink-0 chat-user-img online align-self-center me-2 ms-0">
                                                <div class="avatar-xxs"><img
                                                        src="{{ asset('assets/images/users/avatar-2.jpg') }}"
                                                        class="rounded-circle img-fluid userprofile"
                                                        alt=""><span class=""></span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden"><p
                                                    class="text-truncate mb-0">No Menber</p></div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
