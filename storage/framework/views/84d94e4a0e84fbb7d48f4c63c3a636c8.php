<?php
    use App\Models\User;
    use App\Models\DashboardMenu;

    $user = \Auth::user();
    if($user->type == 'Admin')
    {
        $arrCount['sidebar_menus']  = DashboardMenu::where('staff_id',$user->staff_id)->first();
        $arrCount['sidebar_menus']  = isset($arrCount['sidebar_menus']['sidebar_menus'])?json_decode($arrCount['sidebar_menus']['sidebar_menus'], true):[];

    }
?>
<div class="sidenav custom-sidenav" id="sidenav-main">
    <div class="sidenav-header d-flex align-items-center">
        <a style="background-color: #fff;margin: 0px 10px;border-radius: 10px;" class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">
        <img src="<?php echo e(asset('admin/logo/logo-full.png')); ?>" alt="<?php echo e(config('app.name', 'LeadGo')); ?>" class="navbar-brand-img">
        </a>
        <div class="ml-auto">
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin" data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                    <i class="sidenav-toggler-line bg-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="scrollbar-inner">
        <div class="div-mega">
            <ul class="navbar-nav navbar-nav-docs">
                <?php if((\Auth::user()->type != 'Owner')): ?>
                <li class="nav-item" style="font-weight: 400;">
                    <?php echo e(Auth::user()->org_name); ?>

                </li>
                <?php endif; ?>
                <select id="blocked-element" class="year-filter year-filter-design" name="year">
                    <?php for($i=2020;$i<=date('Y')+1;$i++): ?>

                    <option value=<?php echo e($i); ?> <?php if(session('year2')==$i ||(!session()->has('year2') && date('Y')==$i) ): ?> <?php echo e('selected'); ?> <?php endif; ?>><?php echo e($i); ?>

                    </option>
                    <?php endfor; ?>
                </select>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'home') ? 'active' : ''); ?>">
                        <i class="fas fa-fire"></i><?php echo e(__('Dashboard')); ?>

                    </a> 
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'home') ? 'active' : ''); ?>">
                        <i class="fas fa-fire"></i><?php echo e(__('Users')); ?>

                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo e(route('admin.departments.index')); ?>">
                        <i class="fas fa-book"></i><?php echo e(__('Department')); ?>

                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e((Request::route()->getName() == 'home') ? 'active' : ''); ?>">
                        <i class="fas fa-fire"></i><?php echo e(__('Dashboard')); ?>

                    </a> 
                </li>
                
                <?php if(Gate::check('Manage Users') || Gate::check('Manage Clients') || Gate::check('Manage Roles') || Gate::check('Manage Permissions')): ?>
                    <?php if((\Auth::user()->type == 'Owner')): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Users')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e(request()->is('users*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-users"></i><?php echo e(__('Users')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Users')): ?>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-book"></i><?php echo e(__('Department')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo e(route('admin.dashboard')); ?>">
                                <i class="fas fa-users"></i><?php echo e(__('Assign Duties')); ?>

                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Roles')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::route()->getName() == 'roles.index') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-user-cog"></i><?php echo e(__('Roles')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Users')): ?>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-book"></i><?php echo e(__('MPMS Form')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('System Settings')): ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo e((Request::route()->getName() == 'settings') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-cogs"></i><?php echo e(__('System Settings')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                                <i class="fas fa-info"></i><?php echo e(__('FAQ')); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if((\Auth::user()->type == 'Admin')): ?>
                        <?php if(in_array("1", $arrCount['sidebar_menus'])): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Users')): ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php echo e(request()->is('users*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.dashboard')); ?>">
                                        <i class="fas fa-users"></i><?php echo e(__('Users')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(in_array("2", $arrCount['sidebar_menus'])): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Users')): ?>
                                <li class="nav-item">
                                    <a class="nav-link " href="<?php echo e(route('admin.dashboard')); ?>">
                                        <i class="fas fa-book"></i><?php echo e(__('Department')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php if(in_array("3", $arrCount['sidebar_menus'])): ?>
                            <li class="nav-item">
                                <a class="nav-link " href="<?php echo e(route('admin.dashboard')); ?>">
                                    <i class="fas fa-users"></i><?php echo e(__('Assign Duties')); ?>

                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if(in_array("4", $arrCount['sidebar_menus'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo e(route('admin.dashboard')); ?>">
                                <i class="fas fa-info"></i><?php echo e(__('FAQ')); ?>

                            </a>
                        </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span><?php echo e(__('Logout')); ?></span>
                        </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/Office/backend-fmepms/backend-pms/resources/views/admin/partials/admin/navbar.blade.php ENDPATH**/ ?>