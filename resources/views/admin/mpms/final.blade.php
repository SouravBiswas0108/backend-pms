@extends('admin.layouts.admin')

@section('title')
    {{__('MPMS')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('/assets/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('script')
    <script src="{{asset('/assets/libs/summernote/summernote-bs4.js')}}"></script>
    <script>
        function addObj() {
            index = parseInt($("input[name='count_card']").val());

            var newRow = '<div class="card"> <div class="card-body"> <div class="row p-0"> <div class="col-6 form-group"> <label class="form-control-label">Objective</label> <input type="text" class="form-mpms" id="obj_title" name="objactives['+index+'][obj_title]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Weight</label> <input type="number" class="form-mpms" id="obj_weight" name="objactives['+index+'][obj_weight]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Initiative</label> <input type="text" class="form-mpms" id="initiative" name="objactives['+index+'][initiative]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">KPI</label> <input type="text" class="form-mpms" id="kpi" name="objactives['+index+'][kpi]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Target</label> <input type="number" class="form-mpms" id="target" name="objactives['+index+'][target]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Responsible</label> <input type="text" class="form-mpms" id="responsible" name="objactives['+index+'][responsible]" value=""> </div> </div> </div> </div>';
            $("#appendDiv").append(newRow);

            index=++index;
            $("input[name='count_card']").val(index);
        }
    </script>
@endpush

@if($status == 'update' )
    @section('content')   
        <form method="post" action="{{ route('admin.mpms.finalStore') }}" id="finalForm"> 
            @csrf
            <div>
                <p class="add-obj-button" onclick="addObj()">Add Objectives</p>
            </div>
            <div class="row step_1">
                <div class="col-md-12" id="appendDiv">
                    <div>
                        <input type="hidden" name="kra_id" value="{{$id}}">
                        <input type="hidden" name="mpms_id" value="{{$mpms_id}}">
                    </div>
                    <input type="hidden" id="count" name="count_card" value="{{count($data)}}">
                    <input type="hidden" name="flag" value="edit">
                    @foreach ($data as $key => $value)
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-0">
                                    <input type="hidden" id="obj_id" name="objactives[{{$key}}][id]" value="{{$value['id']}}">
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="obj_title">{{ __('Objective') }}</label>
                                        <input type="text" class="form-mpms" id="obj_title" name="objactives[{{$key}}][obj_title]" value="{{ $value['obj_title'] }}">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="obj_weight">{{ __('Weight') }}</label>
                                        <input type="number" class="form-mpms" id="obj_weight" name="objactives[{{$key}}][obj_weight]" value="{{ $value['obj_weight'] }}">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="initiative">{{ __('Initiative') }}</label>
                                        <input type="text" class="form-mpms" id="initiative" name="objactives[{{$key}}][initiative]" value="{{ $value['Initiative'] }}">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="kpi">{{ __('KPI') }}</label>
                                        <input type="text" class="form-mpms" id="kpi" name="objactives[{{$key}}][kpi]" value="{{ $value['kpi'] }}">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="target">{{ __('Target') }}</label>
                                        <input type="number" class="form-mpms" id="target" name="objactives[{{$key}}][target]" value="{{ $value['target'] }}">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="responsible">{{ __('Responsible') }}</label>
                                        <input type="text" class="form-mpms" id="responsible" name="objactives[{{$key}}][responsible]" value="{{ $value['Responsible'] }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="form-group col-12 p-0 text-right">
                    <button class="btn-create badge-blue">Submit</button>
                </div>
            </div>
        </form>
    @endsection 
@else
    @section('content')   
        <form method="post" action="{{route('admin.mpms.finalStore')}}" id="finalForm">
            @csrf
            <div>
                <p class="add-obj-button" onclick="addObj()">Add Objectives</p>
            </div>
            <div class="row step_1">
                <div class="col-md-12" id="appendDiv">
                    <div>
                        <input type="hidden" name="kra_id" value="{{$id}}">
                        <input type="hidden" name="mpms_id" value="{{$mpms_id}}">
                    </div>
                    <input type="hidden" id="count" name="count_card" value="1">
                    <input type="hidden" name="flag" value="create">
                    <div class="card">
                        <div class="card-body">
                            <div class="row p-0">
                                <div class="col-6 form-group">
                                    <label class="form-control-label">{{ __('Objective') }}</label>
                                    <input type="text" class="form-mpms" id="obj_title" name="objactives[0][obj_title]" value="{{ old('objactives[0][obj_title]') }}">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label">{{ __('Weight') }}</label>
                                    <input type="number" class="form-mpms" id="obj_weight" name="objactives[0][obj_weight]" value="{{ old('objactives[0][obj_weight]') }}">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label">{{ __('Initiative') }}</label>
                                    <input type="text" class="form-mpms" id="initiative" name="objactives[0][initiative]" value="{{ old('objactives[0][initiative]') }}">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label">{{ __('KPI') }}</label>
                                    <input type="text" class="form-mpms" id="kpi" name="objactives[0][kpi]" value="{{ old('objactives[0][kpi]') }}">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label">{{ __('Target') }}</label>
                                    <input type="number" class="form-mpms" id="target" name="objactives[0][target]" value="{{ old('objactives[0][target]') }}">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label">{{ __('Responsible') }}</label>
                                    <input type="text" class="form-mpms" id="responsible" name="objactives[0][responsible]" value="{{ old('objactives[0][responsible]') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 p-0 text-right">
                    <button type="submit" class="btn-create badge-blue" id="finalFormSubBtn">Submit</button>
                </div>
            </div>
        </form>
    @endsection
@endif

