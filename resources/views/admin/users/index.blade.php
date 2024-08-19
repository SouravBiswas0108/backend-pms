@extends('admin.layouts.admin')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    h2 {
        color: #343a40;
        text-align: center;
    }

    .table {
        background-color: #fff;
        margin-bottom: 0;
        /* Remove margin below the table to align with pagination */
    }

    .table-hover tbody tr:hover {
        background-color: #e9ecef;
        /* Slightly lighter hover effect for better contrast */
    }

    .table-hover tbody tr {
        color: #343a40;
        /* Ensure table rows have dark text color for readability */
    }

    .table-dark th {
        background-color: #343a40;
        /* Dark background */
        color: #ffffff;
        /* White text color */
        font-weight: bold;
        /* Make the text bold */
        font-size: 16px;
        /* Increase the font size */
        text-align: center;
        /* Center align text */
        vertical-align: middle;
        /* Vertically align text */
        border: 2px solid #dee2e6;
        /* Add thicker border to make the header stand out */
        padding: 10px;
        /* Add padding for better spacing */
    }

    .pagination-container {
        margin-top: 20px;
    }

    .pagination .page-item.active .page-link {
        background-color: #343a40;
        border-color: #343a40;
    }

    .pagination .page-link {
        color: #343a40;
    }

    .table .action-icons i {
        cursor: pointer;
        margin: 0 5px;
        color: #343a40;
        /* Dark color for action icons */
    }

    .table .action-icons i:hover {
        color: #007bff;
        /* Change color on hover */
    }
</style>

@section('title')
{{ __('Manage Users') }}
@endsection

@section('action-button')
@if(Session::has('import_errors'))
    <div class="col align-self-center alert alert-danger alert-dismissible fade show" role="alert">
        <h3 class="alert-heading">Errors on Rows while importing:</h3>
        <ul>
            @foreach (Session::get('import_errors') as $failure)
                <li>
                    <p>{{ "ON SERIAL NO. " }} &nbsp; {{$failure->row() - 1}} &nbsp; {{ $failure->errors()[0] }} </p>
                </li>
            @endforeach
        </ul>
        <strong>REST OF USER DATA IMPORTED SUCCESSFULLY!!!</strong>
        <button type="button" class="close" style="font-size: 2.25rem;" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="all-button-box row d-flex justify-content-end">
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-toggle="modal"
            data-target="#createUserModal">
            <i class="fas fa-plus"></i> {{__('Add')}}
        </a>
    </div>
    <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
        <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"
            data-url="{{route('admin.dashboard')}}">
            <i class="fas fa-plus"></i> {{__('Bulk Create')}}
        </a>
    </div>
</div>
<!-- Modal for creating user -->
<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{__('Create User')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card bg-none card-box">
                    <form class="pl-3 pr-3" id="create_user_form" method="POST"
                        action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="emp_id">{{ __('IPPIS Number') }}</label>
                                <input type="number" class="form-control emp_id_text"
                                    onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" id="ippis_no" name="ippis_no"
                                    value="{{old('ippis_no')}}" />
                                <span class="error" style="color:red"></span>
                            </div>
                            <div class="col-6 form-group">
                                @php
                                    $randomString = "STAFF";
                                    for ($i = 0; $i < 6; $i++) {
                                        if ($i < 6) {
                                            $randomString .= rand(0, 9);
                                        }
                                        if ($i == 8) {
                                            //$randomString.=chr(rand(65,90));
                                        }
                                    }
                                @endphp
                                <label class="form-control-label" for="staff_id">{{ __('Staff Id') }}</label>
                                <input type="text" class="form-control" id="staff_id" name="staff_id"
                                    value="{{ $randomString }}" readonly="readonly" />
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="fname">{{ __('First Name') }}</label>
                                <input type="text" class="form-control" id="fname" name="fname"
                                    value="{{old('fname')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="mid_name">{{ __('Middle Name') }}</label>
                                <input type="text" class="form-control" id="mid_name" name="mid_name"
                                    value="{{old('mid_name')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="lname">{{ __('Last Name') }}</label>
                                <input type="text" class="form-control" id="lname" name="lname"
                                    value="{{old('lname')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="email">{{ __('E-Mail Address') }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{old('email')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="phone">{{ __('Phone Number') }}</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    value="{{old('phone')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="password">{{ __('Password') }}</label>
                                <input type="text" class="form-control" id="password" name="password"
                                    value="{{old('password')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="job_title">{{ __('Job Title') }}</label>
                                <input type="text" class="form-control" id="job_title" name="job_title"
                                    value="{{old('job_title')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="designation">{{ __('Designation') }}</label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                    value="{{old('designation')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="cadre">{{ __('Cadre') }}</label>
                                <input type="text" class="form-control" id="cadre" name="cadre"
                                    value="{{old('cadre')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group" id='datetimepicker1'>
                                <label class="form-control-label"
                                    for="date_of_current_posting">{{ __('Date of Current Posting') }}</label>
                                <input type="date" class="form-control" id="date_of_current_posting"
                                    name="date_of_current_posting" value="{{old('date_of_current_posting')}}"
                                    max="{{date('Y-m-d')}}">
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group" id='datetimepicker1'>
                                <label class="form-control-label"
                                    for="date_of_MDA_posting">{{ __('Date of MDA Posting') }}</label>
                                <input type="date" class="form-control" id="date_of_MDA_posting"
                                    name="date_of_MDA_posting" value="{{old('date_of_MDA_posting')}}">
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group" id='datetimepicker1'>
                                <label class="form-control-label"
                                    for="date_of_last_promotion">{{ __('Date of last Promotion') }}</label>
                                <input type="date" class="form-control" id="date_of_last_promotion"
                                    name="date_of_last_promotion" value="{{old('date_of_last_promotion')}}">
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                                <select name="gender" class="form-control select2" id="gender">
                                    <option value="">{{__('Select Gender')}}</option>
                                    <option value="male" @if (old('gender') == 'male') selected="selected" @endif>Male
                                    </option>
                                    <option value="female" @if (old('gender') == 'female') selected="selected" @endif>
                                        Female</option>
                                    <option value="others" @if (old('gender') == 'others') selected="selected" @endif>
                                        Others</option>
                                </select>
                                <span class="errorgender" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="grade_level">{{ __('Grade Level') }}</label>
                                <select name="grade_level" class="form-control select2" id="grade_level" required>
                                    <option value="">{{__('Select Grade Level')}}</option>
                                    <option value="1" @if (old('grade_level') == '1') selected="selected" @endif>1
                                    </option>
                                    <option value="2" @if (old('grade_level') == '2') selected="selected" @endif>2
                                    </option>
                                    <option value="3" @if (old('grade_level') == '3') selected="selected" @endif>3
                                    </option>
                                    <option value="4" @if (old('grade_level') == '4') selected="selected" @endif>4
                                    </option>
                                    <option value="5" @if (old('grade_level') == '5') selected="selected" @endif>5
                                    </option>
                                    <option value="6" @if (old('grade_level') == '6') selected="selected" @endif>6
                                    </option>
                                    <option value="7" @if (old('grade_level') == '7') selected="selected" @endif>7
                                    </option>
                                    <option value="8" @if (old('grade_level') == '8') selected="selected" @endif>8
                                    </option>
                                    <option value="9" @if (old('grade_level') == '9') selected="selected" @endif>9
                                    </option>
                                    <option value="10" @if (old('grade_level') == '10') selected="selected" @endif>10
                                    </option>
                                    <option value="11" @if (old('grade_level') == '11') selected="selected" @endif>11
                                    </option>
                                    <option value="12" @if (old('grade_level') == '12') selected="selected" @endif>12
                                    </option>
                                    <option value="13" @if (old('grade_level') == '13') selected="selected" @endif>13
                                    </option>
                                    <option value="14" @if (old('grade_level') == '14') selected="selected" @endif>14
                                    </option>
                                    <option value="15" @if (old('grade_level') == '15') selected="selected" @endif>15
                                    </option>
                                    <option value="16" @if (old('grade_level') == '16') selected="selected" @endif>16
                                    </option>
                                </select>
                                <span class="errorgrade_level" style="color:red"></span>
                            </div>

                            <div class="col-6 form-group">
                                <label class="form-control-label" for="organization">{{ __('Organization') }}</label>
                                <select name="organization" class="form-control select2" id="organization" required>
                                    <option value="">{{__('Select Organization')}}</option>
                                    <option value="Federal Ministry of Education" selected>
                                        {{ __('Federal Ministry of Education') }}
                                    </option>
                                </select>
                                <span class="errororganization" style="color:red"></span>
                            </div>


                            <div class="col-6 form-group">
                                <label class="form-control-label" for="role">{{ __('Role') }}</label>
                                <select name="role" class="form-control select2" id="role" required>
                                    <option value="">{{__('Select Role')}}</option>
                                    <option value="user" selected>{{ __('User') }}</option>
                                    <option value="admin">{{ __('Admin') }}</option>
                                </select>
                                <span class="errorrole" style="color:red"></span>
                            </div>




                            <div class="col-6 form-group">
                                <label class="form-control-label" for="email">{{ __('Recovery Email') }}</label>
                                <input type="email" class="form-control" id="email" name="recovery_email"
                                    value="{{old('recovery_email')}}" />
                                <span class="error" style="color:red"></span>
                            </div>

                            <div class="form-group col-12 text-right">
                                <input type="submit" id="save_user" value="{{__('Create User')}}"
                                    class="btn-create badge-blue"
                                    style="padding: 10px 20px; font-size: 16px; background-color: blue; color: white; border: none; cursor: pointer;">

                                <input type="button" value="Cancel" class="btn-create bg-gray"
                                    style="padding: 10px 20px; font-size: 16px; background-color: gray; color: white; border: none; cursor: pointer;"
                                    data-dismiss="modal">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="container mt-5">
                    <h2 class="mb-4">User Data</h2>
                    <div class="input-group mb-3">
                        <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th><b>Id</b></th>
                                    <th><b>IPPIS Number</b></th>
                                    <th><b>User Id</b></th>
                                    <th><b>Name</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Activity</b></th>
                                    <th><b>Type</b></th>
                                    <th><b>Action</b></th>
                                </tr>
                            </thead>
                            <tbody id="datatable">
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$user->ippis_no}}</td>
                                        <td>{{$user->staff_id}}</td>
                                        <td>
                                            {{ $user->F_name }}
                                            @if($user->M_name)
                                                {{ $user->M_name }}
                                            @endif
                                            @if($user->L_name)
                                                {{ $user->L_name }}
                                            @endif
                                        </td>
                                        <td>{{$user->email}}</td>
                                        <td>Active</td>
                                        <td>{{$user->userDetails->type}}</td>
                                        <td class="action-icons">
                                            <span>
                                                <a href="{{ route('admin.users.show', ['user' => strtr(base64_encode($user->id), '+/=', '-_A')]) }}"
                                                    class="edit-icon bg-warning">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="edit-icon" data-url="{{route('admin.users.edit',['user' => strtr(base64_encode($user->id), '+/=', '-_A')])}}" data-ajax-popup="true" data-title="{{__('Edit User')}}">
                                                <i class="fas fa-pencil-alt"></i></a>
                                                <form id="delete-form-{{ $user->id }}" method="POST"
                                                    action="{{ route('admin.users.destroy', $user->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#"
                                                        onclick="event.preventDefault(); confirmDelete({{ $user->id }});"
                                                        class="delete-icon">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </form>



                                            </span>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container d-flex justify-content-end">
                        <ul id="pagination" class="pagination">
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


<!-- Edit User Modal -->

<!-- end edit user -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('#datatable tr');

        function filterRows(query) {
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                const match = text.includes(query.toLowerCase());
                row.style.display = match ? '' : 'none';
            });
        }

        document.getElementById('searchInput').addEventListener('input', function () {
            const query = this.value;
            filterRows(query);
        });
    });

    function confirmDelete(userId) {
        if (confirm('{{ __('Are You Sure?') }} | {{ __('This action cannot be undone. Do you want to continue?') }}')) {
            document.getElementById('delete-form-' + userId).submit();
        }
    }



//edit user

$(document).on('click', '.edit-icon', function() {
    var url = $(this).data('url');
    var title = $(this).data('title');

    // Set the modal title
    $('#editUserModalLabel').text(title);

    // Load the form via AJAX
    $.ajax({
        url: url,
        method: 'GET',
        success: function(data) {
            // Inject the form content into the modal body
            $('#editUserModal .modal-body').html(data);
            // Open the modal
            $('#editUserModal').modal('show');
        },
        error: function(xhr) {
            alert('An error occurred while loading the form.');
        }
    });
});
</script>