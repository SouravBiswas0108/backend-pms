

<nav class="navbar navbar-main navbar-expand-lg navbar-border n-top-header" id="navbar-main">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-main-collapse" aria-controls="navbar-main-collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-user d-lg-none ml-auto">
            <ul class="navbar-nav flex-row align-items-center">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                <!-- <?php if(\Auth::user()->type != 'Super Admin'): ?>
                    <li class="nav-item">
                        <a href="#" class="nav-link nav-link-icon text-dark" data-action="omnisearch-open" data-target="#omnisearch"><i class="fas fa-search"></i></a>
                    </li>
                <?php endif; ?> -->
                <?php if(Auth::user()->type != 'Super Admin' && Auth::user()->type != 'Client'): ?>
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link nav-link-icon message-toggle-msg" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope m-0 text-dark"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0 float-left"><?php echo e(__('Messages')); ?></h5>
                                <a href="#" class="link link-sm mark_all_as_read_message float-right"><?php echo e(__('Marl All As Read')); ?></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="list-group list-group-flush max-380 dropdown-list-message-msg">
                            </div>
                            <div class="py-3 text-center">
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="link link-sm link--style-3"><?php echo e(__('View all')); ?></a>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type != 'Super Admin'): ?>
                    <li class="nav-item dropdown dropdown-animate">
                        <?php
                            $notifications = \Auth::user()->notifications();
                        ?>
                      
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-menu-arrow p-0 notification-dropdown">
                            <div class="py-3 px-3">
                                <h5 class="heading h6 mb-0 float-left"><?php echo e(__('Notifications')); ?></h5>
                                <a href="#" class="link link-sm mark_all_as_read float-right"><?php echo e(__('Marl All As Read')); ?></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="list-group list-group-flush max-380" id="notification-list-mini">
                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php echo $notification->toHtml(); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>
                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="<?php if(Auth::user()->avatar): ?> <?php echo e(asset('/storage/avatars/'.Auth::user()->avatar)); ?> <?php else: ?> <?php echo e(asset('/public/assets/img/avatar/avatar-1.png')); ?> <?php endif; ?>">
                          </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0"><?php echo e(__('Hi,')); ?> <?php echo e(Auth::user()->name); ?>!</h6>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="dropdown-item">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                        </a>
                    </div>
                </li>
            </ul>
        </div>

        <div class="collapse navbar-collapse navbar-collapse-fade" id="navbar-main-collapse">
            <ul class="navbar-nav align-items-center d-none d-lg-flex">
                <li class="nav-item">
                    <a href="#" class="nav-link nav-link-icon sidenav-toggler" data-action="sidenav-pin" data-target="#sidenav-main"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item dropdown dropdown-animate">
                    <a class="nav-link pr-lg-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media media-pill align-items-center">
                            <span class="avatar rounded-circle">
                              <img src="<?php if(Auth::user()->avatar): ?> <?php echo e(asset('/storage/avatars/'.Auth::user()->avatar)); ?> <?php else: ?> <?php echo e(asset('/public/assets/img/avatar/avatar-1.png')); ?> <?php endif; ?>">
                            </span>
                            <div class="ml-2 d-none d-lg-block">
                                <span class="mb-0 text-sm  font-weight-bold"><?php echo e((Auth::user()->fname!='') ? ucfirst(trans(Auth::user()->fname)) : ''); ?> <?php echo e((Auth::user()->mid_name!='') ? ucfirst(trans(Auth::user()->mid_name)) : ''); ?> <?php echo e((Auth::user()->lname!='') ? ucfirst(trans(Auth::user()->lname)) : ''); ?></span>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right dropdown-menu-arrow">
                        <h6 class="dropdown-header px-0"><?php echo e(__('Hi,')); ?> <?php echo e((Auth::user()->fname!='') ? ucfirst(trans(Auth::user()->fname)) : ''); ?> <?php echo e((Auth::user()->mid_name!='') ? ucfirst(trans(Auth::user()->mid_name)) : ''); ?> <?php echo e((Auth::user()->lname!='') ? ucfirst(trans(Auth::user()->lname)) : ''); ?>!</h6>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="dropdown-item">
                            <i class="fas fa-user"></i>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> <?php echo e(__('Logout')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('admin.dashboard')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
                <li class="nav-item">
                    
                </li>

            </ul>

            <ul class="navbar-nav ml-lg-auto align-items-lg-center">
               
               
            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\backend-pms\resources\views/admin/partials/admin/topbar.blade.php ENDPATH**/ ?>