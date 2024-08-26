<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Department')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>

    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
<script>
    $(document).ready(function() {

        let element =document.getElementById("blocked-element")
    
        element.classList.add('no-select');
    });
    </script>
    <script src="<?php echo e(asset('assets/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <form class="" method="post" action="<?php echo e(route('admin.departments.update',$department->department_id)); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-0">
                            <div class="form-group col-12 p-0 text-right">
                                <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
                                <!-- <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal"> -->
                            </div>
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="dept_id"><?php echo e(__('Department Id')); ?></label>
                                <input type="text" class="form-control" id="dept_id" name="dept_id" value="<?php echo e($department->department_id); ?>" readonly="readonly" />
                            </div>
                            <div class="col-6 form-group">

                            </div>
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="dept_name"><?php echo e(__('Department Name')); ?></label>
                                <input type="text" class="form-control" id="dept_name" name="dept_name" value="<?php echo e($department->department_name); ?>"/>
                            </div>
                       


                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable_edit_dept" id="my-table">
                                        <thead>
                                            <tr>
                                                <th width="30%"><?php echo e(__('Staff Names')); ?></th>
                                                <th align="center" class="" width="30%">
                                                    <!-- <input type="checkbox" name="checkall" class="selectall" id="selectall" onclick="checkUncheckAll(this);"/> -->
                                                    <input type="checkbox" name="checkall" id="select-all" />Check all?<br />
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $alreadyselected =[];

                                            ?>

                                            <?php if(isset($departmentlist['departmentStaffAlreadySelected']) && !empty($departmentlist['departmentStaffAlreadySelected']) && is_array($departmentlist['departmentStaffAlreadySelected'])): ?>
                                            <?php $__currentLoopData = $departmentlist['departmentStaffAlreadySelected']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td  style="color:black;">
                                                    <?php echo e(($staffs['fname'] !='') ? ($staffs['fname']) : ""); ?>

                                                    <?php echo e(($staffs['mid_name'] !='') ? ($staffs['mid_name']) : ""); ?>

                                                    <?php echo e(($staffs['lname'] !='') ? ($staffs['lname']) : ""); ?>

                                                    <?php echo e(($staffs['staff_id'] !='') ? ('('.$staffs['staff_id'].')') : ""); ?>

                                                </td>
                                                <td style="color:black;">
                                                    <?php
                                                        if(in_array($staffs['staff_id'],$departmentlist['departmentallstaff'])){
                                                            array_push($alreadyselected,$staffs['staff_id']);
                                                        }
                                                    ?>
                                                    <input type="checkbox" name="checkall[]" class="sub_chk" value="<?php echo e(($staffs['staff_id'] !='') ? ($staffs['staff_id']) : ''); ?>" checked="checked"/>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>






                                            <?php if(isset($departmentlist['unSelectedStafflist']) && !empty($departmentlist['unSelectedStafflist']) && is_array($departmentlist['unSelectedStafflist'])): ?>
                                            <?php $__currentLoopData = $departmentlist['unSelectedStafflist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffsnew): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                            <tr>
                                                <td  style="color:black;">
                                                    <?php echo e(($staffsnew['fname'] !='') ? ($staffsnew['fname']) : ""); ?>

                                                    <?php echo e(($staffsnew['mid_name'] !='') ? ($staffsnew['mid_name']) : ""); ?>

                                                    <?php echo e(($staffsnew['lname'] !='') ? ($staffsnew['lname']) : ""); ?>

                                                    <?php echo e(($staffsnew['staff_id'] !='') ? ('('.$staffsnew['staff_id'].')') : ""); ?>

                                                </td>
                                                <td style="color:black;">

                                                    <input type="checkbox" name="checkall[]" class="sub_chk" value="<?php echo e(($staffsnew['staff_id'] !='') ? ($staffsnew['staff_id']) : ''); ?>"/>
                                                </td>
                                            </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>


                                            <?php if(empty($departmentlist['departmentStaffAlreadySelected']) && empty($departmentlist['unSelectedStafflist'])): ?>
                                                <tr class="font-style">
                                                    <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             <input type="hidden" name="selected_staff" value="<?php echo e(($alreadyselected !='') ? (implode(',',$alreadyselected)) : 'null'); ?>" class="selected_staff">

                            <div class="form-group col-12 p-0 text-right">
                                <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
                                <!-- <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal"> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Office/backend-fmepms/backend-pms/resources/views/admin/department/edit.blade.php ENDPATH**/ ?>