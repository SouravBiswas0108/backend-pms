<?php if($customFields): ?>
    <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customField): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($customField->type == 'text'): ?>
            <div class="form-group col-6">
                <?php echo e(Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::text('customField['.$customField->id.']', null, array('class' => 'form-control'))); ?>

            </div>
        <?php elseif($customField->type == 'email'): ?>
            <div class="form-group col-6">
                <?php echo e(Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::email('customField['.$customField->id.']', null, array('class' => 'form-control'))); ?>

            </div>
        <?php elseif($customField->type == 'number'): ?>
            <div class="form-group col-6">
                <?php echo e(Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::number('customField['.$customField->id.']', null, array('class' => 'form-control'))); ?>

            </div>
        <?php elseif($customField->type == 'date'): ?>
            <div class="form-group col-6">
                <?php echo e(Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::date('customField['.$customField->id.']', null, array('class' => 'form-control'))); ?>

            </div>
        <?php elseif($customField->type == 'textarea'): ?>
            <div class="form-group col-6">
                <?php echo e(Form::label('customField-'.$customField->id, __($customField->name),['class'=>'form-control-label'])); ?>

                <?php echo e(Form::textarea('customField['.$customField->id.']', null, array('class' => 'form-control'))); ?>

            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>


<?php /**PATH /home/deveduco/public_html/admin/resources/views/custom_fields/formBuilder.blade.php ENDPATH**/ ?>