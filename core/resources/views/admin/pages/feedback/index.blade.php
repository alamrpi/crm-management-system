@extends('admin.layout')

@section('title') All Feedbacks @endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <div class="">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">All Feedbacks</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    @include('super-admin.shared._message')
                    <form action="{{ route('admin/department/index') }}" method="get" class="mb-2">
                        <div class="row g-1">
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm" name="client_id" id="client_id">
                                    <option value="">-- Type --</option>
                                    <option value="Review">Review</option>
                                    <option value="Suggestion">Suggestion</option>
                                    <option value="Complaint">Complaint</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm" name="client_id" id="client_id">
                                    <option value="">-- Client --</option>
                                    <option value="">Client A</option>
                                    <option value="">Client B</option>
                                    <option value="">Client C</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <select class="form-control form-control-sm" name="client_id" id="client_id">
                                    <option value="">-- Project --</option>
                                    <option value="">Project AAA</option>
                                    <option value="">Project BBB</option>
                                    <option value="">Project CCC</option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" class="btn btn-sm btn-primary waves-effect waves-light"><i class="mdi mdi-filter-variant"></i> Filter</button>
                            </div>
                        </div>
                    </form>

                    <div class="table-responsive bg-white">
                        <table class="table table-sm fs-12 table-borderless table-hover">
                            <thead class="text-muted fs-12">
                            <tr class="table-light">
                                <th>#</th>
                                <th>TYPE</th>
                                <th>CLIENT</th>
                                <th>PROJECT</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                                <td>1</td>
                                <td><span class="badge bg-primary-subtle text-primary">SUGGESTION</span></td>
                                <td>Client A</td>
                                <td>Project AAA</td>
                                <td>{{ date('m/d/Y H:i') }}</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td><span class="badge bg-success-subtle text-success">REVIEW</span></td>
                                <td>Client B</td>
                                <td>Project BBB</td>
                                <td>{{ date('m/d/Y H:i') }}</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td><span class="badge bg-danger-subtle text-danger">COMPLAINT</span></td>
                                <td>Client C</td>
                                <td>Project CCC</td>
                                <td>{{ date('m/d/Y H:i') }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
