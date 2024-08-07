@extends('admin.layouts.admin')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

@section('title')
    {{ __('Manage Users') }}
@endsection

@section('action-button')
  @if(Session::has('import_errors'))
            <div class="col align-self-center alert alert-danger alert-dismissible fade show" role="alert">
               <h3 class="alert-heading">Errors on Rows while importing:</h3>

               <ul>
                  @foreach (Session::get('import_errors') as $failure)

                  {{-- <script>show_toastr('Error', '{!! $failure->row()-1; !!}', 'error')</script> --}}

                          <li><p>{{ "ON SERIAL NO. " }} &nbsp; {{$failure->row()-1}} &nbsp; {{ $failure->errors()[0] }} </P></li>
                          {{-- <li>{{ $failure->attribute(); }}</li>
                         <li>{{$failure->errors()[0]; }}</li>
                         <li>{{ $failure->values(); }}</li> --}}

                  @endforeach
               </ul>
               <strong>REST OF USER DATA IMPORTED SUCSESFULLY!!!</strong>
               <button type="button" class="close" style="font-size: 2.25rem;" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
         @endif
    <div class="all-button-box row d-flex justify-content-end">
      
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create User')}}" data-url="{{route('admin.usersCreate')}}">
                    <i class="fas fa-plus"></i> {{__('Add')}}
                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"  data-url="{{route('admin.dashboard')}}">
                    <i class="fas fa-plus"></i> {{__('bulk create')}}
                </a>
            </div>
       
    </div>
    <div class="modal fade" id="csvdata" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <h4 class="h4 font-weight-400 float-left modal-title">List of Users</h4>
                    <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close">{{__('Close')}}</a>
                </div>
                <form action="{{ route('admin.dashboard') }}" method="POST" id="csv_form_id_new" enctype="multipart/form-data">
                    <input type="hidden" name="json_allrows" id="" class="json_allrows" value=''>
                    <div class="modal-body">

                        <div class="card bg-none card-box">
                            <div style="overflow-x: auto;">
                            <table id="tablerow">
                                <thead>
                                    <th align="center" class="">
                                        <input type="checkbox" name="checkall" id="select_all_user" />
                                    </th>
                                    <th>IPPIS Number</th>
                                    <th>Staff Id</th>
                                    <th>First Name</th>
                                    <th>Last name</th>
                                    <th>E-Mail Address</th>
                                    <th>Password</th>
                                    <th>Organization</th>
                                    <th>Gender</th>
                                    <th>Date of Current Posting</th>
                                    <th>Role</th>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                            </div>

                            <div class="form-group col-12 text-right pb-3">
                                <input type="submit" value="{{__('Create')}}" id="create_bulkuser_btn" class="btn-create badge-blue">
                            </div>
                        </div>
                    </div>
                </form>
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
                        <table class=" users_dataTablexxx">
                            <thead>
                            <tr>
                                <th>{{__('Id')}}</th>
                                <th>{{__('IPPIS Number')}}</th>
                                <th>{{__('User Id')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Activity')}}</th>z
                                <th>{{__('type')}}</th>
                                <th>{{__('Action')}}</th>
                            </tr>
                            </thead>
                              

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

