

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Monthly Form Fillup Users')); ?>

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
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create User')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="<?php echo e(__('Create User')); ?>" data-url="<?php echo e(route('users.create')); ?>">
                    <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"  data-url="<?php echo e(route('bulk_create')); ?>">
                    <i class="fas fa-plus"></i> <?php echo e(__('Bulk Upload')); ?>

                </a>
            </div>


            <!-- <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <form action="<?php echo e(route('userCreateFromCsv')); ?>" method="POST" id="csv_form_id" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>


                    <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto"  data-title="<?php echo e(__('Create Bulk User')); ?>" >
                        <input type="file" name="file" class="form-control" id="csv">
                         <?php echo e(__('Bulk Add')); ?>

                    </a>

                </form>
            </div> -->
        <?php endif; ?>
    </div>
    <div class="modal fade" id="csvdata" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div>
                    <h4 class="h4 font-weight-400 float-left modal-title">List of Users</h4>
                    <a href="#" class="more-text widget-text float-right close-icon" data-dismiss="modal" aria-label="Close"><?php echo e(__('Close')); ?></a>
                </div>
                <form action="<?php echo e(route('Create_bulkuser')); ?>" method="POST" id="csv_form_id_new" enctype="multipart/form-data">
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
                        <table class="table table-striped dataTable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Id')); ?></th>
                                <th><?php echo e(__('IPPIS Number')); ?></th>
                                <th><?php echo e(__('User Id')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Activity')); ?></th>
                                <th><?php echo e(__('type')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                              <tbody>
                                
                            <?php if(count($users) > 0): ?>
                            
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->is_active == 1): ?>
                                        <tr>
                                            <td  style="color:black;"><?php echo e(($user->id!='') ? $user->id : ''); ?></td>
                                            <td  style="color:black;"><?php echo e(($user->ippis_no!='') ? $user->ippis_no : ''); ?></td>
                                            <td  style="color:black;"><?php echo e(($user->staff_id!='') ? $user->staff_id : ''); ?></td>
                                            <td  style="color:black; width: 20%"><a href="<?php echo e(url('/users/show/'.strtr(base64_encode($user->id), '+/=', '-_A'))); ?>"><?php echo e(($user->fname!='') ? $user->fname : ''); ?> <?php echo e(($user->mid_name!='') ? $user->mid_name : ''); ?> <?php echo e(($user->lname!='') ? $user->lname : ''); ?></a></td>
                                            <td style="color:black;"><?php echo e(($user->email!='') ? $user->email : ''); ?></td>

                                            <?php
                                                $user_status = isset($user->status) && !empty($user->status) ? 'checked' : '';
                                            ?>
                                            <td>
                                                <label class="switch">
                                                    <input type="checkbox" <?php echo e($user_status); ?> class="toggle_activity" value="<?php echo e(($user->id!='') ? base64_encode($user->id) : ''); ?>" data-toggle="<?php echo e(($user->status!='') ? $user->status : ''); ?>">

                                                    <span class="slider round"></span>
                                                </label>
                                            </td>



                                            <td style="color:black;"><?php echo e(($user->type!='') ? $user->type : ''); ?></td>
                                            <?php if(Auth::user()->type != 'Client'): ?>
                                                <td class="Action">
                                                    <span>
                                                        <?php if(\Auth::user()->type != 'Super Admin'): ?>
                                                            <a href="<?php echo e(url('/users/show/'.strtr(base64_encode($user->id), '+/=', '-_A'))); ?>" class="edit-icon bg-warning">
                                                                <i class="fas fa-eye"></i></a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit User')): ?>
                                                            <a href="javascript:void(0)" class="edit-icon" data-url="<?php echo e(url('/users/edit/'.strtr(base64_encode($user->staff_id), '+/=', '-_A'))); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit User')); ?>">
                                                            <i class="fas fa-pencil-alt"></i></a>
                                                        <?php endif; ?>

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete User')): ?>
                                                           <a class="delete-icon" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($user->id); ?>').submit();">
                                                            <i class="fas fa-trash"></i></a>
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id],'id'=>'delete-form-'.$user->id]); ?>

                                                            <?php echo Form::close(); ?>



                                                            

                                                        <?php endif; ?>
                                                    </span>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endif; ?>
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
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/users/index3.blade.php ENDPATH**/ ?>