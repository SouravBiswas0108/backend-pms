<?php $__env->startSection('title'); ?>
    <?php echo e(__('MPMS')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.css')); ?>">
    <style type="text/css">

        .presidential-btn,
        .operational-btn,
        .service-wide-btn
        {
            width: 120px;
            padding: 5px;
            border-radius: 10px;
            color: #0f5ef7;
            background-color: #fff;
            border: 1px solid #0f5ef7;
        }

        .presidential-btn.active,
        .operational-btn.active,
        .service-wide-btn.active
        {
            width: 120px;
            padding: 5px;
            border-radius: 10px;
            background-color: #0f5ef7;
            border: none;
            color: white;
            font-weight: 500;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script type="text/javascript">
        function active(argument) {
            if(argument == 1)
            {
                $(".presidential-btn").addClass("active");
                $(".operational-btn, .service-wide-btn").removeClass("active");
                $(".divForTable2, .divForTable3").hide();
                $(".divForTable1").show();
            }
            if(argument == 2)
            {
                $(".operational-btn").addClass("active");
                $(".presidential-btn, .service-wide-btn").removeClass("active");
                $(".divForTable3, .divForTable1").hide();
                $(".divForTable2").show();
            }
            if(argument == 3)
            {
                $(".service-wide-btn").addClass("active");
                $(".operational-btn, .presidential-btn").removeClass("active");
                $(".divForTable1, .divForTable2").hide();
                $(".divForTable3").show();
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-button'); ?>
    <div class="row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-12">
            <div class="all-button-box">
                <a href="<?php echo e(route('mpms_form.create')); ?>" data-url="" data-ajax-popup="true" data-size="lg" data-title="<?php echo e(__('Create Department')); ?>" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> <?php echo e(__('ADD')); ?> </a>
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
                            <div style="margin-left: 30px;">
                                <button class="presidential-btn active" onclick="active(1)">Presidential</button>
                                <button class="operational-btn" onclick="active(2)">Operational</button>
                                <button class="service-wide-btn" onclick="active(3)">Service-Wide</button>
                            </div>
                            <div class="divForTable1">
                                <table class="table table-striped dataTable table1">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center"><?php echo e(__('KEY RESULT AREA')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('WEIGHT')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('OBJECTIVES')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('WEIGHTS')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('INITIATIVES')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('KPI')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('TARGET')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('RESPONSIBLE')); ?></th>
                                        <th width="300px" style="text-align: center"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php if(count($data1) > 0): ?>
                                            <?php $__currentLoopData = $data1; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td  style="color:black;"><?php echo e($dept->kra_title); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->kra_weight); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->obj_title); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->obj_weight); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->Initiative); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->kpi); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->target); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->Responsible); ?></td>
                                                    <?php if(Auth::user()->type != 'Client'): ?>
                                                        <td class="Action">
                                                            <span style="display: inline-block">
                                                                <a href="<?php echo e(route('kra.edit',$dept->kra_id)); ?>" class="edit-icon "  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Edit Department')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                            </span>
                                                            <span style="display: inline-block">
                                                                <a href="<?php echo e(route('kra.delete',$dept->id)); ?>" class="delete-icon "  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Edit Department')); ?>"><i class="fas fa-trash" style="color: #fdfdfd;"></i></a>
                                                            </span>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr class="font-style">
                                                <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                            </tr>
                                            <?php if($year==date('Y')): ?>
                                                <input type="hidden" id ="no_dept" name="no_dept" value="1">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div style="display: none;" class="divForTable2">
                                <table class="table table-striped dataTable table2">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center"><?php echo e(__('KEY RESULT AREA')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('WEIGHT')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('OBJECTIVES')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('WEIGHTS')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('INITIATIVES')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('KPI')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('TARGET')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('RESPONSIBLE')); ?></th>
                                        <th width="300px" style="text-align: center"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php if(count($data2) > 0): ?>
                                            <?php $__currentLoopData = $data2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td  style="color:black;"><?php echo e($dept->kra_title); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->kra_weight); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->obj_title); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->obj_weight); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->Initiative); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->kpi); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->target); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->Responsible); ?></td>
                                                    <?php if(Auth::user()->type != 'Client'): ?>
                                                        <td class="Action">
                                                            <span style="display: inline-block">
                                                                <a href="<?php echo e(route('kra.edit',$dept->kra_id)); ?>" class="edit-icon "  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Edit Department')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                            </span>
                                                            <span style="display: inline-block">
                                                                <a href="<?php echo e(route('kra.delete',$dept->id)); ?>" class="delete-icon "  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Edit Department')); ?>"><i class="fas fa-trash" style="color: #fdfdfd;"></i></a>
                                                            </span>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr class="font-style">
                                                <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                            </tr>
                                            <?php if($year==date('Y')): ?>
                                                <input type="hidden" id ="no_dept" name="no_dept" value="1">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                            <div style="display: none;" class="divForTable3">
                                <table class="table table-striped dataTable table3">
                                    <thead>
                                    <tr>
                                        <th style="text-align: center"><?php echo e(__('KEY RESULT AREA')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('WEIGHT')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('OBJECTIVES')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('WEIGHTS')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('INITIATIVES')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('KPI')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('TARGET')); ?></th>
                                        <th style="text-align: center"><?php echo e(__('RESPONSIBLE')); ?></th>
                                        <th width="300px" style="text-align: center"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                        <?php if(count($data3) > 0): ?>
                                            <?php $__currentLoopData = $data3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td  style="color:black;"><?php echo e($dept->kra_title); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->kra_weight); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->obj_title); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->obj_weight); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->Initiative); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->kpi); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->target); ?></td>
                                                    <td  style="color:black;"><?php echo e($dept->Responsible); ?></td>
                                                    <?php if(Auth::user()->type != 'Client'): ?>
                                                        <td class="Action">
                                                            <span style="display: inline-block">
                                                                <a href="<?php echo e(route('kra.edit',$dept->kra_id)); ?>" class="edit-icon "  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Edit Department')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                                            </span>
                                                            <span style="display: inline-block">
                                                                <a href="<?php echo e(route('kra.delete',$dept->id)); ?>" class="delete-icon "  data-url="" data-ajax-popup="" data-title="<?php echo e(__('Edit Department')); ?>"><i class="fas fa-trash" style="color: #fdfdfd;"></i></a>
                                                            </span>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <tr class="font-style">
                                                <td colspan="6" class="text-center"><?php echo e(__('No data available in table')); ?></td>
                                            </tr>
                                            <?php if($year==date('Y')): ?>
                                                <input type="hidden" id ="no_dept" name="no_dept" value="1">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/mpms/listview.blade.php ENDPATH**/ ?>