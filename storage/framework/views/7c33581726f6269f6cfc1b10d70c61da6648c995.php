<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css">
    </head>
<body>

<h3> only one file to be chosen That must be xlsx:</h3>
<form method="post" action="<?php echo e(route('bulk_store')); ?>" enctype="multipart/form-data">
    <?php echo e(csrf_field()); ?>

  <i class="fas fa-file-excel  fa-4x"></i>
  <label for="users">  Select a file:</label>
  <input type="file" style="top: 140px; opacity: 1;" name="file" id="users" accept=".xlsx"><br><br>
  


            

          <div style="top: 80px" class="form-group col-12 text-right">

                <input type="submit" class="btn-create badge-blue">
                <a href="<?php echo e(route('download_excel')); ?>" class="btn-create badge-blue">Sample Excel</a>
            </div>
        </div>

    </form>
</div>

</body>
</html>
<?php /**PATH /home/deveduco/public_html/admin/resources/views/users/bulk.blade.php ENDPATH**/ ?>