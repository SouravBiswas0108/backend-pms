<?php $__env->startSection('title'); ?>
    <?php echo e(__('Assign Staff with Respect to Supervisor ')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('head'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('/public/assets/libs/summernote/summernote-bs4.css')); ?>">


<?php $__env->stopPush(); ?>

<?php $__env->startPush('script'); ?>
    <script src="<?php echo e(asset('/public/assets/libs/summernote/summernote-bs4.js')); ?>"></script>

<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
<style>
    .select2-container .select2-search {
    display: block;
}
.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default .select2-selection--multiple {
    padding-top: 5px;
}
.select2-container--default .select2-selection--multiple .select2-selection__rendered li {
    list-style: none;
    height: 28px;
    margin-top: 0px;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    margin: 0 0 2.25rem 0.25rem;

}
</style>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form class="pl-3 pr-3" method="post" action="<?php echo e(route('department.assignStaffstore')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="dept_name"><?php echo e(__('Department Name')); ?></label>
                                    <input type="text" class="form-control dept_name" id="dept_name" name="dept_name" readonly value="<?php echo e($department['dept_name']); ?>" required/>
                                    <input type="hidden" class="form-control" id="dept_id" name="dept_id" value="<?php echo e($department['dept_id']); ?>" />
                                    <input type="hidden" class="form-control" id="dept_org_code" name="dept_org_code" value="<?php echo e($department['org_code']); ?>" />
                                </div>
                                <div class="col-6 form-group"></div>

                                <div class="col-6 form-group data-row">
                                    <label class="form-control-label" for="userlist"><?php echo e(__('Choose Supervisor')); ?></label>
                                    <select id="form-control select2" name="supervisor_name" class="form-control select2 supervisor_name">

                                        <option value="" selected><?php echo e(__('Select Supervisor')); ?></option>
                                            <?php if(isset($data['stafflist']) && !empty($data['stafflist'])): ?>
                                            <?php $__currentLoopData = $data['stafflist']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $staff): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>


                                            <?php if(is_array($supervisor_id)): ?>
                                            <?php $__currentLoopData = $supervisor_id; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($key == $id): ?>
                                            <option value="<?php echo e($key); ?>">
                                                <?php echo e($staff); ?>

                                            </option>
                                             <?php endif; ?>
                                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                              <?php else: ?>
                                            <?php if($key == $supervisor_id): ?>
                                             <option value="<?php echo e($key); ?>">
                                                <?php echo e($staff); ?>

                                            </option>
                                            <?php endif; ?>
                                             <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col-6 form-group">


                                </div>


                                <div class="col-6 form-group data-row scrollbar_set">
                                    <label class="form-control-label" for="userlist"><?php echo e(__('Assign Staff')); ?></label>
                                    <select id="Staffs" name="Staffs[]" class="form-control select2" multiple>
                                            
                                    </select>

                                </div>
                                <div class="col-6 form-group"></div>

                                <div class="form-group col-12 text-right">
                                    <input type="submit" value="<?php echo e(__('Done')); ?>" class="btn-create badge-blue btn btn-xs btn-white btn-icon-only width-auto edit-icon userrole-btn">
                                    <?php if(isset($department['dept_id'])): ?>
                                    <a href="javascript:void(0)" data-target="#myModal" data-toggle="modal" class="btn btn-xs btn-white btn-icon-only width-auto edit-icon" data-title="<?php echo e(__('Preview')); ?>" id="edit-item" style="top: 8px;">Preview</a>
                                    <?php endif; ?>

                                    <!-- <input type="button" value="<?php echo e(__('cancel')); ?>" class="btn-create bg-gray" data-dismiss="modal"> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>













<!-- Attachment Modal -->
<div class="modal fade modal_pre" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="edit-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-modal-label">Preview Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="attachment-body-content">
                <form id="edit-form" class="form-horizontal" method="POST" action="">
                    <div class="card text-white bg-dark mb-0">
                        <div class="card-header">
                            <h2 class="m-0">Preview</h2>
                        </div>
                        <div class="card-body">
                            <!-- id -->

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Department Name</label>
                                <input type="text" name="modal-dept_name" class="form-control" id="modal-dept_name" required readonly="readonly">
                            </div>

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Supervisor Name</label>
                                <input type="text" name="modal-supervisor_name" class="form-control" id="modal-supervisor_name" required readonly="readonly">
                            </div>

                            <div class=" col-6 form-group">
                                <label class="col-form-label" for="modal-input-name">Staffs name</label>
                                <input type="text" name="modal-officer_name" class="form-control" id="modal-officer_name" required readonly="readonly">
                            </div>

                            <button type="button" class="btn btn-secondary close_new" data-dismiss="modal" style="right: -10px">OK</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>-->
        </div>
    </div>
</div>

<!-- /Attachment Modal -->

<?php $__env->stopSection(); ?>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
 <script>
         $(document).ready(function() {

        $('.supervisor_name').on('change', function() {
            var getSupId = $(this).val();
           // alert(getSupId)
            var dept_id= <?php echo json_encode($department['dept_id']); ?>;
            if(getSupId) {
                $.ajax({
                    url: '/admin/department/chooseStaff/'+getSupId+'/'+dept_id,
                    type: "GET",
                    data : {"_token":"<?php echo e(csrf_token()); ?>"},
                    dataType: "json",
                    success:function(response) {
                        console.log(response);
                      if(response){
                        $('#Staffs').empty();
                        $('#Staffs').focus;
                        $.each(response, function(key, value){

                            if(value.assign_supervisor==getSupId){
                            $('#Staffs').append('<option  value="'+ value.staff_id +'" selected>' + value.staff_name+ '</option>');
                            }
                            else{
                                $('#Staffs').append('<option  value="'+ value.staff_id +'">' + value.staff_name+ '</option>');
                            }
                    });
                  }else{
                    $('#Staffs').empty();
                  }
                  }
                });
            }else{
              $('#Staffs').empty();
            }
        });
    });
    </script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/deveduco/public_html/admin/resources/views/department/assignStaff.blade.php ENDPATH**/ ?>