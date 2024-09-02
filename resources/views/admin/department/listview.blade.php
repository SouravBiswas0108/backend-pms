@extends('admin.layouts.admin')

@section('title')
{{__('Manage Department')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('assets/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('script')
    <script src="{{asset('assets/libs/summernote/summernote-bs4.js')}}"></script>
@endpush

@section('action-button')
<div class="row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
        <div class="all-button-box">
            <a href="{{ route('admin.departments.create') }}" data-title="{{__('Create Department')}}"
                class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> {{__('Create')}} </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped dataTable">
                        <thead>
                            <tr>
                                <!-- <th>{{__('Organization Name')}}</th> -->
                                <th>{{__('Department Id')}}</th>
                                <th>{{__('Department Name')}}</th>
                                <th width="300px">{{__('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>


                            <div class="modal" tabindex="-1" id="no_department">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"> HI Admin</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>You don't Have Departments for this year do you want to copy from
                                                previous year!!!.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                id="noButton">NO</button>
                                            <button type="button" class="btn btn-primary" id="yesButton">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(count($department) > 0)
                                @foreach ($department as $dept)
                                    <tr>
                                        <td style="color:black;">{{ $dept['department_id'] }}</td>
                                        <td style="color:black;">{{ $dept['department_name'] }}</td>

                                        <td class="Action">
                                            <span>

                                                <a href="{{route('admin.departments.show', encrypt($dept['department_id']))}}"
                                                    class="edit-icon bg-warning">
                                                    <i class="fas fa-eye"></i></a>

                                                <a href="{{route('admin.departments.edit',encrypt($dept['department_id']))}}" class="edit-icon " data-url="" data-ajax-popup=""
                                                    data-title="{{__('Edit Department')}}"><i class="fas fa-pencil-alt"
                                                        onclick="blockSelection()"></i></a>


                                                <a href="{{route('admin.assignUserRole',encrypt($dept['department_id']))}}"
                                                    class="btn btn-xs btn-white btn-icon-only width-auto edit-icon assign_staff"
                                                    data-url="" data-ajax-popup=""
                                                    data-title="{{__('Assign Staff Department')}}">Assign Officers</a>
                                                <a href="{{route('admin.assignStaff',encrypt($dept['department_id']))}}"
                                                    class="btn btn-xs btn-white btn-icon-only width-auto edit-icon assign_staff"
                                                    data-url="" data-ajax-popup=""
                                                    data-title="{{__('Assign Staff Department')}}">Assign Staff</a>
                                                <a href="#"
                                                    class="btn btn-xs btn-white btn-icon-only width-auto edit-icon assign_staff"
                                                    data-url="" data-ajax-popup=""
                                                    data-title="{{__('Departments Staff')}}">Download Staffs Report</a>

                                            </span>
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr class="font-style">
                                    <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                </tr>
                                @if($year == date('Y'))
                                    <input type="hidden" id="no_dept" name="no_dept" value="1">
                                @endif
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection