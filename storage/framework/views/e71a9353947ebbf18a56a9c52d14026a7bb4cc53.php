

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Assign Duties to Staff')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="pl-3 pr-3" method="post" action="<?php echo e(route('duties.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="user_name"><?php echo e(__('User Name')); ?></label>
                                    <input type="text" class="form-control" id="user_name" name="user_name" readonly value="<?php echo e(($users['fname']!='') ? $users['fname'] : ''); ?> <?php echo e(($users['mid_name']!='') ? $users['mid_name'] : ''); ?> <?php echo e(($users['lname']!='') ? $users['lname'] : ''); ?>"/>

                                    <input type="hidden" class="form-control" id="staff_id" name="staff_id" readonly value="<?php echo e(($users['staff_id']!='') ? $users['staff_id'] : ''); ?>"/>
                                    
                                </div>
                                <div class="col-6 form-group"></div>

                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="userlist"><?php echo e(__('Assign Role')); ?></label>
                                    <select id="assign_infos" name="assign_infos"class="form-control assign_infos" required>
                                        <option value=""><?php echo e(__('Select Role')); ?></option>

                                        <?php if(isset($assign_infos) && !empty($assign_infos)): ?>
                                        <?php $__currentLoopData = $assign_infos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $assign_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($assign_info->assign_role_id); ?>"><?php echo e($assign_info->assign_type); ?>

                                        </option>



                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-6 form-group"></div>


                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="userlist"><?php echo e(__('SCHEDULE OF DUTIES')); ?></label>
                                    <textarea name="duties" class="form-control tinymce duties" id="full-featured-non-premium" rows="10" cols="100"></textarea>
                                </div>
                                <div class="col-6 form-group"></div>

                                <div class="form-group col-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Done')); ?>" class="btn-create badge-blue btn btn-xs btn-white btn-icon-only width-auto edit-icon userrole-btn">
                                    <!-- <?php if(isset($department['dept_id'])): ?>
                                    <a href="javascript:void(0)" data-target="#myModal" data-toggle="modal" class="btn btn-xs btn-white btn-icon-only width-auto edit-icon" data-title="<?php echo e(__('Preview')); ?>" id="edit-item" style="top: 8px;">Preview</a>
                                    <?php endif; ?> -->

                                    <!-- <input type="button" value="<?php echo e(__('cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal"> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/duties/assignDuties.blade.php ENDPATH**/ ?>