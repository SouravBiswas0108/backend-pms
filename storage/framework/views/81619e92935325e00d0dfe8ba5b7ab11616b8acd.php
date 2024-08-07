<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Department')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-button-box">
                <a href="<?php echo e(route('department.create')); ?>" data-url="" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Department')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Create')); ?> </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped dataTable">
                                <thead>
                                <tr>
                                    <!-- <th><?php echo e(__('Organization Name')); ?></th> -->
                                    <th><?php echo e(__('Department Id')); ?></th>
                                    <th><?php echo e(__('Department Name')); ?></th>
                                    <th width="300px"><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>


                                    <div class="modal" tabindex="-1" id="no_department" >
                                        <div class="modal-dialog">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title"> HI Admin</h5>
                                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                              <p>You don't Have Departments for this year do you want to copy from previous year!!!.</p>
                                            </div>
                                            <div class="modal-footer">
                                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="noButton">NO</button>
                                              <button type="button" class="btn btn-primary" id="yesButton">Yes</button>
                                            </div>
                                          </div>
                                        </div>
                                    </div>

                                    <?php if(count($department) > 0): ?>
                                        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td  style="color:black;"><?php echo e($dept->dept_id); ?></td>
                                                <td  style="color:black;"><?php echo e($dept->dept_name); ?></td>
                                                <?php if(Auth::user()->type != 'Client'): ?>
                                                    <td class="Action">
                                                        <span>
                                                            <?php if(\Auth::user()->type != 'Super Admin'): ?>
                                                                <a href="<?php echo e(route('department.viewlistuser',$dept->dept_id)); ?>" class="edit-icon bg-warning">
                                                                    <i class="fas fa-eye"></i></a>
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(route('department.edit',$dept->dept_id)); ?>" class="edit-icon "  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Edit Department')); ?>"><i class="fas fa-pencil-alt" onclick="blockSelection()" ></i></a>

                                                             


                                                            


                                                            <a href="<?php echo e(route('department.assignUserRole',$dept->dept_id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto edit-icon assign_staff" data-url="" data-ajax-popup="" data-title="<?php echo e(__('Assign Staff Department')); ?>">Assign Officers</a>
                                                            <a href="<?php echo e(route('department.assignStaff',$dept->dept_id)); ?>" class="btn btn-xs btn-white btn-icon-only width-auto edit-icon assign_staff" data-url="" data-ajax-popup="" data-title="<?php echo e(__('Assign Staff Department')); ?>">Assign Staff</a>
                                                            <a href="<?php echo e(route('department.allStaffs',base64_encode($dept->dept_id))); ?>" class="btn btn-xs btn-white btn-icon-only width-auto edit-icon assign_staff" data-url="" data-ajax-popup="" data-title="<?php echo e(__('Departments Staff')); ?>">Download Staffs Report</a>

                                                        </span>
                                                    </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr class="font-style">
                                            <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                        </tr>
                                        <?php if($year==date('Y')): ?>
                                            <input type="hidden" id ="no_dept" name="no_dept" value="1">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/department/listview.blade.php ENDPATH**/ ?>