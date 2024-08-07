<?php
    $SITE_RTL = env('SITE_RTL');
    if($SITE_RTL == ''){
        $SITE_RTL = 'off';
    }
?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" dir="<?php echo e($SITE_RTL == 'on'?'rtl':''); ?>">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title> <?php echo $__env->yieldContent('title'); ?> &dash; <?php echo e($settings["header_text"]); ?></title>

    <!-- Favicon -->
    <!-- <link rel="icon" href="<?php echo e(asset(Storage::url('logo/favicon.png'))); ?>" type="image"> -->
    <link rel="icon" href="<?php echo e(asset('/storage/logo/favicon.png')); ?>" type="image">    
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?php echo e(asset('/assets/libs/@fortawesome/fontawesome-free/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/css/site.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/css/ac.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/assets/css/stylesheet.css')); ?>">
    <?php if($SITE_RTL=='on'): ?>
        <link rel="stylesheet" href="<?php echo e(asset('/css/bootstrap-rtl.css')); ?>">
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>

<body>

<div class="login-contain">
    <div class="login-inner-contain">
        <a class="navbar-brand" href="#">
            <!-- <img src="<?php echo e(asset(Storage::url('logo/logo-full.png'))); ?>" alt="<?php echo e(config('app.name', 'Federal Ministry of Industry, Trade and Investment')); ?>" class="navbar-brand-img"> -->
            <img src="<?php echo e(asset('/storage/logo/logo-full.png')); ?>" alt="<?php echo e(config('app.name', 'Federal Ministry of Industry, Trade and Investment')); ?>" class="navbar-brand-img">
        </a>
        <?php echo $__env->yieldContent('content'); ?>
        <h5 class="copyright-text">
            <?php echo e($settings["footer_text"]); ?>

        </h5>
        <?php echo $__env->yieldContent('language-bar'); ?>
    </div>
</div>
<script src="<?php echo e(asset('/assets/js/jquery.min.js')); ?>"></script>
<script>
    var toster_pos="<?php echo e($SITE_RTL =='on' ?'left' : 'right'); ?>";
</script>
<script src="<?php echo e(asset('/assets/js/new-custom.js')); ?>"></script>
<?php echo $__env->yieldPushContent('script'); ?>
</body>
</html>
<?php /**PATH C:\laragon\www\backend-pms\resources\views/admin/layouts/auth.blade.php ENDPATH**/ ?>