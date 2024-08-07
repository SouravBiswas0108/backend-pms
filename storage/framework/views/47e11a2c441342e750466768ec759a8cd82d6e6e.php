<div class="card bg-none card-box">
    <form class="pl-3 pr-3" method="post" action="<?php echo e(route('test.email.send')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="col-12 form-group">
                <label for="email" class="form-control-label"><?php echo e(__('E-Mail Address')); ?></label>
                <input type="email" class="form-control" id="email" name="email" required/>
            </div>
            <div class="col-12 form-group text-right">
                <input type="submit" value="<?php echo e(__('Send Test Mail')); ?>" class="btn-create badge-blue">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal">
            </div>
        </div>
    </form>
</div>
<?php /**PATH /home/deveduco/public_html/admin/resources/views/users/test_email.blade.php ENDPATH**/ ?>