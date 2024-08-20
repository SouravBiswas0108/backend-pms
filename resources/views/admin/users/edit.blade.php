<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
    @csrf
    @method('PUT')

    <!-- Example form fields -->
    <div class="row">
        <div class="col-6 form-group">
            <label class="form-control-label" for="emp_id">{{ __('IPPIS Number') }}</label>
            <input type="number" class="form-control emp_id_text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)"
                id="ippis_no" name="ippis_no" value="{{$user->ippis_no}}" />
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
            <input type="text" class="form-control" id="staff_id" name="staff_id" value="{{ $user->staff_id}}"
                readonly="readonly" />
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="fname">{{ __('First Name') }}</label>
            <input type="text" class="form-control" id="fname" name="fname" value="{{$user->F_name}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="mid_name">{{ __('Middle Name') }}</label>
            <input type="text" class="form-control" id="mid_name" name="mid_name" value="{{$user->M_name}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="lname">{{ __('Last Name') }}</label>
            <input type="text" class="form-control" id="lname" name="lname" value="{{$user->L_name}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="email">{{ __('E-Mail Address') }}</label>
            <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="phone">{{ __('Phone Number') }}</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="job_title">{{ __('Job Title') }}</label>
            <input type="text" class="form-control" id="job_title" name="job_title"
                value="{{$user->userDetails->job_title}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="designation">{{ __('Designation') }}</label>
            <input type="text" class="form-control" id="designation" name="designation"
                value="{{$user->userDetails->designation}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="cadre">{{ __('Cadre') }}</label>
            <input type="text" class="form-control" id="cadre" name="cadre" value="{{$user->userDetails->cadre}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group" id='datetimepicker1'>
            <label class="form-control-label" for="date_of_current_posting">{{ __('Date of Current Posting') }}</label>
            <input type="date" class="form-control" id="date_of_current_posting" name="date_of_current_posting"
                value="{{$user->userDetails->date_of_current_posting}}" max="{{date('Y-m-d')}}">
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group" id='datetimepicker1'>
            <label class="form-control-label" for="date_of_MDA_posting">{{ __('Date of MDA Posting') }}</label>
            <input type="date" class="form-control" id="date_of_MDA_posting" name="date_of_MDA_posting"
                value="{{$user->userDetails->date_of_MDA_posting}}">
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group" id='datetimepicker1'>
            <label class="form-control-label" for="date_of_last_promotion">{{ __('Date of last Promotion') }}</label>
            <input type="date" class="form-control" id="date_of_last_promotion" name="date_of_last_promotion"
                value="{{$user->userDetails->date_of_last_promotion}}">
            <span class="error" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
            <select name="gender" class="form-control select2" id="gender">
                <option value="">{{__('Select Gender')}}</option>
                <option value="male" @if ($user->userDetails->gender == 'male') selected="selected" @endif>Male
                </option>
                <option value="female" @if ($user->userDetails->gender == 'female') selected="selected" @endif>
                    Female</option>
                <option value="others" @if ($user->userDetails->gender == 'others') selected="selected" @endif>
                    Others</option>
            </select>
            <span class="errorgender" style="color:red"></span>
        </div>

        <div class="col-6 form-group">
            <label class="form-control-label" for="grade_level">{{ __('Grade Level') }}</label>
            <select name="grade_level" class="form-control select2" id="grade_level" required>
                <option value="">{{__('Select Grade Level')}}</option>
                <option value="1" @if ($user->userDetails->grade_level == '1') selected="selected" @endif>1
                </option>
                <option value="2" @if ($user->userDetails->grade_level == '2') selected="selected" @endif>2
                </option>
                <option value="3" @if ($user->userDetails->grade_level == '3') selected="selected" @endif>3
                </option>
                <option value="4" @if ($user->userDetails->grade_level == '4') selected="selected" @endif>4
                </option>
                <option value="5" @if ($user->userDetails->grade_level == '5') selected="selected" @endif>5
                </option>
                <option value="6" @if ($user->userDetails->grade_level == '6') selected="selected" @endif>6
                </option>
                <option value="7" @if ($user->userDetails->grade_level == '7') selected="selected" @endif>7
                </option>
                <option value="8" @if ($user->userDetails->grade_level == '8') selected="selected" @endif>8
                </option>
                <option value="9" @if ($user->userDetails->grade_level == '9') selected="selected" @endif>9
                </option>
                <option value="10" @if ($user->userDetails->grade_level == '10') selected="selected" @endif>10
                </option>
                <option value="11" @if ($user->userDetails->grade_level == '11') selected="selected" @endif>11
                </option>
                <option value="12" @if ($user->userDetails->grade_level == '12') selected="selected" @endif>12
                </option>
                <option value="13" @if ($user->userDetails->grade_level == '13') selected="selected" @endif>13
                </option>
                <option value="14" @if ($user->userDetails->grade_level == '14') selected="selected" @endif>14
                </option>
                <option value="15" @if ($user->userDetails->grade_level == '15') selected="selected" @endif>15
                </option>
                <option value="16" @if ($user->userDetails->grade_level == '16') selected="selected" @endif>16
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
                value="{{$user->userDetails->recovery_email}}" />
            <span class="error" style="color:red"></span>
        </div>

        <div class="form-group col-12 text-right">
            <input type="submit" id="save_user" value="{{__('Update User')}}" class="btn-create badge-blue"
                style="padding: 10px 20px; font-size: 16px; background-color: blue; color: white; border: none; cursor: pointer;">

            <input type="button" value="Cancel" class="btn-create bg-gray"
                style="padding: 10px 20px; font-size: 16px; background-color: gray; color: white; border: none; cursor: pointer;"
                data-dismiss="modal">
        </div>
    </div>
</form>