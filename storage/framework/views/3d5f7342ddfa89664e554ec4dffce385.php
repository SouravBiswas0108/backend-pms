<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Department')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <form class="" method="post" action="<?php echo e(route('admin.departments.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row step_1">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row p-0">
                            <div class="form-group col-12 p-0 text-right">
                                <input type="button" value="<?php echo e(__('Next')); ?>" class="btn-create badge-blue next">
                                <!-- <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal"> -->
                            </div>
                            <div class="col-6 form-group">
                                <input type="hidden" name="selected_staff" value="" class="selected_staff">
                                <?php
                                $randomString = "DP";

                                for ($i = 0; $i < 6; $i++) {
                                if ($i < 6) {
                                $randomString.=rand(0,9);
                                }
                                if ($i == 8) {
                                //$randomString.=chr(rand(65,90));
                                }
                                }
                                ?>
                                <label class="form-control-label" for="dept_id"><?php echo e(__('Department Id')); ?></label>
                                <input type="text" class="form-control" id="dept_id" name="dept_id" value="<?php echo e($randomString); ?>" readonly="readonly" required/>
                            </div>
                            <?php if($user->type == 'Admin'): ?>
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="organization"><?php echo e(__('Organization')); ?></label>
                                <select name="org_code" class="form-control select2" required id="organization">
                                        <option value="<?php echo e($organization[0]['org_code']); ?>" selected ><?php echo e($organization[0]['org_name']); ?></option>
                                </select>
                            </div>
                            <?php endif; ?>
                            <?php if($user->type == 'Owner'): ?>
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="organization"><?php echo e(__('Organization')); ?></label>
                                <select name="org_code" class="form-control select2" required id="organization">
                                    <?php $__currentLoopData = $organization; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $org): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($org->org_code); ?>"><?php echo e($org->org_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php endif; ?>
                            <div class="col-6 form-group">
                                <label class="form-control-label" for="dept_name"><?php echo e(__('Department Name')); ?></label>
                                <input type="text" class="form-control" id="dept_name" name="dept_name" required/>
                            </div>
                            <div class="requireNameMsg" style="display: none; position: absolute;
                            top: 280px;
                            left: 28px;
                            color: red;">Department Name is required.</div>

                          <div class="col-6 form-group">
                            <label class="form-control-label" for="year"><?php echo e(__('Year')); ?></label>
                             <select name="year" class="form-control">
                             <?php for($i=2020;$i<=date('Y')+2;$i++): ?>
                            <option value=<?php echo e($i); ?> <?php if($i==date('Y')): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($i); ?></option>
                             <?php endfor; ?>
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
                                            <th width="30%"><?php echo e(__('Staff Names')); ?></th>
                                            <th align="center" class="" width="30%">
                                                <!-- <input type="checkbox" name="checkall" class="selectall" id="selectall" onclick="checkUncheckAll(this);"/> -->
                                                <input type="checkbox" name="checkall" id="select-all" />Check all?<br />
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(count($stafflist) > 0): ?>
                                        <?php $__currentLoopData = $stafflist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td  style="color:black;">
                                            <?php echo e(($staffs['F_name'] !='') ? ($staffs['F_name']) : ""); ?>

                                            <?php echo e(($staffs['M_name'] !='') ? ($staffs['M_name']) : ""); ?>

                                            <?php echo e(($staffs['L_name'] !='') ? ($staffs['L_name']) : ""); ?>

                                    <?php echo e(($staffs['staff_id'] !='') ? ('('.$staffs['staff_id'].')') : ""); ?>

                                            </td>
                                            <td style="color:black;">
                                            <input type="checkbox" name="checkall[]" class="sub_chk" value="<?php echo e(($staffs['staff_id'] !='') ? ($staffs['staff_id']) : ''); ?>"/>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr class="font-style">
                                                <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                       <div class="form-group col-12 p-0 text-right">
                            <input type="submit" value="<?php echo e(__('Submit')); ?>" id="dept_submit" class="btn-create badge-blue">
                            <input type="button" value="<?php echo e(__('Back')); ?>" class="btn-create bg-gray back" data-dismiss="modal">
                        </div>
                </div>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Office/backend-fmepms/backend-pms/resources/views/admin/department/create.blade.php ENDPATH**/ ?>