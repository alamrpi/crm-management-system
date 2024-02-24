@extends('client.layout')

@section('title') Teams @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-light">
                <h4 class="mb-sm-0">Teams</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('clientarea/project/dashboard', ['slug'=>$current_project['slug']]) }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Teams</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            @include('client.shared._message')

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row g-4 mb-2">
                                <div class="col-sm-8">
                                    <form>
                                    <div class="row g-2 mb-3">
                                        <div class="col">
                                            <div class="position-relative">
                                                <input name="emp_name"  value="{{ request()->input('emp_name') }}" type="text" class="form-control form-control-sm border-light bg-light" placeholder="Search member">
                                            </div>
                                        </div><!-- end col -->
                                        <div class="col">
                                            <select class="form-control form-control-sm border-light bg-light" name="employee_type" id="">
                                                <option value="0">-- All -- </option>
                                                @foreach($employeeTypes as $type)
                                                    <option value="{{ $type->employee_type }}" {{ request()->input('employee_type') == $type->employee_type    ? 'selected' : '' }}>{{ \App\Constants\EmployeeTypes::ConvertNumberToText($type->employee_type) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="btn btn-sm btn-soft-primary"><span class="d-none d-sm-inline-block me-2"><i class="ri-filter-3-line align-bottom"></i> Filter</span></button>
                                        </div><!-- end col -->
                                    </div>
                                    </form>
                                </div>
                                <div class="col-sm-4">

                                </div>
                            </div>

                            <div class="table-responsive table-card">
                                <table class="table table-hover table-nowrap align-middle mb-0">
                                    <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col" class="text-center" style="width: 80px;"><i class="ri-image-line"></i></th>
                                        <th scope="col">Member</th>
                                        <th scope="col" class="text-center">Role</th>
                                        <th scope="col">Tasks <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Completed Tasks / Assigned Tasks" data-bs-placement="top"><sup><i class="las la-info"></i></sup></span></th>
                                        <th scope="col">Hours <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="Completed Hours / Assigned Hours" data-bs-placement="top"><sup><i class="las la-info"></i></sup></span></th>
                                        <th scope="col" style="width: 200px;">Status</th>
                                        <th class="text-center">Favourite</th>
{{--                                        <th class="text-center">Action</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($teamMembers as $member)
                                        <tr>
                                            <td class="text-center"><img src="{{ asset($member->photo) }}" alt="" class="avatar-xs rounded-3 me-2">
                                            </td>
                                            <td>
                                                <div>
                                                    <h5 class="fs-13 mb-0"><a target="_blank" href="{{ route('clientarea/project/team/profile', ['slug'=>$current_project['slug'], 'id' => $member->user_id]) }}">{{ $member->name }}</a></h5>
                                                    <p class="fs-12 mb-0 text-muted">{{ $member->designation  }}, ({{ $member->dept_name }})</p>
                                                </div>
                                            </td>
                                            <td class="text-center"><span class="badge bg-primary-subtle text-primary">{{\App\Constants\EmployeeTypes::ConvertNumberToText($member->employee_type)}}</span></td>
{{--                                            <td class="text-center"> 12 </td>--}}
                                            <td>
                                                {{ ProjectTaskHelper::getCompleteTaskByUser($member->user_id) }} / {{ ProjectTaskHelper::getTotalTaskByUser($member->user_id) }}
                                            </td>
                                            <td>{{ ProjectTaskHelper::getCompleteTaskByUser($member->user_id, 0, 'hour') }} / {{ ProjectTaskHelper::getTotalTaskByUser($member->user_id, 0, 'hour') }} Hrs</td>
                                            <td>
                                                <div class="progress" style="height: 25px; border-radius: 15px;">
                                                    <div class="progress-bar" role="progressbar" style="width: {{ProjectTaskHelper::getTaskCompleteTasksRatioByUser($member->user_id)}}%;" aria-valuenow="25" aria-valuemin="{{ProjectTaskHelper::getTaskCompleteTasksRatioByUser($member->user_id)}}" aria-valuemax="100">{{ProjectTaskHelper::getTaskCompleteTasksRatioByUser($member->user_id)}}%</div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn fs-16 p-0 favourite-btn">
                                                    <i class="ri-star-fill"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7">No Data Found</td>
                                        </tr>
                                    @endforelse
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>

                            <div class="row g-0 text-center text-sm-start align-items-center mt-4">
                                <div class="col-sm-6">
                                    <div>
                                        <p class="mb-sm-0"><div class="text-muted">Showing <span class="fw-semibold">{{ $teamMembers->firstItem() }} - {{ $teamMembers->lastItem() }}</span> of <span class="fw-semibold">{{ $teamMembers->total() }}</span> Members
                                        </div></p>
                                    </div>
                                </div> <!-- end col -->
                                <div class="col-sm-6">
                                    {{ $teamMembers->links() }}
                                </div><!-- end col -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
