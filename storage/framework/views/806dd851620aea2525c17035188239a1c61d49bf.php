<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Roles')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="all-button-box row d-flex justify-content-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Role')): ?>
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="<?php echo e(route('roles.create')); ?>" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Role')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto">
                    <i class="fas fa-plus"></i> <?php echo e(__('Create')); ?>

                </a>
            </div>
    <?php endif; ?>
    <!-- <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Permissions')): ?>
        <a href="<?php echo e(route('permissions.index')); ?>" class="btn btn-primary btn-sm"><i class="fas fa-lock"></i> <?php echo e(__('Permissions')); ?> </a>
    <?php endif; ?> -->
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
                                <th><?php echo e(__('Role')); ?></th>
                                <th><?php echo e(__('Permissions')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Role"><?php echo e($role->name); ?></td>
                                    <td class="Permission">
                                        <?php $__currentLoopData = $role->permissions()->pluck('name'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="#" class="absent-btn"><?php echo e($permission); ?></a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td class="Action">
                                        <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Role')): ?>
                                                <a href="#" data-url="<?php echo e(URL::to('roles/'.$role->id.'/edit')); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Role')); ?>" class="edit-icon"><i class="fas fa-pencil-alt"></i></a>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Role')): ?>
                                                <a href="#" class="delete-icon"  data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($role->id); ?>').submit();"><i class="fas fa-trash"></i></a>
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['roles.destroy', $role->id],'id'=>'delete-form-'.$role->id]); ?>

                                                <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/roles/index.blade.php ENDPATH**/ ?>