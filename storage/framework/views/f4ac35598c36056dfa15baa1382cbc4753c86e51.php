<?php $__env->startSection('title'); ?>
    <?php echo e(__('Login')); ?>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="login-form">
        <div class="page-title"><h5><?php echo e(__('Login')); ?></h5></div>
        <form method="POST" action="<?php echo e(route('login')); ?>" class="needs-validation" novalidate="">
            <?php echo csrf_field(); ?>
            <?php if(session('error')): ?>
            <div class="alert alert-danger">
                <?php echo e(session('error')); ?>

            </div>
            <?php endif; ?>
            <div class="form-group">
                <label class="form-control-label"><?php echo e(__('E-Mail Address')); ?></label>
                <input id="email" type="email" class="form-control  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
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
            <div class="form-group">
                <label class="form-control-label"><?php echo e(__('Password')); ?></label>
                <input id="password" type="password" class="form-control  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required>
                <?php $__errorArgs = ['password'];
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
            <div class="custom-control custom-checkbox remember-me-text">
                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> class="custom-control-input" id="remember-me">
                <label class="custom-control-label" for="remember-me"><?php echo e(__('Remember Me')); ?></label>
            </div>
            <div class="text-xs text-muted text-center">
                <a href="<?php echo e(route('password.request',$lang)); ?>" class="text-xs"><?php echo e(__('Forgot Your Password?')); ?></a>
            </div>
            <button type="submit" class="btn-login" tabindex="4"><?php echo e(__('Login')); ?></button>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/auth/login.blade.php ENDPATH**/ ?>