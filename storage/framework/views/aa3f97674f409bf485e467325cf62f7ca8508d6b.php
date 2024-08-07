<?php $__env->startSection('title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
   
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/assets/js/chart.min.js')); ?>"></script>
    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php
            $class = '';
            if(count($arrCount) < 4)
            {
                $class = 'col-lg-4 col-md-4';
            }
            else
            {
                $class = 'col-lg-3 col-md-3';
            }
        ?>
        <?php if((\Auth::user()->type == 'Owner')): ?>
            <?php if(isset($arrCount['user'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users')); ?>">
                        <div class="card card-box">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%;  font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Total User')); ?></div>
                            </div>
                            <div class="number-icon"><?php echo e($arrCount['user']); ?></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if(isset($arrCount['department'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('department')); ?>">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Total Department')); ?></div>
                        </div>
                        <div class="number-icon"><?php echo e($arrCount['department']); ?></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                    </a>
                </div>
            <?php endif; ?>
            
            <?php if(isset($arrCount['planning_contracts_user'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('planning_contracts.users')); ?>">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;">Planning Contracts<br>Fill up by Users</div>
                        </div>
                        <div class="number-icon"><?php echo e($arrCount['planning_contracts_user']); ?></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if(isset($arrCount['monthly_form_user'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('monthly.users')); ?>">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;">Monthy Form <br>Fillup by Users</div>
                        </div>
                        <div class="number-icon"><?php echo e($arrCount['monthly_form_user']); ?></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                    </a>
                </div>
            <?php endif; ?>
            
            <?php if(isset($arrCount['quarterly_form_user'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('quarterly.users')); ?>">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;">Quarterly Form <br>Fillup by Users</div>
                        </div>
                        <div class="number-icon"><?php echo e($arrCount['quarterly_form_user']); ?></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                    </a>
                </div>
            <?php endif; ?>
            
            <?php if(isset($arrCount['staff_have_supervisor'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('staff_have_supervisor.users')); ?>">
                    <div class="card card-box">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;">Number Of Staff <br>Have Supervisor</div>
                        </div>
                        <div class="number-icon"><?php echo e($arrCount['staff_have_supervisor']); ?></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                    </a>
                </div>
            <?php endif; ?>
            
            <div class="<?php echo e($class); ?> col-sm-6">
                <a href="<?php echo e(route('users.gradelevel')); ?>">
                    <div class="card card-box" style="height: 95px;">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Employee Performance Rating By Grade Level')); ?></div>
                        </div>
                        <div class="number-icon"></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                </a>
            </div>

            <div class="<?php echo e($class); ?> col-sm-6">
                <a href="<?php echo e(route('users.department')); ?>">
                    <div class="card card-box" style="height: 95px;">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Employee Performance Rating Score By Department')); ?></div>
                        </div>
                        <div class="number-icon"></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                </a>
            </div>

            <div class="<?php echo e($class); ?> col-sm-6">
                <a href="<?php echo e(route('users.top')); ?>">
                    <div class="card card-box" style="height: 95px;">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Top 30 Employees By Performance Rating')); ?></div>
                        </div>
                        <div class="number-icon"></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                </a>
            </div>

            <div class="<?php echo e($class); ?> col-sm-6">
                <a href="<?php echo e(route('users.bottom')); ?>">
                    <div class="card card-box" style="height: 95px;">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Bottom 30 Employees By Performance Rating')); ?></div>
                        </div>
                        <div class="number-icon"></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                </a>
            </div>

            <div class="<?php echo e($class); ?> col-sm-6">
                <a href="<?php echo e(route('users.training')); ?>">
                    <div class="card card-box" style="height: 95px;">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Report On Overall Training Needs')); ?></div>
                        </div>
                        <div class="number-icon"></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                </a>
            </div>

            <div class="<?php echo e($class); ?> col-sm-6">
                <a href="<?php echo e(route('users.dept_training')); ?>">
                    <div class="card card-box" style="height: 95px;">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Report On Training Needs By Department')); ?></div>
                        </div>
                        <div class="number-icon"></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                </a>
            </div>


            <div class="<?php echo e($class); ?> col-sm-6">
                <a href="<?php echo e(route('users.percentage_dist')); ?>">
                    <div class="card card-box" style="height: 95px;">
                        <div class="left-card">
                            <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                            <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Report On Employees Percentage Distribution')); ?></div>
                        </div>
                        <div class="number-icon"></div>
                        <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                    </div>
                </a>
            </div>
        <?php endif; ?>

        <?php if((\Auth::user()->type == 'Admin')): ?>
            <?php if(in_array("total_user", $arrCount['dashboard_menus'])): ?>
                <?php if(isset($arrCount['user'])): ?>
                    <div class="<?php echo e($class); ?> col-sm-6">
                        <a href="<?php echo e(route('users')); ?>">
                            <div class="card card-box">
                                <div class="left-card">
                                    <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                    <div style="width: 100%;  font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Total User')); ?></div>
                                </div>
                                <div class="number-icon"><?php echo e($arrCount['user']); ?></div>
                                <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(in_array("total_dept", $arrCount['dashboard_menus'])): ?>
                <?php if(isset($arrCount['department'])): ?>
                    <div class="<?php echo e($class); ?> col-sm-6">
                        <a href="<?php echo e(route('department')); ?>">
                        <div class="card card-box">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Total Department')); ?></div>
                            </div>
                            <div class="number-icon"><?php echo e($arrCount['department']); ?></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                        </a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php if(in_array("rating_by_grade_level", $arrCount['dashboard_menus'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users.gradelevel')); ?>">
                        <div class="card card-box" style="height: 95px;">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Employee Performance Rating By Grade Level')); ?></div>
                            </div>
                            <div class="number-icon"></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(in_array("rating_score_by_department", $arrCount['dashboard_menus'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users.department')); ?>">
                        <div class="card card-box" style="height: 95px;">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Employee Performance Rating Score By Department')); ?></div>
                            </div>
                            <div class="number-icon"></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(in_array("top_30_employees_by_performence_rating", $arrCount['dashboard_menus'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users.top')); ?>">
                        <div class="card card-box" style="height: 95px;">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Top 30 Employees By Performance Rating')); ?></div>
                            </div>
                            <div class="number-icon"></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(in_array("botom_30_employees_by_performence_rating", $arrCount['dashboard_menus'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users.bottom')); ?>">
                        <div class="card card-box" style="height: 95px;">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Bottom 30 Employees By Performance Rating')); ?></div>
                            </div>
                            <div class="number-icon"></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(in_array("report_on_overall_training_needs", $arrCount['dashboard_menus'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users.training')); ?>">
                        <div class="card card-box" style="height: 95px;">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Report On Overall Training Needs')); ?></div>
                            </div>
                            <div class="number-icon"></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>
            <?php if(in_array("report_on_training_needs_by_department", $arrCount['dashboard_menus'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users.dept_training')); ?>">
                        <div class="card card-box" style="height: 95px;">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Report On Training Needs By Department')); ?></div>
                            </div>
                            <div class="number-icon"></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>

            <?php if(in_array("report_on_employees_percentage_distribution", $arrCount['dashboard_menus'])): ?>
                <div class="<?php echo e($class); ?> col-sm-6">
                    <a href="<?php echo e(route('users.percentage_dist')); ?>">
                        <div class="card card-box" style="height: 95px;">
                            <div class="left-card">
                                <div class="icon-box bg-danger"><i class="fas fa-users"></i></div>
                                <div style="width: 100%; font-size: 12px; margin-left: 65px; font-weight: 600;"><?php echo e(__('Report On Employees Percentage Distribution')); ?></div>
                            </div>
                            <div class="number-icon"></div>
                            <img src="<?php echo e(asset('/public/assets/img/dot-icon.png')); ?>" class="dotted-icon">
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
     $(document).ready(function(){

$(".year_filter").change(function () {
    var selected_year = $('.year_filter option:selected').val();
    var year = '';
    // var staff_id = $(this).attr('data-staff-id');
    // var dept_id = $(this).attr('data-dept-id');
    // console.log(staff_id);
    // console.log(selected_year); return false;
    if(selected_year == ''){

        year = (new Date).getFullYear();


    }else{

        year = selected_year;

    }
    $.ajax({
                    url: '/set/'+year,
                    type: "post",
                    data : {"_token":"<?php echo e(csrf_token()); ?>"},
        //headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });

});
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>