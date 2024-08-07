<div class="card bg-none card-box">
    <?php echo e(Form::model($role, array('route' => array('roles.update', $role->id), 'method' => 'PUT'))); ?>

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('name', __('Role Name'),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('name', null, array('class' => 'form-control'))); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <?php echo e(Form::label('permissions', __('Assign Permissions'),['class'=>'form-control-label'])); ?>

                <div class="row gutters-xs">
                    <table class="table table-striped">
                        <tr>
                            <th class="text-dark"><?php echo e(__('Module')); ?></th>
                            <th class="text-dark"><?php echo e(__('Permissions')); ?></th>
                        </tr>
                        <tr>
                            
                        </tr>
                        <?php
                        $modules = [
                            'User',
                            'Role',
                            // 'Lead',
                            // 'Deal',
                            // 'Estimation',
                            // 'Task',
                            
                        ];

                        if(\Auth::user()->type == 'Super Admin')
                        {
                            $modules[] = 'Language';
                        }

                        //            $modules[] = 'Plan';
                        //            $modules[] = 'Permission';
                        ?>

                        <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php

                            if($module == 'Expense Category')
                            {
                                $s_name = 'Expense Categories';
                            }
                            elseif($module == 'Company')
                            {
                                $s_name = 'Companies';
                            }
                            elseif($module == 'Tax')
                            {
                                $s_name = 'Taxes';
                            }
                            elseif($module == 'Manage MDF Status')
                            {
                                $s_name = 'MDF Status';
                            }
                            else
                            {
                                $s_name = $module . "s";
                            }
                            ?>
                            <tr>
                                <td><?php echo e(__($module)); ?></td>
                                <td>
                                    <div class="row">
                                        <?php if(in_array('Manage '.$s_name,$permissions)): ?>
                                            <?php ($key = array_search('Manage '.$s_name, $permissions)); ?>
                                            <div class="col-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                                <?php echo e(Form::label('permission_'.$key, 'Manage',['class'=>'custom-control-label font-weight-500'])); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(in_array('Create '.$module,$permissions)): ?>
                                            <?php ($key = array_search('Create '.$module, $permissions)); ?>
                                            <div class="col-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                                <?php echo e(Form::label('permission_'.$key, __('Create'),['class'=>'custom-control-label font-weight-500'])); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(in_array('Request '.$module,$permissions)): ?>
                                            <?php ($key = array_search('Request '.$module, $permissions)); ?>
                                            <div class="col-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                                <?php echo e(Form::label('permission_'.$key, __('Request'),['class'=>'custom-control-label font-weight-500'])); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(in_array('Edit '.$module,$permissions)): ?>
                                            <?php ($key = array_search('Edit '.$module, $permissions)); ?>
                                            <div class="col-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                                <?php echo e(Form::label('permission_'.$key, __('Edit'),['class'=>'custom-control-label font-weight-500'])); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(in_array('Delete '.$module,$permissions)): ?>
                                            <?php ($key = array_search('Delete '.$module, $permissions)); ?>
                                            <div class="col-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                                <?php echo e(Form::label('permission_'.$key, __('Delete'),['class'=>'custom-control-label font-weight-500'])); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(in_array('View '.$module,$permissions)): ?>
                                            <?php ($key = array_search('View '.$module, $permissions)); ?>
                                            <div class="col-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                                <?php echo e(Form::label('permission_'.$key, __('View'),['class'=>'custom-control-label font-weight-500'])); ?>

                                            </div>
                                        <?php endif; ?>
                                        <?php if(in_array('Move '.$module,$permissions)): ?>
                                            <?php ($key = array_search('Move '.$module, $permissions)); ?>
                                            <div class="col-3 custom-control custom-checkbox">
                                                <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                                <?php echo e(Form::label('permission_'.$key, __('Move'),['class'=>'custom-control-label font-weight-500'])); ?>

                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e(__('Other')); ?></td>
                            <td>
                                <div class="row">
                                   <!--  <?php if(in_array('Manage Invoice Payments',$permissions)): ?>
                                        <?php ($key = array_search('Manage Invoice Payments', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Manage Invoice Payments'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('Create Invoice Payment',$permissions)): ?>
                                        <?php ($key = array_search('Create Invoice Payment', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Create Invoice Payment'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('Invoice Add Product',$permissions)): ?>
                                        <?php ($key = array_search('Invoice Add Product', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Invoice Add Product'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('Invoice Edit Product',$permissions)): ?>
                                        <?php ($key = array_search('Invoice Edit Product', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Invoice Edit Product'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('Invoice Delete Product',$permissions)): ?>
                                        <?php ($key = array_search('Invoice Delete Product', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Invoice Delete Product'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php if(in_array('Estimation Add Product',$permissions)): ?>
                                        <?php ($key = array_search('Estimation Add Product', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Estimation Add Product'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('Estimation Edit Product',$permissions)): ?>
                                        <?php ($key = array_search('Estimation Edit Product', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Estimation Edit Product'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('Estimation Delete Product',$permissions)): ?>
                                        <?php ($key = array_search('Estimation Delete Product', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Estimation Delete Product'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>

                                    <?php if(in_array('MDF Add Expense',$permissions)): ?>
                                        <?php ($key = array_search('MDF Add Expense', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('MDF Add Expense'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('MDF Edit Expense',$permissions)): ?>
                                        <?php ($key = array_search('MDF Edit Expense', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('MDF Edit Expense'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('MDF Delete Expense',$permissions)): ?>
                                        <?php ($key = array_search('MDF Delete Expense', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('MDF Delete Expense'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?> -->

                                    <?php if(in_array('Manage Email Templates',$permissions)): ?>
                                        <?php ($key = array_search('Manage Email Templates', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Manage Email Templates'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('Edit Email Template',$permissions)): ?>
                                        <?php ($key = array_search('Edit Email Template', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Edit Email Template'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                    <?php if(in_array('On-Off Email Template',$permissions)): ?>
                                        <?php ($key = array_search('On-Off Email Template', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('On-Off Email Template'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?>
                                   <!--  <?php if(in_array('Edit Email Template Lang',$permissions)): ?>
                                        <?php ($key = array_search('Edit Email Template Lang', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Edit Email Template Lang'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?> -->
                                    <!-- <?php if(in_array('Convert Lead To Deal',$permissions)): ?>
                                        <?php ($key = array_search('Convert Lead To Deal', $permissions)); ?>
                                        <div class="col-6 custom-control custom-checkbox">
                                            <?php echo e(Form::checkbox('permissions[]',$key,$role->permissions,['class' => 'custom-control-input','id'=>'permission_'.$key])); ?>

                                            <?php echo e(Form::label('permission_'.$key, __('Convert Lead To Deal'),['class'=>'custom-control-label font-weight-500'])); ?>

                                        </div>
                                    <?php endif; ?> -->
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="col-12 text-right">
                <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn-create badge-blue">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
    </div>
    <?php echo e(Form::close()); ?>

</div>
<?php /**PATH /home/deveduco/public_html/admin/resources/views/roles/edit.blade.php ENDPATH**/ ?>