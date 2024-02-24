<div class="modal-dialog modal-dialog-centered modal-xs">
    <div class="modal-content">
        <div class="modal-body" id="modalBodyContent">
            <form action="{{ route('admin/chat/group/create') }}" method="post" enctype="multipart/form-data" id="createNewGroupForm">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <input type="hidden" id="memberid-input" class="form-control" value="">
                        <div class="px-1 pt-1">
                            <div class="modal-team-cover position-relative mb-0 mt-n4 mx-n4 rounded-top overflow-hidden">
                                <img src="{{asset('')}}/assets/images/small/img-9.jpg" alt="" id="cover-img" class="img-fluid">

                                <div class="d-flex position-absolute start-0 end-0 top-0 p-3">
                                    <div class="flex-grow-1">
                                        <h5 class="modal-title text-white" id="createMemberLabel">Add New Members</h5>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="d-flex gap-3 align-items-center">
                                            <button type="button" class="btn-close btn-close-white"  id="createMemberBtn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="createGroupStepOne">
                            <div class="text-center mb-4 mt-n5 pt-2">
                                <div class="position-relative d-inline-block">
                                    <div class="position-absolute bottom-0 end-0">
                                        <label for="photo" class="mb-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Select Group Photo">
                                            <div class="avatar-xs">
                                                <div class="avatar-title bg-light border rounded-circle text-muted cursor-pointer">
                                                    <i class="ri-image-fill"></i>
                                                </div>
                                            </div>
                                        </label>
                                        <input class="form-control d-none @error('photo') is-invalid @enderror" type="file" id="photo" name="photo" accept="image/png, image/gif, image/jpeg" onchange="common.previewBeforeUpload(event, 'member-img')">
                                        @error('file')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="avatar-lg">
                                        <div class="avatar-title bg-light rounded-circle">
                                            <img src="{{asset('')}}/assets/images/users/user-dummy-img.jpg" id="member-img" class="w-100 rounded-circle h-auto" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control @error('group_name') is-invalid @enderror" id="group_name" name="group_name" required="" value="{{ old('group_name') }}"  placeholder="Enter group name">
                                @error('group_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="hidden" id="project-input" class="form-control" value="">
                            <input type="hidden" id="task-input" class="form-control" value="">

                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-success float-end w-md" onclick="chat.createGroupNext('{{ route('admin/chat/group/create/memberSuggestion') }}', )">Next</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="createGroupStepTwo" style="display: none;">
                    <div class="mb-3 mt-3">
                        <label for="groupParticipant" class="form-label">Participants<span class="text-danger">*</span></label>
                        <select class="form-select select2" id="groupParticipant" name="groupParticipant[]" multiple required>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" id="btn_request_submit" class="btn btn-success float-start w-md" onclick="chat.backToGroupName(this)">Back</button>
                            <button type="button" id="btn_request_submit" class="btn btn-success float-end w-md" onclick="chat.submitNewGroup(this, '{{ route('admin/chat/group/getGroupsByUserId') }}')">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
