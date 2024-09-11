@extends('admin.layouts.admin')

@section('title')
{{__('MPMS')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('/assets/libs/summernote/summernote-bs4.css')}}">
@endpush

@push('script')
    <script src="{{asset('/assets/libs/summernote/summernote-bs4.js')}}"></script>
@endpush

@section('content')

@if (isset($flag) && $flag == 1)


    <form id="form1" method="post" action="{{route('admin.mpms.store')}}">
        @csrf
        <div class="row step_1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-0">
                            <input type="hidden" name="kra_id" value="{{$data[0]['kra_id']}}">
                            <div class="col-8 form-group">
                                <label class="form-control-label" for="form_name">{{ __('Form Name') }}</label>
                                <select name="form_name" id="form_name" class="form-control select2" required>
                                    <option value="1" {{ $data[0]['mpms_tables_id'] == 1 ? 'selected' : '' }}>Presidential
                                        Priorities</option>
                                    <option value="2" {{ $data[0]['mpms_tables_id'] == 2 ? 'selected' : '' }}>MDA Operational
                                        Objectives</option>
                                    <option value="3" {{ $data[0]['mpms_tables_id'] == 3 ? 'selected' : '' }}>Service-Wide
                                        KRAs
                                    </option>
                                </select>
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="kra_title">{{ __('Key Result Areas') }}</label>
                                <input type="text" class="form-control" id="kra_title" name="kra_title"
                                    value="{{$data[0]['kra_title']}}">
                                <br>
                                @error('kra_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="kra_weight">{{ __('Weight for KRA') }}</label>
                                <input type="number" class="form-control" id="kra_weight" name="kra_weight"
                                    value="{{ $data[0]['kra_weight'] }}">
                                <br>
                                @error('kra_weight')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12 p-0 text-right">
                                <input type="submit" value="{{__('Save & Next')}}" class="btn-create badge-blue next">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@else
    <form id="form1" method="post" action="{{route('admin.mpms.store')}}">
        @csrf
        <div class="row step_1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-0">

                            <div class="col-8 form-group">
                                <label class="form-control-label" for="form_name">{{ __('Form Name') }}</label>
                                <select name="form_name" id="form_name" class="form-control select2" required>
                                    <option value="1" selected>Presidential Priorities</option>
                                    <option value="2">MDA Operational Objectives</option>
                                    <option value="3">Service-Wide KRAs</option>
                                </select>
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="kra_title">{{ __('Key Result Areas') }}</label>
                                <input type="text" class="form-control" id="kra_title" name="kra_title"
                                    value="{{ old('kra_title') }}">
                                <br>
                                @error('kra_title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="kra_weight">{{ __('Weight for KRA') }}</label>
                                <input type="number" class="form-control" id="kra_weight" name="kra_weight"
                                    value="{{ old('kra_weight') }}">
                                <br>
                                @error('kra_weight')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-12 p-0 text-right">
                                <input type="submit" value="{{__('Save & Next')}}" class="btn-create badge-blue next">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif
@endsection