

<?php $__env->startSection('title'); ?>
    <?php echo e(__('FAQ List')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-button-box">
                <a href="<?php echo e(route('faq.create')); ?>" data-size="lg" data-title="<?php echo e(__('Add Faq')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('Add')); ?> </a>
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
                        <table class="table table-striped faq_dataTable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Number')); ?></th>
                                    <th><?php echo e(__('Question')); ?></th>
                                    <th><?php echo e(__('Answer')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;?>
                                <?php if(count($faqlist) > 0): ?>
                                    <?php $__currentLoopData = $faqlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faqlistdata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td  style="color:black;"><?php echo e($i++); ?></td>
                                                
                                                <td  style="color:black;"><?php echo e(isset($faqlistdata['question'])? (strlen($faqlistdata['question']) > 20 ? substr($faqlistdata['question'],0,20)."..." : $faqlistdata['question']) : ''); ?>

                                                </td>
                                                
                                                <td  style="color:black;"><?php echo e(isset($faqlistdata['answer'])? (strlen($faqlistdata['answer']) > 20 ? substr($faqlistdata['answer'],0,20)."..." : $faqlistdata['question']) : ''); ?></td>

                                                <td class="Action">
                                                    <span>
                                                        
                                                        <a href="<?php echo e(url('/faq/edit/'.strtr(base64_encode($faqlistdata['id']), '+/=', '-_A'))); ?>" class="edit-icon" data-title="<?php echo e(__('Edit User')); ?>">
                                                            <i class="fas fa-pencil-alt"></i></a>
                                                        
                                                        <a class="delete-icon" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('faq-delete-form-<?php echo e(strtr(base64_encode($faqlistdata['id']), '+/=', '-_A')); ?>').submit();">
                                                            <i class="fas fa-trash"></i></a>
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['faq.delete', strtr(base64_encode($faqlistdata['id']), '+/=', '-_A')],'id'=>'faq-delete-form-'.strtr(base64_encode($faqlistdata['id']), '+/=', '-_A')]); ?>

                                                            <?php echo Form::close(); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr class="font-style">
                                        <td colspan="4" class="text-center"><?php echo e(__('No data available in table')); ?></td>
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/faq/faq_list.blade.php ENDPATH**/ ?>