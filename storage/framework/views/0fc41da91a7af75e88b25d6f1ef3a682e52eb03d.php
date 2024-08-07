

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Assign Duties to User')); ?>

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
                                <th><?php echo e(__('IPPIS Number')); ?></th>
                                <th><?php echo e(__('User Id')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('type')); ?></th>
                                <th width="300px"><?php echo e(__('Duties')); ?></th>

                                <th width="300px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                              <tbody>
                            <?php if(count($users) > 0): ?>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($user->is_active == 1): ?>
                                        <tr>
                                            <td  style="color:black;"><?php echo e(($user->ippis_no!='') ? $user->ippis_no : ''); ?></td>
                                            <td  style="color:black;"><?php echo e(($user->staff_id!='') ? $user->staff_id : ''); ?></td>
                                            <td  style="color:black;"><a href="<?php echo e(route('users.show',$user->id)); ?>"><?php echo e(($user->fname!='') ? $user->fname : ''); ?> <?php echo e(($user->mid_name!='') ? $user->mid_name : ''); ?> <?php echo e(($user->lname!='') ? $user->lname : ''); ?></a></td>
                                            
                                            <td style="color:black;"><?php echo e(($user->type!='') ? $user->type : ''); ?></td>


                                            

                                            <td>  
                                            <?php $counter = 1; ?>
                                            <?php if(!empty($user->alreadyassignduties)): ?> 
                                                <?php $__currentLoopData = $user->alreadyassignduties; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alreadyassignduties_show): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    

                                                    <a href="<?php echo e(url('/duties/edit/'.strtr(base64_encode($user['staff_id']), '+/=', '-_A').'/'.strtr(base64_encode($alreadyassignduties_show['id']), '+/=', '-_A'))); ?>" class="btn btn-sm mr-1 p-0 rounded-circle usertypeClass" 
                                                    details="userType_<?php echo e($counter); ?>_<?php echo e($user['staff_id']); ?>" 
                                                    value="<?php echo e($alreadyassignduties_show['assign_type']); ?>">
                                                        <?php $assign_type_name = ''; 
                                                        if($alreadyassignduties_show['assign_type']==001){
                                                            $assign_type_name = 'Staff';
                                                        }
                                                        if($alreadyassignduties_show['assign_type']==002){
                                                            $assign_type_name = 'Supervisor';
                                                        }
                                                        if($alreadyassignduties_show['assign_type']==003){
                                                            $assign_type_name = 'Officer';
                                                        }
                                                        if($alreadyassignduties_show['assign_type']==004){
                                                            $assign_type_name = 'Manager';
                                                        }
                                                        if($alreadyassignduties_show['assign_type']==005){
                                                            $assign_type_name = 'CEO';
                                                        }
                                                        
                                                        ?>
                                                        
                                                        <i class="fas fa-arrow-circle-right"></i>
                                                        <p class="assign_type_name" id="userType_<?php echo e($counter); ?>_<?php echo e($user['staff_id']); ?>" style="display: none;"><?php echo e($assign_type_name); ?></p>
                                                    </a>
                                                    <?php $counter++; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                            </td>


                                            <?php if(Auth::user()->type != 'Client'): ?>
                                                <td class="Action">
                                                    <span>
                                                        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">

                                                            <a href="<?php echo e(url('/duties/'.strtr(base64_encode($user->staff_id), '+/=', '-_A'))); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"  data-title="<?php echo e(__('Create Duties')); ?>" style="padding: 4px 15px !important; min-width: 115px !important;">
                                                                 <?php echo e(__('Assign Duties')); ?>

                                                            </a>
                                                        </div>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/duties/index.blade.php ENDPATH**/ ?>