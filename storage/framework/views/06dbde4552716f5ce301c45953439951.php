<?php $__env->startSection('title'); ?>
    <?php echo e(__('Assigned Staffs')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('assets/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row p-0">
                    <div class="form-group col-12 p-0 text-right">
                        <input type="button" value="<?php echo e(__('Back')); ?>" class="btn-create badge-blue clickme" data-dismiss="modal">
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-control-label" for="dept_id"><?php echo e(__('Department Id')); ?></label>
                        <input type="text" class="form-control" id="dept_id" name="dept_id" value="<?php echo e($department->department_id ?? 'N/A'); ?>" readonly="readonly" />
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-control-label" for="dept_name"><?php echo e(__('Department Name')); ?></label>
                        <input type="text" class="form-control" id="dept_name" name="dept_name" value="<?php echo e($department->department_name ?? 'N/A'); ?>" readonly="readonly"/>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped dataTable" id="new">
                                <thead>
                                    <tr>
                                        <th width="30%"><?php echo e(__('Staff Names')); ?></th>
                                        <th align="center" class="" width="30%">
                                            <!-- <input type="checkbox" name="checkall" class="selectall" id="selectall" onclick="checkUncheckAll(this);"/> -->
                                            <!-- <input type="checkbox" name="checkall" id="select-all" />Check all?<br /> -->
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $alreadyselected =[];
                                    ?>
                                    <?php if(isset($data['stafflist']) && !empty($data['stafflist'])): ?>
                                    <?php $__currentLoopData = $data['stafflist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td  style="color:black;">
                                            <?php echo e($staffs); ?>


                                        </td>
                                        <td style="color:black;">


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

                     <input type="hidden" name="selected_staff" value="<?php echo e(($alreadyselected !='') ? (implode(',',$alreadyselected)) : 'null'); ?>" class="selected_staff">

                    <div class="form-group col-12 p-0 text-right">
                        <input type="button" value="<?php echo e(__('Back')); ?>" class="btn-create badge-blue clickme" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/Office/backend-fmepms/backend-pms/resources/views/admin/department/viewlistuser.blade.php ENDPATH**/ ?>