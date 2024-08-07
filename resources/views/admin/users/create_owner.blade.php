<div class="card bg-none card-box">
    <form class="pl-3 pr-3" id="create_user_form" >
        @csrf
        <div class="row">
            <div class="col-6 form-group">
                <label class="form-control-label" for="emp_id">{{ __('IPPIS Number') }}</label>
                <input type="number" class="form-control emp_id_text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" id="ippis_no" name="ippis_no" value="{{old('ippis_no')}}" />

                    <span class="error" style="color:red"></span>
            </div>
            <div class="col-6 form-group">
                @php
                    $randomString = "STAFF";
                    for ($i = 0; $i < 6; $i++) {
                        if ($i < 6) {
                        $randomString.=rand(0,9);
                        }
                        if ($i == 8) {
                        //$randomString.=chr(rand(65,90));
                        }
                    }
                @endphp
                <label class="form-control-label" for="staff_id">{{ __('Staff Id') }}</label>
                <input type="text" class="form-control" id="staff_id" name="staff_id" value="{{ $randomString }}" readonly="readonly" />
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="fname">{{ __('First Name') }}</label>
                <input type="text" class="form-control" id="fname" name="fname" value="{{old('fname')}}" />
                    <span class="error" style="color:red"></span>
            </div>


            <div class="col-6 form-group">
                <label class="form-control-label" for="mid_name">{{ __('Middle Name') }}</label>
                <input type="text" class="form-control" id="mid_name" name="mid_name" value="{{old('mid_name')}}"/>

                <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="lname">{{ __('Last Name') }}</label>
                <input type="text" class="form-control" id="lname" name="lname" value="{{old('lname')}}" />
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="email">{{ __('E-Mail Address') }}</label>
                <input type="email" class="form-control" id="email" name="email"  value="{{old('email')}}" />

                    <span class="error" style="color:red"></span>

            </div>
            <div class="col-6 form-group">
                <label class="form-control-label" for="phone">{{ __('Phone Number') }}</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone')}}" />
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="password">{{ __('Password') }}</label>
                <input type="text" class="form-control" id="password" name="password" value="{{old('password')}}" />
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="job_title">{{ __('Job Title') }}</label>
                <input type="text" class="form-control" id="job_title" name="job_title" value="{{old('job_title')}}" />
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="designation">{{ __('Designation') }}</label>
                <input type="text" class="form-control" id="designation" name="designation" value="{{old('designation')}}" />
                    <span class="error" style="color:red"></span>
            </div>


            <div class="col-6 form-group">
                <label class="form-control-label" for="cadre">{{ __('Cadre') }}</label>
                <input type="text" class="form-control" id="cadre" name="cadre" value="{{old('cadre')}}" />
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group" id='datetimepicker1'>
                <label class="form-control-label" for="date_of_current_posting">{{ __('Date of Current Posting') }}</label>
                <input type="date" class="form-control" id="date_of_current_posting" name="date_of_current_posting" value="{{old('date_of_current_posting')}}" max="{{date('Y-m-d')}}">
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group" id='datetimepicker1'>
                <label class="form-control-label" for="date_of_MDA_posting">{{ __('Date of MDA Posting') }}</label>
                <input type="date" class="form-control" id="date_of_MDA_posting" name="date_of_MDA_posting" value="{{old('date_of_MDA_posting')}}">
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group" id='datetimepicker1'>
                <label class="form-control-label" for="date_of_last_promotion">{{ __('Date of last Promotion') }}</label>
                <input type="date" class="form-control" id="date_of_last_promotion" name="date_of_last_promotion" value="{{old('date_of_last_promotion')}}">
                    <span class="error" style="color:red"></span>
            </div>


            <div class="col-6 form-group">
                <label class="form-control-label" for="gender">{{ __('Gender') }}</label>
                <select name="gender" class="form-control select2"  id="gender">
                    <option value="">{{__('Select Gender')}}</option>
                    <option value="male" @if (old('gender') == 'male')
                                            selected="selected"
                                            @endif>Male</option>
                    <option value="female" @if (old('gender') == 'female')
                                            selected="selected"
                                            @endif>Female</option>
                    <option value="others" @if (old('gender') == 'others')
                                            selected="selected"
                                            @endif>Others</option>
                </select>
                    <span class="errorgender" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="grade_level">{{ __('Grade Level') }}</label>
                <select name="grade_level" class="form-control select2"  id="grade_level" required>
                    <option value="">{{__('Select Grade Level')}}</option>
                    <option value="1" @if (old('grade_level') == '1')
                                            selected="selected"
                                            @endif>1</option>
                    <option value="2" @if (old('grade_level') == '2')
                                            selected="selected"
                                            @endif>2</option>
                    <option value="3" @if (old('grade_level') == '3')
                                            selected="selected"
                                            @endif>3</option>
                    <option value="4" @if (old('grade_level') == '4')
                                            selected="selected"
                                            @endif>4</option>
                    <option value="5" @if (old('grade_level') == '5')
                                            selected="selected"
                                            @endif>5</option>
                    <option value="6" @if (old('grade_level') == '6')
                                            selected="selected"
                                            @endif>6</option>
                    <option value="7" @if (old('grade_level') == '7')
                                            selected="selected"
                                            @endif>7</option>
                    <option value="8" @if (old('grade_level') == '8')
                                            selected="selected"
                                            @endif>8</option>
                    <option value="9" @if (old('grade_level') == '9')
                                            selected="selected"
                                            @endif>9</option>
                    <option value="10" @if (old('grade_level') == '10')
                                            selected="selected"
                                            @endif>10</option>
                    <option value="11" @if (old('grade_level') == '11')
                                            selected="selected"
                                            @endif>11</option>
                    <option value="12" @if (old('grade_level') == '12')
                                            selected="selected"
                                            @endif>12</option>
                    <option value="13" @if (old('grade_level') == '13')
                                            selected="selected"
                                            @endif>13</option>
                    <option value="14" @if (old('grade_level') == '14')
                                            selected="selected"
                                            @endif>14</option>
                    <option value="15" @if (old('grade_level') == '15')
                                            selected="selected"
                                            @endif>15</option>
                    <option value="16" @if (old('grade_level') == '16')
                                            selected="selected"
                                            @endif>16</option>
                    <option value="17" @if (old('grade_level') == '17')
                                            selected="selected"
                                            @endif>17</option>
                <option value="Cons" @if (old('grade_level') == 'Cons')
                                            selected="selected"
                                            @endif>Cons</option>

                </select>
                    <span class="error_grade" style="color:red"></span>
            </div>

            @if($user->type == 'Admin')
                <div class="col-6 form-group">
                    <label class="form-control-label" for="organization">{{ __('Organization') }}</label>
                    <select name="org_code" class="form-control select2"  id="organization">
                        <!-- <option value="">{{__('Select Organization')}}</option> -->
                            <option value="{{$organization[0]['org_code']}}" selected >{{$organization[0]['org_name']}}</option>
                    </select>
                        <span class="error_org_name" style="color:red"></span>
                </div>
            @else
                <div class="col-6 form-group">
                    <label class="form-control-label" for="organization">{{ __('Organization') }}</label>
                    <select name="org_code" class="form-control select2"  id="organization">
                        <!-- <option value="">{{__('Select Organization')}}</option> -->
                        @foreach($organization as $org)
                            <option value="{{$org->org_code}}" @if ($org->org_code == old('org_code'))
                                            selected="selected"
                                            @endif>{{$org->org_name}}</option>
                        @endforeach
                    </select>
                        <span class="error_org_name" style="color:red"></span>
                </div>
            @endif


            <div class="col-6 form-group">
                <label class="form-control-label" for="role">{{ __('Role') }}</label>
                <select name="role" class="form-control select2 role" id="role_selecter">
                    <option value="">{{__('Select Role')}}</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" @if ($role->id == old('role'))selected="selected" @endif>{{$role->name}}
                        </option>
                    @endforeach
                </select>
                <span class="error_role" style="color:red"></span>
            </div>
            <div class="col-6 form-group">
                <label class="form-control-label" for="email">{{ __('Recovery Email') }}</label>
                <input type="email" class="form-control" id="recovery_email" name="recovery_email"  value="{{old('recovery_email')}}" />
                <span class="error_recovery_email" style="color:red"></span>
            </div>

            <div class="col-12 form-group menu" style="display: none;">
                <label class="form-control-label" for="gender">{{ __('Dashboard Menu') }}</label><br>

                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="total_user" style="margin: 0 !important;">
                    <label for="total_user" style="margin: auto 12px;"> Total User</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="total_dept" style="margin: 0 !important;">
                    <label for="total_department" style="margin: auto 12px;"> Total Department</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="rating_by_grade_level" style="margin: 0 !important;">
                    <label for="rating_by_grade_level" style="margin: auto 12px;"> Employee Performance Rating By Grade Level</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="rating_score_by_department" style="margin: 0 !important;">
                    <label for="rating_score_by_department" style="margin: auto 12px;"> Employee Performance Rating Score By Department</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="top_30_employees_by_performence_rating" style="margin: 0 !important;">
                    <label for="top_30_employees_by_performence_rating" style="margin: auto 12px;"> Top 30 Employees By Performance Rating</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="bottom_30_employees_by_performence_rating" style="margin: 0 !important;">
                    <label for="bottom_30_employees_by_performence_rating" style="margin: auto 12px;"> Bottom 30 Employees By Performance Rating</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="report_on_overall_training_needs" style="margin: 0 !important;">
                    <label for="report_on_overall_training_needs" style="margin: auto 12px;"> Report On Overall Training Needs</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="report_on_training_needs_by_department" style="margin: 0 !important;">
                    <label for="report_on_training_needs_by_department" style="margin: auto 12px;"> Report On Training Needs By Department</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="report_on_employees_percentage_distribution" style="margin: 0 !important;">
                    <label for="report_on_employees_percentage_distribution" style="margin: auto 12px;"> Report On Employees Percentage Distribution</label>
                </div>

                <!-- <span class="errorgender" style="color:red"></span> -->
            </div>


            <div class="col-12 form-group sidebarmenu" style="display: none;">
                <label class="form-control-label" for="gender">{{ __('Sidebar Menu') }}</label><br>

                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="1" style="margin: 0 !important;">
                    <label for="Users" style="margin: auto 12px;">Users</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="2" style="margin: 0 !important;">
                    <label for="Department" style="margin: auto 12px;">Department</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="3" style="margin: 0 !important;">
                    <label for="Duties" style="margin: auto 12px;">Assign Duties</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="4" style="margin: 0 !important;">
                    <label for="faq" style="margin: auto 12px;">FAQ</label>
                </div>
            </div>




            @include('custom_fields.formBuilder')

            <div class="form-group col-12 text-right">
                <input type="submit" value="{{__('Create')}}" id="create_user_btn" class="btn-create badge-blue">
                <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
    </form>
</div>
