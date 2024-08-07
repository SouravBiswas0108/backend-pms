

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

<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\backend-pms\resources\views/admin/dashboard/index.blade.php ENDPATH**/ ?>