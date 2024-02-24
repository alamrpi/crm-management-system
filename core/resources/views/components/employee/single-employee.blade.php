<div class="col">
    <div class="card team-box">
        <div class="team-cover">
            <img src="{{ asset('assets/images/small/img-9.jpg') }}" alt="" class="img-fluid">
        </div>
        <div class="card-body p-4">
            <div class="row align-items-center team-row">
                <div class="col team-settings">
                    <div class="row">
                        <div class="col">
                            <div class="flex-shrink-0 me-2">
                                <button type="button"
                                        class="btn btn-light btn-icon rounded-circle btn-sm favourite-btn ">
                                    <i class="ri-star-fill fs-14"></i></button>
                            </div>
                        </div>
                        <div class="col text-end dropdown"><a
                                href="javascript:void(0);"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill fs-17"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_PROFILE)
                                    <li>
                                        <a class="dropdown-item edit-list" target="_blank" href="{{ route('admin/employee/details', ['id' => $employee->user_id]) }}">
                                            <i class="ri-eye-line me-2 align-bottom text-muted"></i>View Profile
                                        </a>
                                    </li>
                                @endcan
                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_EDIT)
                                <li>
                                    <a class="dropdown-item edit-list" href="{{ route('admin/employee/edit', ['id' => $employee->id]) }}">
                                        <i class="ri-pencil-line me-2 align-bottom text-muted"></i>Edit
                                    </a>
                                </li>
                                @endcan
{{--                                @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_DEACTIVE)--}}
{{--                                <li>--}}
{{--                                    <a class="dropdown-item remove-list confirm-alert" href="{{ route('admin/employee/deactive', ['id' => $employee->id]) }}"  data-bs-toggle="modal" data-remove-id="12">--}}
{{--                                        <i class="ri-close-line me-2 align-bottom text-muted"></i>Deactive--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                @endcan--}}
                                {{-- @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_DELETE)
                                <li>
                                    <a class="dropdown-item remove-list confirm-alert" href="{{ route('admin/employee/delete', ['id' => $employee->id]) }}"  data-bs-toggle="modal" data-remove-id="12">
                                        <i class="ri-delete-bin-5-line me-2 align-bottom text-muted"></i>
                                        Remove
                                    </a>
                                </li>
                                @endcan --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col">
                    <div class="team-profile-img">
                        <div
                            class="avatar-lg img-thumbnail rounded-circle flex-shrink-0">
                            <img
                                src="{{ asset($employee->photo) }}"
                                alt="{{ $employee->name }}"
                                class="member-img img-fluid d-block rounded-circle">
                        </div>
                        <div class="team-content">
                            @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_PROFILE)
                            <a class="member-name" target="_blank" href="{{ route('admin/employee/details', ['id' => $employee->user_id]) }}">
                                <h5 class="fs-16 mb-1">{{ $employee->name }} <span class="text-success"><i class="mdi mdi-check-decagram"></i></span></h5>
                            </a>
                            @endcan
                            <p class="text-muted member-designation mb-0">
                                {{ $employee->designation }}
                                <br>
                                ( {{ $employee->department_name }} )
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col">
                    <div class="row text-muted text-center">
                        <div class="col-6 border-end border-end-dashed"><h5
                                class="mb-1 projects-num">{{ $employee->total_projects }}</h5>
                            <p class="text-muted mb-0">Projects</p></div>
                        <div class="col-6"><h5 class="mb-1 tasks-num">{{ $employee->total_tasks }}</h5>
                            <p class="text-muted mb-0">Tasks</p></div>
                    </div>
                </div>
                <div class="col-lg-2 col">
                    <div class="text-end">
                        @can(App\Constants\Authorization\AuthGate::CHECK_AUTH, (string)\App\Constants\Authorization\Access::EMPLOYEE_PROFILE)
                        <a target="_blank" href="{{ route('admin/employee/details', ['id' => $employee->user_id]) }}" class="btn btn-primary view-btn">
                            View Profile
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
