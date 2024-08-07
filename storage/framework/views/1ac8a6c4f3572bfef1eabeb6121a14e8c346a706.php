<?php $__env->startSection('title'); ?>
    <?php echo e(__('Reset Password')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="login-form">
        <div class="page-title"><h5><?php echo e(__('Reset Password')); ?></h5></div>
        <?php if(session('status')): ?>
            <div class="alert alert-primary">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>
        <!-- <p class="text-xs text-muted"><?php echo e(__('We will send a link to reset your password')); ?></p> -->
<!--         <form method="POST" action="<?php echo e(route('password.email')); ?>">
        <form method="" action=""> -->
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="email" class="form-control-label"><?php echo e(__('E-Mail Address')); ?></label>
                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus>
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <small><?php echo e($message); ?></small>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <span class="error_msg_fpswrd" style="display: none; color: red">
                    <small>Reset Link not Send Due to SMTP Not Setup!!!</small>
                </span>
            <button type="submit" class="btn-login click_fpswrd"><?php echo e(__('Send Password Reset Link')); ?></button>
            <div class="or-text"><?php echo e(__('OR')); ?></div>
            <div class="text-xs text-muted text-center">
                <?php echo e(__("Back to")); ?> <a href="<?php echo e(route('login',$lang)); ?>"><?php echo e(__('Login')); ?></a>
            </div>
        <!-- </form> -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/auth/forgot-password.blade.php ENDPATH**/ ?>