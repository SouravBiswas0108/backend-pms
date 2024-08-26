@extends('admin.layouts.admin')

@section('title')
    {{__('Assigned Staffs')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('assets/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('script')
    <script src="{{asset('assets/libs/summernote/summernote-bs4.js')}}"></script>
@endpush


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row p-0">
                    <div class="form-group col-12 p-0 text-right">
                        <input type="button" value="{{__('Back')}}" class="btn-create badge-blue clickme" data-dismiss="modal">
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-control-label" for="dept_id">{{ __('Department Id') }}</label>
                        <input type="text" class="form-control" id="dept_id" name="dept_id" value="{{$department->department_id ?? 'N/A' }}" readonly="readonly" />
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-control-label" for="dept_name">{{ __('Department Name') }}</label>
                        <input type="text" class="form-control" id="dept_name" name="dept_name" value="{{$department->department_name ?? 'N/A'}}" readonly="readonly"/>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped dataTable" id="new">
                                <thead>
                                    <tr>
                                        <th width="30%">{{__('Staff Names')}}</th>
                                        <th align="center" class="" width="30%">
                                            <!-- <input type="checkbox" name="checkall" class="selectall" id="selectall" onclick="checkUncheckAll(this);"/> -->
                                            <!-- <input type="checkbox" name="checkall" id="select-all" />Check all?<br /> -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $alreadyselected =[];
                                    @endphp
                                    @if(isset($data['stafflist']) && !empty($data['stafflist']))
                                    @foreach($data['stafflist'] as $staffs)
                                    <tr>
                                        <td  style="color:black;">
                                            {{$staffs}}

                                        </td>
                                        <td style="color:black;">


                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                        <tr class="font-style">
                                            <td colspan="6" class="text-center">{{ __('No data available in table') }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                     <input type="hidden" name="selected_staff" value="{{ ($alreadyselected !='') ? (implode(',',$alreadyselected)) : 'null' }}" class="selected_staff">

                    <div class="form-group col-12 p-0 text-right">
                        <input type="button" value="{{__('Back')}}" class="btn-create badge-blue clickme" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
