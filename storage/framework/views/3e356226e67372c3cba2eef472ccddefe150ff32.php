<div class="card bg-none card-box">

    <form class="pl-3 pr-3" id="edit_user_form" >
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-6 form-group">
                <label class="form-control-label" for="emp_id"><?php echo e(__('IPPIS Number')); ?></label>
                <input type="number" class="form-control" id="ippis_no" name="ippis_no" value="<?php echo e($user->ippis_no); ?>" required/>
                <span class="error" style="color:red"></span>

            </div>
            <input type="hidden" name="user_table_id" value="<?php echo e($user->id); ?>">

            <div class="col-6 form-group">
                <label class="form-control-label" for="staff_id"><?php echo e(__('Staff Id')); ?></label>
                <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo e($user->staff_id); ?>" readonly="readonly" required/>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="fname"><?php echo e(__('First Name')); ?></label>
                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo e($user->fname); ?>" required/>
                <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="mid_name"><?php echo e(__('Middle Name')); ?></label>
                <input type="text" class="form-control" id="mid_name" name="mid_name" value="<?php echo e($user->mid_name); ?>"/>
                <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="lname"><?php echo e(__('Last Name')); ?></label>
                <input type="text" class="form-control" id="lname" name="lname" value="<?php echo e($user->lname); ?>" required/>
                <span class="error" style="color:red"></span>
            </div>
            <div class="col-6 form-group">
                <label class="form-control-label" for="email"><?php echo e(__('E-Mail Address')); ?></label>
                <input type="email" class="form-control" id="email" name="email" readonly value="<?php echo e($user->email); ?>" required/>
                <span class="error" style="color:red"></span>
            </div>
            <div class="col-6 form-group">
                <label class="form-control-label" for="phone"><?php echo e(__('Phone Number')); ?></label>
                <input type="phone" class="form-control" id="phone" name="phone"  value="<?php echo e($user->phone); ?>" required/>
                <span class="error" style="color:red"></span>
            </div>
            <!-- <div class="col-6 form-group">
                <label class="form-control-label" for="password"><?php echo e(__('Password')); ?></label>
                <input type="text" class="form-control" id="password" name="password"/>
                <span class="error" style="color:red"></span>
            </div> -->

            <div class="col-6 form-group">
                <label class="form-control-label" for="job_title"><?php echo e(__('Job Title')); ?></label>
                <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo e($user->job_title); ?>"/>
                <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="designation"><?php echo e(__('Designation')); ?></label>
                <input type="text" class="form-control" id="designation" name="designation" value="<?php echo e($user->designation); ?>" />
                    <span class="error" style="color:red"></span>
            </div>


            <div class="col-6 form-group">
                <label class="form-control-label" for="cadre"><?php echo e(__('Cadre')); ?></label>
                <input type="text" class="form-control" id="cadre" name="cadre" value="<?php echo e($user->cadre); ?>" />
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="job_title"><?php echo e(__('Date of Current Posting')); ?></label>
                <input type="date" class="form-control" id="date_of_current_posting" value="<?php echo e($user->date_of_current_posting); ?>" name="date_of_current_posting" max="<?php echo e(date('Y-m-d')); ?>">
                <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group" id='datetimepicker1'>
                <label class="form-control-label" for="date_of_MDA_posting"><?php echo e(__('Date of MDA Posting')); ?></label>
                <input type="date" class="form-control" id="date_of_MDA_posting" name="date_of_MDA_posting" value="<?php echo e($user->date_of_MDA_posting); ?>">
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group" id='datetimepicker1'>
                <label class="form-control-label" for="date_of_last_promotion"><?php echo e(__('Date of last Promotion')); ?></label>
                <input type="date" class="form-control" id="date_of_last_promotion" name="date_of_last_promotion" value="<?php echo e($user->date_of_last_promotion); ?>">
                    <span class="error" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="gender"><?php echo e(__('Gender')); ?></label>
                <select name="gender" class="form-control select2" required>
                    <option value=""><?php echo e(__('Select Gender')); ?></option>
                    <option value="male" <?php if($user->gender == "male"): ?> selected="selected" <?php endif; ?>>Male</option>
                    <option value="female" <?php if($user->gender == "female"): ?> selected="selected" <?php endif; ?>>Female</option>
                    <option value="others" <?php if($user->gender == "others"): ?> selected="selected" <?php endif; ?>>Others</option>
                </select>
                <span class="errorgender" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="grade_level"><?php echo e(__('Grade Level')); ?></label>
                <select name="grade_level" class="form-control select2" required>
                    <option value=""><?php echo e(__('Select Grade Level')); ?></option>
                    <option value="1" <?php if($user->grade_level == "1"): ?> selected="selected" <?php endif; ?>>1</option>
                    <option value="2" <?php if($user->grade_level == "2"): ?> selected="selected" <?php endif; ?>>2</option>
                    <option value="3" <?php if($user->grade_level == "3"): ?> selected="selected" <?php endif; ?>>3</option>
                    <option value="4" <?php if($user->grade_level == "4"): ?> selected="selected" <?php endif; ?>>4</option>
                    <option value="5" <?php if($user->grade_level == "5"): ?> selected="selected" <?php endif; ?>>5</option>
                    <option value="6" <?php if($user->grade_level == "6"): ?> selected="selected" <?php endif; ?>>6</option>
                    <option value="7" <?php if($user->grade_level == "7"): ?> selected="selected" <?php endif; ?>>7</option>
                    <option value="8" <?php if($user->grade_level == "8"): ?> selected="selected" <?php endif; ?>>8</option>
                    <option value="9" <?php if($user->grade_level == "9"): ?> selected="selected" <?php endif; ?>>9</option>
                    <option value="10" <?php if($user->grade_level == "10"): ?> selected="selected" <?php endif; ?>>10</option>
                    <option value="11" <?php if($user->grade_level == "11"): ?> selected="selected" <?php endif; ?>>11</option>
                    <option value="12" <?php if($user->grade_level == "12"): ?> selected="selected" <?php endif; ?>>12</option>
                    <option value="13" <?php if($user->grade_level == "13"): ?> selected="selected" <?php endif; ?>>13</option>
                    <option value="14" <?php if($user->grade_level == "14"): ?> selected="selected" <?php endif; ?>>14</option>
                    <option value="15" <?php if($user->grade_level == "15"): ?> selected="selected" <?php endif; ?>>15</option>
                    <option value="16" <?php if($user->grade_level == "16"): ?> selected="selected" <?php endif; ?>>16</option>
                    <option value="17" <?php if($user->grade_level == "17"): ?> selected="selected" <?php endif; ?>>17</option>
                    <option value="Cons" <?php if($user->grade_level == "Cons"): ?> selected="selected" <?php endif; ?>>Cons</option>

                </select>
                <span class="error_grade" style="color:red"></span>
            </div>

            <div class="col-6 form-group">
                <label class="form-control-label" for="organization"><?php echo e(__('Organization')); ?></label>
                <select name="org_code" class="form-control select2" required>
                    <option value=""><?php echo e(__('Select Organization')); ?></option>
                    <?php $__currentLoopData = $organization; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($org->org_code); ?>" <?php if($org->org_code == $userorganization): ?> selected <?php endif; ?>><?php echo e($org->org_name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="error_org_name" style="color:red"></span>
            </div>




            <div class="col-6 form-group">
                <label class="form-control-label" for="password"><?php echo e(__('Role')); ?></label>
                <select name="role" class="form-control select2" id="role_selecter" required>
                    <option value=""><?php echo e(__('Select Role')); ?></option>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role->id); ?>" <?php if($role->id == $userRole): ?> selected <?php endif; ?>><?php echo e($role->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <span class="error_role" style="color:red"></span>
            </div>
            <div class="col-6 form-group">
                <label class="form-control-label" for="recovery_email"><?php echo e(__('Recovery Email')); ?></label>
                <input type="email" class="form-control" id="recovery_email" name="recovery_email" value="<?php echo e($user->recovery_email); ?>" required/>
                <span class="error_recovery_email" style="color:red"></span>
            </div>

            <div class="col-12 form-group menu" <?php if($userRole !=9): ?> style="display: none <?php endif; ?>">
                <label class="form-control-label" for="gender"><?php echo e(__('Dashboard Menu')); ?></label><br>

                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="total_user" style="margin: 0 !important;" <?php echo e(in_array('total_user', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="total_user" style="margin: auto 12px;"> Total User</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="total_dept" style="margin: 0 !important;" <?php echo e(in_array('total_dept', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="total_department" style="margin: auto 12px;"> Total Department</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="rating_by_grade_level" style="margin: 0 !important;" <?php echo e(in_array('rating_by_grade_level', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="rating_by_grade_level" style="margin: auto 12px;"> Employee Performance Rating By Grade Level</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="rating_score_by_department" style="margin: 0 !important;" <?php echo e(in_array('rating_score_by_department', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="rating_score_by_department" style="margin: auto 12px;"> Employee Performance Rating Score By Department</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="top_30_employees_by_performence_rating" style="margin: 0 !important;" <?php echo e(in_array('top_30_employees_by_performence_rating', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="top_30_employees_by_performence_rating" style="margin: auto 12px;"> Top 30 Employees By Performance Rating</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="bottom_30_employees_by_performence_rating" style="margin: 0 !important;" <?php echo e(in_array('bottom_30_employees_by_performence_rating', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="botom_30_employees_by_performence_rating" style="margin: auto 12px;"> Bottom 30 Employees By Performance Rating</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="report_on_overall_training_needs" style="margin: 0 !important;" <?php echo e(in_array('report_on_overall_training_needs', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="report_on_overall_training_needs" style="margin: auto 12px;"> Report On Overall Training Needs</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="report_on_training_needs_by_department" style="margin: 0 !important;" <?php echo e(in_array('report_on_training_needs_by_department', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="report_on_training_needs_by_department" style="margin: auto 12px;"> Report On Training Needs By Department</label>
                </div>


                <div style="display: flex;">
                    <input type="checkbox" id="department_menu" name="department_menu[]" value="report_on_employees_percentage_distribution" style="margin: 0 !important;" <?php echo e(in_array('report_on_employees_percentage_distribution', $dashboard_menus, true)? 'checked' : ''); ?>>
                    <label for="report_on_employees_percentage_distribution" style="margin: auto 12px;"> Report On Employees Percentage Distribution</label>
                </div>

                <!-- <span class="errorgender" style="color:red"></span> -->
            </div>


            <div class="col-12 form-group sidebarmenu" <?php if($userRole !=9): ?> style="display: none <?php endif; ?>">
                <label class="form-control-label" for="gender"><?php echo e(__('Sidebar Menu')); ?></label><br>

                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="1" <?php echo e(in_array('1', $sidebar_menus, true)? 'checked' : ''); ?> style="margin: 0 !important;">
                    <label for="Users" style="margin: auto 12px;">Users</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="2" <?php echo e(in_array('2', $sidebar_menus, true)? 'checked' : ''); ?> style="margin: 0 !important;">
                    <label for="Department" style="margin: auto 12px;">Department</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="3" <?php echo e(in_array('3', $sidebar_menus, true)? 'checked' : ''); ?> style="margin: 0 !important;">
                    <label for="Duties" style="margin: auto 12px;">Assign Duties</label>
                </div>

                <div style="display: flex;">
                    <input type="checkbox" id="sidebar_menu" name="sidebar_menu[]" value="4" <?php echo e(in_array('4', $sidebar_menus, true)? 'checked' : ''); ?> style="margin: 0 !important;">
                    <label for="faq" style="margin: auto 12px;">FAQ</label>
                </div>
            </div>

            <?php echo $__env->make('custom_fields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="form-group col-12 text-right">
                <input type="submit" value="<?php echo e(__('Update')); ?>" id="edit_user_btn" class="btn-create badge-blue">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
    </form>
</div>
<?php /**PATH /home/deveduco/public_html/admin/resources/views/users/edit_owner.blade.php ENDPATH**/ ?>