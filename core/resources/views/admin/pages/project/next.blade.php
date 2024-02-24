@extends('admin.layout')

@section('title') New Project @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin/project/index') }}">Projects</a>
                        </li>
                        <li class="breadcrumb-item">New Project</li>
                        <li class="breadcrumb-item active">Next</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body p-2">
                    @include('admin.shared.alert-template')
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <x-pr-add-service-form formUrl="{{ route('admin/project/store-service', ['id' => $id]) }}"/>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Services</h5>
                                </div>
                                <div class="card-body">
                                   <table class="table table-sm table-bordered">
                                       <thead>
                                       <tr>
                                           <th class="text-center">#</th>
                                           <th>Department</th>
                                           <th>Service</th>
                                           <th>Purchase Type</th>
                                           <th class="text-center">Hour</th>
                                           <th>Delete</th>
                                       </tr>
                                       </thead>
                                       <tbody>
                                       @foreach($services as $i => $service)
                                           <tr id="serviceHoler{{ $i }}">
                                               <td class="text-center">{{ $i+1 }}</td>
                                               <td>{{ $service->department_name }}</td>
                                               <td>{{ $service->service_name }}</td>
                                               <td>
                                                   {{ \App\Constants\PurchaseType::ConvertNumberToText($service->purchase_type) }}
                                                   @if($service->purchase_type == \App\Constants\PurchaseType::PER_DAY_HOUR)
                                                       <br>
                                                      (<small>
                                                           <strong>Hour: </strong> {{ $service->hour }}
                                                           <strong>, Employees: </strong> {{ $service->number_of_employee }}
                                                           <strong>, Working Days: </strong> {{ $service->working_day }}
                                                       </small>)
                                                   @endif
                                               </td>
                                               <td class="text-center">{{ $service->total_hour }}</td>
                                               <td class="text-center">
                                                   <button onclick="project.editPurchaseService(this, {{ $service->id }})" type="button" class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></button>
                                                   <a href="{{ route('admin/project/service/delete', ['id' => $id, 'service_id' => $service->id]) }}" class="btn btn-sm btn-danger confirm-alert"><i class="bx bx-trash"></i></a>
                                               </td>
                                           </tr>
                                       @endforeach
                                       </tbody>
                                   </table>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>

                        <div class="col-lg-12">
                            <a href="{{ route('admin/project/edit', ['id' => $id]) }}" class="btn btn-sm btn-info back">
                                <i class="bx bx-arrow-back"></i> Back
                            </a>
                            @if(count($services) > 0)
                                <a href="{{ route('admin/project/overview', ['id' => $id])  }}" class="btn btn-sm btn-success float-end">
                                    <i class="bx bx-check-circle"></i> Complete
                                </a>
                            @else
                                <button type="button" class="btn btn-sm btn-success float-end">
                                    <i class="bx bx-check-circle"></i> Complete
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="hndPurchaseEditUrl" value="{{ route('admin/project/service/next/edit', ['id'=> \App\Utility\Helpers::getParamValue('id'), 'purchase_id'=> '--purchase_id--']) }}">
@endsection
@section('script')
    <script src="{{ asset('core/resources/js/Project.js') }}"></script>
    <script>
        const project = new Project();

    </script>
@endsection
