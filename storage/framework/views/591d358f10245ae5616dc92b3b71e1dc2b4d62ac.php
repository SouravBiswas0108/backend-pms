<?php $__env->startSection('title'); ?>
    <?php echo e($user->fname); ?> <?php echo e($user->mid_name); ?> <?php echo e($user->lname.__("'s Detail")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-12">
            <div class="card profile-card">
                <div class="icon-user avatar rounded-circle">
                    <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/avatars/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/assets/img/avatar/avatar-1.png')); ?>" <?php endif; ?>>
                </div>
                <h4 class="h4 mb-0 mt-2"><?php echo e($user->fname); ?> <?php echo e($user->mid_name); ?> <?php echo e($user->lname); ?></h4>
                <div class="sal-right-card">
                    <span class="badge badge-pill badge-blue"><?php echo e($user->type); ?></span>
                </div>
                <h6 class="office-time mb-0 mt-4"><?php echo e($user->email); ?></h6>
                <?php if($user->avatar!=''): ?>
                    <div class="mt-4">
                        <a href="#" class="delete-icon" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete Profile Photo')); ?>" onclick="document.getElementById('delete_avatar').submit();"><i class="fas fa-trash"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-8 col-sm-12">
            <section class="col-lg-12 pricing-plan card">
                <div class="our-system password-card p-3">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li>
                                <a data-toggle="tab" href="#personal_info" class="active"><?php echo e(__('Personal info')); ?></a>
                            </li>
                            <li>
                                <a data-toggle="tab" href="#change_password" class=""><?php echo e(__('Change Password')); ?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div id="personal_info" class="tab-pane in active">
                                <form method="post" action="<?php echo e(route('update.profile')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="name" class="form-control-label text-dark"><?php echo e(__('First Name')); ?></label>
                                                <input class="form-control <?php $__errorArgs = ['fname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="fname" type="text" id="fname" placeholder="<?php echo e(__('Enter Your First Name')); ?>" value="<?php echo e($user->fname); ?>" required autocomplete="fname">

                                                <input type="hidden" name="user_ai_id" value="<?php echo e($user->id); ?>">
                                                <?php $__errorArgs = ['fname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="mid_name" class="form-control-label text-dark"><?php echo e(__('Middle Name')); ?></label>
                                                <input class="form-control <?php $__errorArgs = ['mid_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="mid_name" type="text" id="mid_name" placeholder="<?php echo e(__('Enter Your Middle Name')); ?>" value="<?php echo e($user->mid_name); ?>"  autocomplete="mid_name">

                                                <?php $__errorArgs = ['mid_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="lname" class="form-control-label text-dark"><?php echo e(__('Last Name')); ?></label>
                                                <input class="form-control <?php $__errorArgs = ['lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="lname" type="text" id="lname" placeholder="<?php echo e(__('Enter Your Last Name')); ?>" value="<?php echo e($user->lname); ?>" required autocomplete="lname">

                                                <?php $__errorArgs = ['lname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-sm-6">
                                            <div class="form-group">
                                                <label for="email" class="form-control-label text-dark"><?php echo e(__('Email')); ?></label>
                                                <input class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" type="text" id="email" placeholder="<?php echo e(__('Enter Your Email Address')); ?>" value="<?php echo e($user->email); ?>" readonly required autocomplete="email">
                                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <div class="choose-file">
                                                    <label for="avatar">
                                                        <div><?php echo e(__('Choose file here')); ?></div>
                                                        <input class="form-control" name="avatar" type="file" id="avatar" accept="image/*" data-filename="profile_update">
                                                    </label>
                                                    <p class="profile_update"></p>
                                                </div>
                                                <?php $__errorArgs = ['avatar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-feedback text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                            <span class="clearfix"></span>
                                            <span class="text-xs text-muted"><?php echo e(__('Please upload a valid image file. Size of image should not be more than 2MB.')); ?></span>
                                        </div>
                                        <div class="col-lg-12 text-right">
                                            <input type="submit" value="<?php echo e(__('Save Changes')); ?>" class="btn-create badge-blue">
                                        </div>
                                        <?php if(!empty(session('pwd_reset_msg')[$user->staff_id])): ?>
                                            <div class="pwd_reset_alert">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                                                <strong><?php echo e(session('pwd_reset_msg')[$user->staff_id]); ?></strong>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </form>
                                <?php if($user->avatar!=''): ?>
                                    <form action="<?php echo e(route('delete.avatar')); ?>" method="post" id="delete_avatar">
                                        <input type="hidden" name="user_ai_id" value="<?php echo e($user->id); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                <?php endif; ?>
                            </div>
                            <div id="change_password" class="tab-pane">
                                <form method="post" action="<?php echo e(route('update.userpassword')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                       <!--  <div class="col-lg-6 col-sm-6 form-group">
                                            <label for="old_password" class="form-control-label text-dark"><?php echo e(__('Old Password')); ?></label>
                                            <input class="form-control <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="old_password" type="password" id="old_password" required autocomplete="old_password" placeholder="<?php echo e(__('Enter Old Password')); ?>">
                                            <?php $__errorArgs = ['old_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>

                                        <div class="col-lg-6 col-sm-6 form-group">
                                            <label for="password" class="form-control-label text-dark"><?php echo e(__('Password')); ?></label>
                                            <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" type="password" required autocomplete="new-password" id="password" placeholder="<?php echo e(__('Enter Your Password')); ?>">
                                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-feedback text-danger text-xs" role="alert"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                        <div class="col-lg-6 col-sm-6 form-group">
                                            <label for="password_confirmation" class="form-control-label text-dark"><?php echo e(__('Confirm Password')); ?></label>
                                            <input class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password_confirmation" type="password" required autocomplete="new-password" id="password_confirmation" placeholder="<?php echo e(__('Enter Your Password')); ?>">
                                        </div> -->
                                        <input type="hidden" name="user_tbl_id" value="<?php echo e($user->id); ?>">
                                        <input type="hidden" name="user_type" value="<?php echo e($user->type); ?>">
                                        <input type="hidden" name="user_email" value="<?php echo e($user->email); ?>" >
                                        <input type="hidden" name="user_staff_id" value="<?php echo e($user->staff_id); ?>">
                                      
                                        <div class="col-lg-12 text-right">
                                            <input type="submit" value="<?php echo e(__('Change Password')); ?>" class="btn-create badge-blue">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped dataTable_user_list_new">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Key Reasult Areas ')); ?></th>
                                <th><?php echo e(__('job Objective (s)')); ?></th>
                                <th><?php echo e(__('Key Performance Indicators (KPIs)')); ?></th>
                                <th><?php echo e(__('Targets')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php if(count($kpi_details) > 0): ?>
                                    <?php $__currentLoopData = $kpi_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kpi_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
                                            <tr>
                                                <td  style="color:black;"><?php echo e(($kpi_detail['key_result_areas']!='') ? $kpi_detail['key_result_areas'] : ''); ?></td>

                                                <td  style="color:black;"><?php echo e(($kpi_detail['job_objects']!='') ? $kpi_detail['job_objects'] : ''); ?></td>

                                                <td  style="color:black;"><?php echo e(($kpi_detail['key_performance_indicators']!='') ? $kpi_detail['key_performance_indicators'] : ''); ?></td>

                                                <td style="color:black;"><?php echo e(($kpi_detail['planned_targets']!='') ? $kpi_detail['planned_targets'] : ''); ?></td>
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
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/users/show.blade.php ENDPATH**/ ?>