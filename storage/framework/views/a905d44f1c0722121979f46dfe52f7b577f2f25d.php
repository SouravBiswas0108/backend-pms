<?php $__env->startSection('title'); ?>
    <?php echo e(__('Assign Role to Staff')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/assets/libs/summernote/summernote-bs4.css')); ?>">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>


<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/assets/libs/summernote/summernote-bs4.js')); ?>"></script>

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<style>
    .block-option-color
    {
        color:#cccccc;
    }
    .select2-container .select2-search {
    display: block;
}
.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default .select2-selection--multiple {
    padding-top: 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    list-style: none;
    height: 28px;
    margin-top: 0px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    margin: 0 0 2.25rem 0.25rem;

}
</style>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="pl-3 pr-3" method="post" action="<?php echo e(route('department.assignUserstore')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="dept_name"><?php echo e(__('Department Name')); ?></label>
                                    <input type="text" class="form-control dept_name" id="dept_name" name="dept_name" readonly value="<?php echo e($department['dept_name']); ?>" required/>
                                    <input type="hidden" class="form-control" id="dept_id" name="dept_id" value="<?php echo e($department['dept_id']); ?>" />
                                    <input type="hidden" class="form-control" id="dept_org_code" name="dept_org_code" value="<?php echo e($department['org_code']); ?>" />
                                </div>
                                <div class="col-6 form-group"></div>

                                <div class="col-6 form-group data-row scrollbar_set">
                                    <label class="form-control-label" for="userlist"><?php echo e(__('Assign Supervisor')); ?></label>
                                    <select id="form-control select2 disable_select" name="supervisor_name[]" class="form-control select2 disable_select" multiple="multiple">


                                            <?php if(isset($data['stafflist']) && !empty($data['stafflist'])): ?>
                                            <?php $__currentLoopData = $data['stafflist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $show ='';
                                             if($key == $officer_id)
                                             continue;
                                            //  $show ='style="display:none;"';

                                            ?>




                                                <option <?=$show ?> value="<?php echo e($key); ?>" <?php if(is_array($supervisor_id)): ?><?php $__currentLoopData = $supervisor_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if($key == $id): ?> selected <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> <?php else: ?>
                                                    <?php if($key == $supervisor_id): ?> selected <?php endif; ?> <?php endif; ?>>
                                                    <?php echo e($staff); ?>

                                                </option>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-6 form-group">


                                </div>


                                <div class="col-6 form-group data-row"  id="officer_block">
                                    <label class="form-control-label" for="userlist"><?php echo e(__('Assign Officer')); ?></label>
                                    <select id="<?php echo e($department['dept_id']); ?> officer_name" name="officer_name" class="form-control officer_name" disabled>
                                        <option value=""><?php echo e(__('Select Officer')); ?></option>
                                            <?php if(isset($data['stafflist']) && !empty($data['stafflist'])): ?>
                                            <?php $__currentLoopData = $data['stafflist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if(is_array($supervisor_id)): ?>
                                            <?php if(in_array($key,$supervisor_id)): ?>

                                            <?php else: ?>


                                                <option <?= $show ?> value="<?php echo e($key); ?>"<?php if($key == $officer_id): ?> selected <?php endif; ?> ><?php echo e($staff); ?></option>
                                            <?php endif; ?>
                                            <?php else: ?>
                                            <?php if($key == $supervisor_id): ?>

                                            <?php else: ?>
                                             <option <?= $show ?> value="<?php echo e($key); ?>"<?php if($key == $officer_id): ?> selected <?php endif; ?> ><?php echo e($staff); ?></option>
                                             <?php endif; ?>
                                             <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                    </select>
                                </div>

                                <div class="col-6 form-group"></div>

                                <div class="form-group col-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Done')); ?>" class="btn-create badge-blue btn btn-xs btn-white btn-icon-only width-auto edit-icon userrole-btn">
                                    <?php if(isset($department['dept_id'])): ?>
                                    <a href="javascript:void(0)" data-target="#myModal" data-toggle="modal" class="btn btn-xs btn-white btn-icon-only width-auto edit-icon" data-title="<?php echo e(__('Preview')); ?>" id="edit-item" style="top: 8px;">Preview</a>
                                    <?php endif; ?>

                                    <!-- <input type="button" value="<?php echo e(__('cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal"> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>













<!-- Attachment Modal -->
<div class="modal fade modal_pre" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Preview Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <form id="edit-form" class="form-horizontal" method="POST" action="">
                    <div class="card text-white bg-dark mb-0">
                        <div class="card-header">
                            <h2 class="m-0">Preview</h2>
                        </div>
                        <div class="card-body">
                            <!-- id -->

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Department Name</label>
                                <input type="text" name="modal-dept_name" class="form-control" id="modal-dept_name" required readonly="readonly">
                            </div>

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Supervisor Name</label>
                                <input type="text" name="modal-supervisor_name" class="form-control" id="modal-supervisor_name" required readonly="readonly">
                            </div>

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Officer Name</label>
                                <input type="text" name="modal-officer_name" class="form-control" id="modal-officer_name" required readonly="readonly">
                            </div>

                            <button type="button" class="btn btn-secondary close_new" data-dismiss="modal" style="right: -10px">OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>-->
        </div>
    </div>
</div>


<!-- /Attachment Modal -->

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/department/assignUserRole.blade.php ENDPATH**/ ?>