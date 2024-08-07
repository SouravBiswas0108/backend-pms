

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Add New FAQ')); ?>

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
                        <form class="pl-3 pr-3" method="post" action="<?php echo e(route('faq.store')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="question"><?php echo e(__('Enter question *')); ?></label>
                                    <input type="text" name="question" class="form-control" required>
                                    
                                </div>
                                <div class="col-6 form-group"></div>

                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="answer"><?php echo e(__('Answer *')); ?></label>
                                    <textarea name="answer" class="form-control tinymce answer" id="full-featured-non-premium" rows="10" cols="100"></textarea>
                                </div>
                                <div class="col-6 form-group"></div>

                                <div class="form-group col-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Submit')); ?>" class="btn-create badge-blue btn btn-xs btn-white btn-icon-only width-auto edit-icon userrole-btn">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/faq/faq_create.blade.php ENDPATH**/ ?>