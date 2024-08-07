<?php $__env->startComponent('mail::layout'); ?>

<?php $__env->slot('header'); ?>
<?php $__env->startComponent('mail::header', ['url' => config('app.url')]); ?>
<?php echo $mail_header; ?>

<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>


<?php echo $content; ?>



<?php if(isset($subcopy)): ?>
<?php $__env->slot('subcopy'); ?>
<?php $__env->startComponent('mail::subcopy'); ?>
<?php echo e($subcopy); ?>

<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php endif; ?>


<?php $__env->slot('footer'); ?>
<?php $__env->startComponent('mail::footer'); ?>
© <?php echo e(date('Y')); ?> <?php echo $mail_header; ?>. <?php echo app('translator')->get('All rights reserved.'); ?>
<?php echo $__env->renderComponent(); ?>
<?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<?php /**PATH /home/deveduco/public_html/admin/resources/views/email/common_email_template.blade.php ENDPATH**/ ?>