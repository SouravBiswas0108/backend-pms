<?php $__env->startSection('title'); ?>
    <?php echo e(__('Assigned Staffs')); ?>

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
                <div class="row p-0">
                    <div class="form-group col-12 p-0 text-right">
                        <input type="button" value="<?php echo e(__('Back')); ?>" class="btn-create badge-blue clickme" data-dismiss="modal">
                    </div>
                    <div class="col-6 form-group">
                        <label class="form-control-label" for="dept_id"><?php echo e(__('Department Id')); ?></label>
                        <input type="text" class="form-control" id="dept_id" name="dept_id" value="<?php echo e($department->dept_id ?? 'N/A'); ?>" readonly="readonly" />
                    </div>

                    <div class="col-6 form-group">
                        <label class="form-control-label" for="dept_name"><?php echo e(__('Department Name')); ?></label>
                        <input type="text" class="form-control" id="dept_name" name="dept_name" value="<?php echo e($department->dept_name ?? 'N/A'); ?>" readonly="readonly"/>
                    </div>

                    <div class="col-md-12">
                    <div class="assigned_staffs">
                        <div class="table-responsive">

                            <table class="table table-striped dataTable" id="new">
                                <thead>
                                    <tr>
                                        <th width="30%"><?php echo e(__('Staff Names')); ?></th>
                                        <th  width="5%"> Print All Records </th>
                                        <th  width="5%"> Appraisal Dispute Form</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php if(isset($all_staffs) && !empty($all_staffs)): ?>
                                    <?php $__currentLoopData = $all_staffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $staffs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td  style="color:black;">
                                            <?php echo e($staffs->staff_name); ?>


                                        </td>
                                        <td style="color:black;">
                                            <div style="font-size: 32px;text-align:center;">
                                            <a href="<?php echo e(route('generatepdf',['staff_id'=>base64_encode($staffs->staff_id),'dept_id'=>base64_encode($staffs->dept_id)])); ?>"  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Print')); ?>"><i class="far fa-file-pdf" style="color: #1f5120;"></i></a>
                                            </div>

                                        </td>
                                        <?php if(in_array($staffs->staff_id, $staff_ids)): ?>
                                        <td style="color:black;text-align:center;">
                                            <div style="font-size: 30px;">
                                            <a href="<?php echo e(route('apprisal_dispute_form',['staff_id'=>base64_encode($staffs->staff_id),'dept_id'=>base64_encode($staffs->dept_id),'year'=>$year])); ?>"  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Print')); ?>"><i class="far fa-edit" style="color: #1f5120;"></i></a>
                                            </div>

                                        </td>
                                        <?php else: ?>
                                        <td style="color:black; text-align:center;">
                                            <div style="font-size: 30px;">
                                                <svg style="width: 28px; height: 28px; fill: #1f5120;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.4.0 by @fontawesome  - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zm151 118.3C226 97.7 269.5 80 320 80c65.2 0 118.8 29.6 159.9 67.7C518.4 183.5 545 226 558.6 256c-12.6 28-36.6 66.8-70.9 100.9l-53.8-42.2c9.1-17.6 14.2-37.5 14.2-58.7c0-70.7-57.3-128-128-128c-32.2 0-61.7 11.9-84.2 31.5l-46.1-36.1zM394.9 284.2l-81.5-63.9c4.2-8.5 6.6-18.2 6.6-28.3c0-5.5-.7-10.9-2-16c.7 0 1.3 0 2 0c44.2 0 80 35.8 80 80c0 9.9-1.8 19.4-5.1 28.2zm9.4 130.3C378.8 425.4 350.7 432 320 432c-65.2 0-118.8-29.6-159.9-67.7C121.6 328.5 95 286 81.4 256c8.3-18.4 21.5-41.5 39.4-64.8L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5l-41.9-33zM192 256c0 70.7 57.3 128 128 128c13.3 0 26.1-2 38.2-5.8L302 334c-23.5-5.4-43.1-21.2-53.7-42.3l-56.1-44.2c-.2 2.8-.3 5.6-.3 8.5z"/></svg>
                                            </div>
                                        </td>
                                        <?php endif; ?>
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
                        <input type="button" value="<?php echo e(__('Back')); ?>" class="btn-create badge-blue clickme" data-dismiss="modal">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/apprisal/assignedStaffsList.blade.php ENDPATH**/ ?>