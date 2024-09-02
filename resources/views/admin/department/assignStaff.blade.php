@extends('admin.layouts.admin')

@section('title')
{{__('Assign Staff with Respect to Supervisor ')}}
@endsection

@push('head')
    <link rel="stylesheet" href="{{asset('/public/assets/libs/summernote/summernote-bs4.css')}}">


@endpush

@push('script')
    <script src="{{asset('/public/assets/libs/summernote/summernote-bs4.js')}}"></script>

@endpush


@section('content')
<style>
    .select2-container .select2-search {
        display: block;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default .select2-selection--multiple {
        padding-top: 5px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__rendered li {
        list-style: none;
        height: 28px;
        margin-top: 0px;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        margin: 0 0 2.25rem 0.25rem;

    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form class="pl-3 pr-3" method="post" action="{{route('admin.assignstaffstore')}}">
                    @csrf
                    <div class="row">
                        <div class="col-6 form-group data-row">
                            <label class="form-control-label" for="dept_name">{{ __('Department Name') }}</label>
                            <input type="text" class="form-control dept_name" id="dept_name" name="dept_name" readonly
                                value="{{$department['department_name']}}" required />
                            <input type="hidden" class="form-control" id="dept_id" name="dept_id"
                                value="{{$department['department_id']}}" />
                            <input type="hidden" class="form-control" id="dept_org_code" name="dept_org_code"
                                value="{{$department['org_code']}}" />
                        </div>
                        <div class="col-6 form-group"></div>

                        <div class="col-6 form-group data-row">
                            <label class="form-control-label" for="userlist">{{ __('Choose Supervisor') }}</label>
                            <select id="form-control select2" name="supervisor_name"
                                class="form-control select2 supervisor_name">

                                <option value="" selected>{{__('Select Supervisor')}}</option>
                                @if(isset($data['stafflist']) && !empty($data['stafflist']))
                                    @foreach($data['stafflist'] as $key => $staff)


                                        @if(is_array($supervisor_id))
                                            @foreach ($supervisor_id as $id)
                                                @if($key == $id)
                                                    <option value="{{$key}}">
                                                        {{$staff}}
                                                    </option>
                                                @endif
                                            @endforeach
                                        @else
                                            @if($key == $supervisor_id)
                                                <option value="{{$key}}">
                                                    {{$staff}}
                                                </option>
                                            @endif
                                        @endif

                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-6 form-group">


                        </div>


                        <div class="col-6 form-group data-row scrollbar_set">
                            <label class="form-control-label" for="userlist">{{ __('Assign Staff') }}</label>
                            <select id="Staffs" name="Staffs[]" class="form-control select2" multiple>
                                @if(isset($data['stafflist']) && !empty($data['stafflist']))
                                    @foreach($data['stafflist'] as $key => $staff)

                                        @if(is_array($supervisor_id))
                                            @if(in_array($key, $supervisor_id))

                                            @else

                                                <option value="{{$key}}">{{$staff}}</option>
                                            @endif
                                        @else
                                            @if($key == $supervisor_id)

                                            @else
                                                <option value="{{$key}}">{{$staff}}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            </select>

                        </div>
                        <div class="col-6 form-group"></div>

                        <div class="form-group col-12 text-right">
                            <input type="submit" value="{{__('Done')}}"
                                class="btn-create badge-blue btn btn-xs btn-white btn-icon-only width-auto edit-icon userrole-btn">
                            @if(isset($department['dept_id']))
                                <a href="javascript:void(0)" data-target="#myModal" data-toggle="modal"
                                    class="btn btn-xs btn-white btn-icon-only width-auto edit-icon"
                                    data-title="{{__('Preview')}}" id="edit-item" style="top: 8px;">Preview</a>
                            @endif

                            <!-- <input type="button" value="{{__('cancel')}}" class="btn-create bg-gray" data-dismiss="modal"> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>













<!-- Attachment Modal -->
<div class="modal fade modal_pre" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Preview Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <form id="edit-form" class="form-horizontal" method="POST" action="">
                    <div class="card text-white bg-dark mb-0">
                        <div class="card-header">
                            <h2 class="m-0">Preview</h2>
                        </div>
                        <div class="card-body">
                            <!-- id -->

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Department Name</label>
                                <input type="text" name="modal-dept_name" class="form-control" id="modal-dept_name"
                                    required readonly="readonly">
                            </div>

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Supervisor Name</label>
                                <input type="text" name="modal-supervisor_name" class="form-control"
                                    id="modal-supervisor_name" required readonly="readonly">
                            </div>

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Staffs name</label>
                                <input type="text" name="modal-officer_name" class="form-control"
                                    id="modal-officer_name" required readonly="readonly">
                            </div>

                            <button type="button" class="btn btn-secondary close_new" data-dismiss="modal"
                                style="right: -10px">OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>-->
        </div>
    </div>
</div>

<!-- /Attachment Modal -->

@endsection

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        $('.supervisor_name').on('change', function () {
            var getSupId = $(this).val();
            // alert(getSupId)
            var dept_id = {!! json_encode($department['department_id']) !!};
            if (getSupId) {
                $.ajax({
                    url: '/admin/department/chooseStaff/' + getSupId + '/' + dept_id,
                    type: "GET",
                    data: { "_token": "{{ csrf_token() }}" },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        if (response) {
                            $('#Staffs').empty();
                            $('#Staffs').focus;
                            $.each(response, function (key, value) {

                                if (value.supervisor_id == getSupId) {
                                    let middleName = value.user.M_name ? value.user.M_name : '';
                                    let fullName = value.user.F_name +" "+ middleName +" "+ value.user.L_name ;
                                    $('#Staffs').append('<option  value="' + value.staff_id + '" selected>' + fullName + '</option>');
                                }
                                else {
                                    let middleName = value.user.M_name ? value.user.M_name : '';
                                    let fullName = value.user.F_name +" "+ middleName +" "+ value.user.L_name ;
                                    $('#Staffs').append('<option  value="' + value.staff_id + '">' + fullName + '</option>');
                                }
                            });
                        } else {
                            $('#Staffs').empty();
                        }
                    }
                });
            } else {
                $('#Staffs').empty();
            }
        });
    });
</script>