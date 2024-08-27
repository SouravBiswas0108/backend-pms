@extends('admin.layouts.admin')

@section('title')
{{__('Edit Department')}}
@endsection

@push('head')

    <link rel="stylesheet" href="{{asset('public/assets/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('script')
    <script>
        $(document).ready(function () {

            let element = document.getElementById("blocked-element")

            element.classList.add('no-select');
        });
    </script>
    <script src="{{asset('assets/libs/summernote/summernote-bs4.js')}}"></script>
@endpush

@section('content')

<form class="" method="post" action="{{ route('admin.departments.update', encrypt($department->department_id)) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row p-0">
                        <div class="form-group col-12 p-0 text-right">
                            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
                            <!-- <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal"> -->
                        </div>
                        <div class="col-6 form-group">
                            <label class="form-control-label" for="dept_id">{{ __('Department Id') }}</label>
                            <input type="text" class="form-control" id="dept_id" name="dept_id"
                                value="{{$department->department_id }}" readonly="readonly" />
                        </div>
                        <div class="col-6 form-group">

                        </div>
                        <div class="col-6 form-group">
                            <label class="form-control-label" for="dept_name">{{ __('Department Name') }}</label>
                            <input type="text" class="form-control" id="dept_name" name="dept_name"
                                value="{{$department->department_name}}" />
                        </div>



                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped dataTable_edit_dept" id="my-table">
                                    <thead>
                                        <tr>
                                            <th width="30%">{{__('Staff Names')}}</th>
                                            <th align="center" class="" width="30%">
                                                <!-- <input type="checkbox" name="checkall" class="selectall" id="selectall" onclick="checkUncheckAll(this);"/> -->
                                                <input type="checkbox" name="checkall" id="select-all" />Check
                                                all?<br />
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $alreadyselected = [];

                                        @endphp



                                        @if(isset($departmentlist) && !empty($departmentlist) && is_array($departmentlist))

                                                                            @foreach($departmentlist as $staffs)
                                                                                                                <tr>
                                                                                                                    <td style="color:black;">
                                                                                                                        {{ ($staffs['F_name'] != '') ? ($staffs['F_name']) : "" }}
                                                                                                                        {{ ($staffs['M_name'] != '') ? ($staffs['M_name']) : "" }}
                                                                                                                        {{ ($staffs['L_name'] != '') ? ($staffs['L_name']) : "" }}
                                                                                                                        {{ ($staffs['staff_id'] != '') ? ('(' . $staffs['staff_id'] . ')') : "" }}
                                                                                                                    </td>
                                                                                                                    <td style="color:black;">
                                                                                                                        @php
                                                                                                                            if (in_array($staffs['staff_id'], $departmentlist)) {
                                                                                                                                array_push($alreadyselected, $staffs['staff_id']);
                                                                                                                            }
                                                                                                                        @endphp
                                                                                                                        <input type="checkbox" name="checkall[]" class="sub_chk"
                                                                                                                            value="{{ ($staffs['staff_id'] != '') ? ($staffs['staff_id']) : '' }}"
                                                                                                                            checked="checked" />
                                                                                                                    </td>
                                                                                                                </tr>
                                                                            @endforeach
                                        @endif






                                        @if(isset($departmentlist['unSelectedStafflist']) && !empty($departmentlist['unSelectedStafflist']) && is_array($departmentlist['unSelectedStafflist']))
                                            @foreach($departmentlist['unSelectedStafflist'] as $staffsnew)


                                                <tr>
                                                    <td style="color:black;">
                                                        {{ ($staffsnew['fname'] != '') ? ($staffsnew['fname']) : "" }}
                                                        {{ ($staffsnew['mid_name'] != '') ? ($staffsnew['mid_name']) : "" }}
                                                        {{ ($staffsnew['lname'] != '') ? ($staffsnew['lname']) : "" }}
                                                        {{ ($staffsnew['staff_id'] != '') ? ('(' . $staffsnew['staff_id'] . ')') : "" }}
                                                    </td>
                                                    <td style="color:black;">

                                                        <input type="checkbox" name="checkall[]" class="sub_chk"
                                                            value="{{ ($staffsnew['staff_id'] != '') ? ($staffsnew['staff_id']) : '' }}" />
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif


                                        @if(empty($departmentlist) && empty($departmentlist))
                                            <tr class="font-style">
                                                <td colspan="6" class="text-center">{{ __('No data available in table') }}
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <input type="hidden" name="selected_staff"
                            value="{{ ($alreadyselected != '') ? (implode(',', $alreadyselected)) : 'null' }}"
                            class="selected_staff">

                        <div class="form-group col-12 p-0 text-right">
                            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
                            <!-- <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal"> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

@endsection