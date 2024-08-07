<?php $__env->startSection('title'); ?>
    <?php echo e(__('MPMS')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>


<?php if(isset($data)): ?>
    <?php $__env->startSection('content'); ?>
        <form id="form1" method="post" action="<?php echo e(route('mpms_form.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row step_1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row p-0">
                                <div class="col-8 form-group">
                                    <input type="hidden" id="kra_id" name="kra_id" value="<?php echo e($data[0]->kra_id); ?>">
                                    <label class="form-control-label" for="form_name"><?php echo e(__('Form Name')); ?></label>
                                    <select name="form_name"  id="form_name" class="form-control select2" required>
                                            <option value="1" <?php echo isset($data[0]->mpms_id)?(($data[0]->mpms_id)=='1' ? 'selected' : '') : '' ?>>Presidential Priorities</option>
                                            <option value="2" <?php echo isset($data[0]->mpms_id)?(($data[0]->mpms_id)=='2' ? 'selected' : '') : '' ?>>MDA Operational Objectives</option>
                                            <option value="3" <?php echo isset($data[0]->mpms_id)?(($data[0]->mpms_id)=='3' ? 'selected' : '') : '' ?>>Service-Wide KRAs</option>
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="kra_title"><?php echo e(__('Key Result Areas')); ?></label>
                                    <input type="text" class="form-control" id="kra_title" name="kra_title" value="<?php echo e($data[0]->kra_title); ?>">
                                    <br>
                                    <?php $__errorArgs = ['kra_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="kra_weight"><?php echo e(__('Weight for KRA')); ?></label>
                                    <input type="text" class="form-control" id="kra_weight" name="kra_weight" value="<?php echo e($data[0]->kra_weight); ?>">
                                    <br>
                                    <?php $__errorArgs = ['kra_weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-12 p-0 text-right">
                                    <input type="submit" value="<?php echo e(__('Save & Next')); ?>" class="btn-create badge-blue next">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php $__env->stopSection(); ?>
<?php else: ?>
    <?php $__env->startSection('content'); ?>
        <form id="form1" method="post" action="<?php echo e(route('mpms_form.store')); ?>">
            <?php echo csrf_field(); ?>
            <div class="row step_1">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row p-0">
                                <?php if($user->type == 'Admin'): ?>
                                <div class="col-8 form-group">
                                    <label class="form-control-label" for="form_name"><?php echo e(__('Form Name')); ?></label>
                                    <select name="form_name"  id="form_name" class="form-control select2" required>
                                            <option value="1" selected >Presidential Priorities</option>
                                            <option value="2">MDA Operational Objectives</option>
                                            <option value="3">Service-Wide KRAs</option>
                                    </select>
                                </div>
                                <?php endif; ?>
                                <?php if($user->type == 'Owner'): ?>
                                <div class="col-8 form-group">
                                    <label class="form-control-label" for="form_name"><?php echo e(__('Form Name')); ?></label>
                                    <select name="form_name"  id="form_name" class="form-control select2" required>
                                            <option value="1" selected >Presidential Priorities</option>
                                            <option value="2">MDA Operational Objectives</option>
                                            <option value="3">Service-Wide KRAs</option>
                                    </select>
                                </div>
                                <?php endif; ?>
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="kra_title"><?php echo e(__('Key Result Areas')); ?></label>
                                    <input type="text" class="form-control" id="kra_title" name="kra_title" value="<?php echo e(old('kra_title')); ?>">
                                    <br>
                                    <?php $__errorArgs = ['kra_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="kra_weight"><?php echo e(__('Weight for KRA')); ?></label>
                                    <input type="text" class="form-control" id="kra_weight" name="kra_weight" value="<?php echo e(old('kra_weight')); ?>">
                                    <br>
                                    <?php $__errorArgs = ['kra_weight'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <div class="alert alert-danger"><?php echo e($message); ?></div>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                
                                <div class="col-6 form-group">
                                    <input type="hidden" class="form-control" id="year" name="year" value="<?php echo e($year); ?>">
                                </div>
                                
                                <div class="form-group col-12 p-0 text-right">
                                    <input type="submit" value="<?php echo e(__('Save & Next')); ?>" class="btn-create badge-blue next">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php $__env->stopSection(); ?>
<?php endif; ?>




<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/mpms/create.blade.php ENDPATH**/ ?>