<ul class="to-do-menu list-unstyled border rounded-2" id="projectlist-data">
    @foreach($services->groupBy('department_id') as $group_services)
        <li>
            <a class="d-flex nav-link fs-13 collapsed"
               data-bs-toggle="collapse" href="#service{{ $group_services[0]->id }}" role="button"
               aria-expanded="false">
                <div class="flex-shrink-0">
                    <img
                        src="{{ asset($group_services[0]->icon) }}"
                        alt="" class="avatar-xs rounded-circle">
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="fs-14 mb-1">{{ $group_services[0]->department_name }}</h6>
                    <p class="text-muted mb-0">Total {{ $group_services->sum('total_hour') }} Hrs</p>
                </div>
            </a>
            <div class="collapse {{ $from == 's' ? 'show' : '' }}" id="service{{ $group_services[0]->id }}" style="">
                <ul class="mb-0 sub-menu list-unstyled ps-3 vstack gap-2 mb-2">
                    @foreach($group_services as $service)
                        <li>
                            <div class="d-flex">
                                <div class="flex-shrink-0 avatar-xxs text-muted">
                                    <i class=" ri-service-line"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">
                                        <a href="javascript:void(0)" @if($from == 's') onclick="" @else style="cursor: none" @endif>{{ $service->service_name }}</a>
                                    </h6>
                                    <small class="text-muted">{{ $service->total_hour }} Hrs</small>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </li>
    @endforeach
</ul>
