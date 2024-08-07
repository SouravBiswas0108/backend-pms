

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
  <?php if(Session::has('import_errors')): ?>
            <div class="col align-self-center alert alert-danger alert-dismissible fade show" role="alert">
               <h3 class="alert-heading">Errors on Rows while importing:</h3>

               <ul>
                  <?php $__currentLoopData = Session::get('import_errors'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $failure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                  

                          <li><p><?php echo e("ON SERIAL NO. "); ?> &nbsp; <?php echo e($failure->row()-1); ?> &nbsp; <?php echo e($failure->errors()[0]); ?> </P></li>
                          

                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </ul>
               <strong>REST OF USER DATA IMPORTED SUCSESFULLY!!!</strong>
               <button type="button" class="close" style="font-size: 2.25rem;" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
         <?php endif; ?>
    <div class="all-button-box row d-flex justify-content-end">
      
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="<?php echo e(__('Create User')); ?>" data-url="<?php echo e(route('admin.usersCreate')); ?>">
                    <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"  data-url="<?php echo e(route('admin.dashboard')); ?>">
                    <i class="fas fa-plus"></i> <?php echo e(__('bulk create')); ?>

                </a>
            </div>
       
    </div>
    <div class="modal fade" id="csvdata" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <h4 class="h4 font-weight-400 float-left modal-title">List of Users</h4>
                    <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close"><?php echo e(__('Close')); ?></a>
                </div>
                <form action="<?php echo e(route('admin.dashboard')); ?>" method="POST" id="csv_form_id_new" enctype="multipart/form-data">
                    <input type="hidden" name="json_allrows" id="" class="json_allrows" value=''>
                    <div class="modal-body">

                        <div class="card bg-none card-box">
                            <div style="overflow-x: auto;">
                            <table id="tablerow">
                                <thead>
                                    <th align="center" class="">
                                        <input type="checkbox" name="checkall" id="select_all_user" />
                                    </th>
                                    <th>IPPIS Number</th>
                                    <th>Staff Id</th>
                                    <th>First Name</th>
                                    <th>Last name</th>
                                    <th>E-Mail Address</th>
                                    <th>Password</th>
                                    <th>Organization</th>
                                    <th>Gender</th>
                                    <th>Date of Current Posting</th>
                                    <th>Role</th>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                            </div>

                            <div class="form-group col-12 text-right pb-3">
                                <input type="submit" value="<?php echo e(__('Create')); ?>" id="create_bulkuser_btn" class="btn-create badge-blue">
                            </div>
                        </div>
                    </div>
                </form>
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
                        <table class=" users_dataTablexxx">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Id')); ?></th>
                                <th><?php echo e(__('IPPIS Number')); ?></th>
                                <th><?php echo e(__('User Id')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Activity')); ?></th>z
                                <th><?php echo e(__('type')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                              

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\backend-pms\resources\views/admin/users/index.blade.php ENDPATH**/ ?>