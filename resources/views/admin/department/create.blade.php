@extends('admin.layouts.admin')

@section('title')
    {{__('Create Department')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('public/assets/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('script')
    <script src="{{asset('public/assets/libs/summernote/summernote-bs4.js')}}"></script>
@endpush


@section('content')
    <form class="" method="post" action="{{ route('admin.departments.store') }}">
        @csrf
        <div class="row step_1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-0">
                            <div class="form-group col-12 p-0 text-right">
                                <input type="button" value="{{__('Next')}}" class="btn-create badge-blue next">
                                <!-- <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal"> -->
                            </div>
                            <div class="col-6 form-group">
                                <input type="hidden" name="selected_staff" value="" class="selected_staff">
                                @php
                                $randomString = "DP";

                                for ($i = 0; $i < 6; $i++) {
                                if ($i < 6) {
                                $randomString.=rand(0,9);
                                }
                                if ($i == 8) {
                                //$randomString.=chr(rand(65,90));
                                }
                                }
                                @endphp
                                <label class="form-control-label" for="dept_id">{{ __('Department Id') }}</label>
                                <input type="text" class="form-control" id="dept_id" name="dept_id" value="{{ $randomString }}" readonly="readonly" required/>
                            </div>
                            @if($user->type == 'Admin')
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="organization">{{ __('Organization') }}</label>
                                <select name="org_code" class="form-control select2" required id="organization">
                                        <option value="{{$organization[0]['org_code']}}" selected >{{$organization[0]['org_name']}}</option>
                                </select>
                            </div>
                            @endif
                            @if($user->type == 'Owner')
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="organization">{{ __('Organization') }}</label>
                                <select name="org_code" class="form-control select2" required id="organization">
                                    @foreach($organization as $org)
                                        <option value="{{$org->org_code}}">{{$org->org_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="dept_name">{{ __('Department Name') }}</label>
                                <input type="text" class="form-control" id="dept_name" name="dept_name" required/>
                            </div>
                            <div class="requireNameMsg" style="display: none; position: absolute;
                            top: 280px;
                            left: 28px;
                            color: red;">Department Name is required.</div>

                          <div class="col-6 form-group">
                            <label class="form-control-label" for="year">{{ __('Year') }}</label>
                             <select name="year" class="form-control">
                             @for ($i=2020;$i<=date('Y')+2;$i++)
                            <option value={{ $i }} @if($i==date('Y')) {{ 'selected' }} @endif>{{ $i }}</option>
                             @endfor
                             </select>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row step_2" style="display: none;">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="requireStaffMsg" style="display: none;color: red;">Please select staff for your department.</div>
                            <div class="table-responsive">
                                <table class="table table-striped dataTable" id="table">
                                    <thead>
                                        <tr>
                                            <th width="30%">{{__('Staff Names')}}</th>
                                            <th align="center" class="" width="30%">
                                                <!-- <input type="checkbox" name="checkall" class="selectall" id="selectall" onclick="checkUncheckAll(this);"/> -->
                                                <input type="checkbox" name="checkall" id="select-all" />Check all?<br />
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($stafflist) > 0)
                                        @foreach ($stafflist as $staffs)
                                        <tr>
                                            <td  style="color:black;">
                                            {{ ($staffs['F_name'] !='') ? ($staffs['F_name']) : "" }}
                                            {{ ($staffs['M_name'] !='') ? ($staffs['M_name']) : "" }}
                                            {{ ($staffs['L_name'] !='') ? ($staffs['L_name']) : "" }}
                                    {{ ($staffs['staff_id'] !='') ? ('('.$staffs['staff_id'].')') : "" }}
                                            </td>
                                            <td style="color:black;">
                                            <input type="checkbox" name="checkall[]" class="sub_chk" value="{{ ($staffs['staff_id'] !='') ? ($staffs['staff_id']) : '' }}"/>
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
                    </div>

                       <div class="form-group col-12 p-0 text-right">
                            <input type="submit" value="{{__('Submit')}}" id="dept_submit" class="btn-create badge-blue">
                            <input type="button" value="{{__('Back')}}" class="btn-create bg-gray back" data-dismiss="modal">
                        </div>
                </div>
            </div>
        </div>
    </form>
@endsection
