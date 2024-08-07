<?php $__env->startSection('title'); ?>
    <?php echo e(__('MPMS')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        function addObj() {
            index = parseInt($("input[name='count_card']").val());

            var newRow = '<div class="card"> <div class="card-body"> <div class="row p-0"> <div class="col-6 form-group"> <label class="form-control-label">Objective</label> <input type="text" class="form-mpms" id="obj_title" name="objactives['+index+'][obj_title]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Weight</label> <input type="text" class="form-mpms" id="obj_weight" name="objactives['+index+'][obj_weight]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Initiative</label> <input type="text" class="form-mpms" id="initiative" name="objactives['+index+'][initiative]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">KPI</label> <input type="text" class="form-mpms" id="kpi" name="objactives['+index+'][kpi]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Target</label> <input type="text" class="form-mpms" id="target" name="objactives['+index+'][target]" value=""> </div> <div class="col-6 form-group"> <label class="form-control-label">Responsible</label> <input type="text" class="form-mpms" id="responsible" name="objactives['+index+'][responsible]" value=""> </div> </div> </div> </div>';
            $("#appendDiv").append(newRow);

            index=++index;
            $("input[name='count_card']").val(index);
        }
    </script>
<?php $__env->stopPush(); ?>

<?php if($status == 'update' ): ?>
    <?php $__env->startSection('content'); ?>   
        <form method="post" action="<?php echo e(route('mpms_form.final')); ?>" id="finalForm"> 
            <?php echo csrf_field(); ?>
            <div>
                <p class="add-obj-button" onclick="addObj()">Add Objectives</p>
            </div>
            <div class="row step_1">
                <div class="col-md-12" id="appendDiv">
                    <div>
                        <input type="hidden" name="kra_id" value="<?php echo e($id); ?>">
                        <input type="hidden" name="mpms_id" value="<?php echo e($mpms_id); ?>">
                    </div>
                    <input type="hidden" id="count" name="count_card" value="<?php echo e(count($data)); ?>">
                    <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="card">
                            <div class="card-body">
                                <div class="row p-0">
                                    <input type="hidden" id="obj_id" name="objactives[<?php echo e($key); ?>][id]" value="<?php echo e($value->id); ?>">
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="obj_title"><?php echo e(__('Objective')); ?></label>
                                        <input type="text" class="form-mpms" id="obj_title" name="objactives[<?php echo e($key); ?>][obj_title]" value="<?php echo e($value->obj_title); ?>">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="obj_weight"><?php echo e(__('Weight')); ?></label>
                                        <input type="text" class="form-mpms" id="obj_weight" name="objactives[<?php echo e($key); ?>][obj_weight]" value="<?php echo e($value->obj_weight); ?>">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="initiative"><?php echo e(__('Initiative')); ?></label>
                                        <input type="text" class="form-mpms" id="initiative" name="objactives[<?php echo e($key); ?>][initiative]" value="<?php echo e($value->Initiative); ?>">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="kpi"><?php echo e(__('KPI')); ?></label>
                                        <input type="text" class="form-mpms" id="kpi" name="objactives[<?php echo e($key); ?>][kpi]" value="<?php echo e($value->kpi); ?>">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="target"><?php echo e(__('Target')); ?></label>
                                        <input type="text" class="form-mpms" id="target" name="objactives[<?php echo e($key); ?>][target]" value="<?php echo e($value->target); ?>">
                                    </div>
                                    <div class="col-6 form-group">
                                        <label class="form-control-label" for="responsible"><?php echo e(__('Responsible')); ?></label>
                                        <input type="text" class="form-mpms" id="responsible" name="objactives[<?php echo e($key); ?>][responsible]" value="<?php echo e($value->Responsible); ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="form-group col-12 p-0 text-right">
                    <button class="btn-create badge-blue" id="finalFormSubBtn">Submit</button>
                </div>
            </div>
        </form>
    <?php $__env->stopSection(); ?> 
<?php else: ?>
    <?php $__env->startSection('content'); ?>   
        <form method="post" action="<?php echo e(route('mpms_form.final')); ?>" id="finalForm">
            <?php echo csrf_field(); ?>
            <div>
                <p class="add-obj-button" onclick="addObj()">Add Objectives</p>
            </div>
            <div class="row step_1">
                <div class="col-md-12" id="appendDiv">
                    <div>
                        <input type="hidden" name="kra_id" value="<?php echo e($id); ?>">
                        <input type="hidden" name="mpms_id" value="<?php echo e($mpms_id); ?>">
                    </div>
                    <input type="hidden" id="count" name="count_card" value="1">
                    <div class="card">
                        <div class="card-body">
                            <div class="row p-0">
                                <div class="col-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Objective')); ?></label>
                                    <input type="text" class="form-mpms" id="obj_title" name="objactives[0][obj_title]" value="<?php echo e(old('objactives[0][obj_title]')); ?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Weight')); ?></label>
                                    <input type="text" class="form-mpms" id="obj_weight" name="objactives[0][obj_weight]" value="<?php echo e(old('objactives[0][obj_weight]')); ?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Initiative')); ?></label>
                                    <input type="text" class="form-mpms" id="initiative" name="objactives[0][initiative]" value="<?php echo e(old('objactives[0][initiative]')); ?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('KPI')); ?></label>
                                    <input type="text" class="form-mpms" id="kpi" name="objactives[0][kpi]" value="<?php echo e(old('objactives[0][kpi]')); ?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Target')); ?></label>
                                    <input type="text" class="form-mpms" id="target" name="objactives[0][target]" value="<?php echo e(old('objactives[0][target]')); ?>">
                                </div>
                                <div class="col-6 form-group">
                                    <label class="form-control-label"><?php echo e(__('Responsible')); ?></label>
                                    <input type="text" class="form-mpms" id="responsible" name="objactives[0][responsible]" value="<?php echo e(old('objactives[0][responsible]')); ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-12 p-0 text-right">
                    <button class="btn-create badge-blue" id="finalFormSubBtn">Submit</button>
                </div>
            </div>
        </form>
    <?php $__env->stopSection(); ?>
<?php endif; ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/mpms/final.blade.php ENDPATH**/ ?>