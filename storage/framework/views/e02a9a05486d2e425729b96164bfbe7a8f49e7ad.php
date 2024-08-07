<?php $__env->startSection('title'); ?>
    <?php echo e(__('Top 30 Employees by performence rating on')); ?>

    <?php if(session('year2')==date('Y')): ?>
    <?php echo e(date("Y-m-d")); ?>

    <?php else: ?>
    <?php echo e(session('year2')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped dataTable_for_user_performence_rating_by_department">
                            <thead>
                            <tr>
                                <th><?php echo e(__('IPPIS No.')); ?></th>
                                <!-- <th><?php echo e(__('UserId')); ?></th> -->
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Department')); ?></th>
                                <th><?php echo e(__('Perform Rating')); ?></th>
                            </tr>
                            </thead>
                              <tbody>

                            <?php if(count($alldata) > 0): ?>
                                <?php $__currentLoopData = $alldata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alldatas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td  style="color:black;"><?php echo e(($alldatas['userdetails']['ippis_no']!='') ? $alldatas['userdetails']['ippis_no'] : ''); ?></td>

                                            <!-- <td  style="color:black;"><?php echo e(($alldatas['userdetails']['staff_id']!='') ? $alldatas['userdetails']['staff_id'] : ''); ?></td> -->

                                            <td  style="color:black;"><a href="<?php echo e(url('/users/show/'.strtr(base64_encode($alldatas['userdetails']['id']), '+/=', '-_A'))); ?>"><?php echo e(($alldatas['userdetails']['fname']!='') ? $alldatas['userdetails']['fname'] : ''); ?> <?php echo e(($alldatas['userdetails']['mid_name']!='') ? $alldatas['userdetails']['mid_name'] : ''); ?> <?php echo e(($alldatas['userdetails']['lname']!='') ? $alldatas['userdetails']['lname'] : ''); ?></a></td>

                                            <td style="color:black;"><?php echo e($alldatas['dept_name']['dept_name'] ?? ''); ?></td>


                                            <td style="color:black;"><?php echo e($alldatas['total_performence_ratng'] ? $alldatas['total_performence_ratng'] : '-'); ?></td>


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


<?php echo $__env->make('layouts.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/users/top_thirty_employees_by_performence_rating.blade.php ENDPATH**/ ?>