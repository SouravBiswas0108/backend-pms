
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
 
 body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

h2 {
    color: #343a40;
    text-align: center;
}

.table {
    background-color: #fff;
    margin-bottom: 0; /* Remove margin below the table to align with pagination */
}

.table-hover tbody tr:hover {
    background-color: #e9ecef; /* Slightly lighter hover effect for better contrast */
}

.table-hover tbody tr {
    color: #343a40; /* Ensure table rows have dark text color for readability */
}

.table-dark th {
    background-color: #343a40; /* Dark background */
    color: #ffffff; /* White text color */
    font-weight: bold; /* Make the text bold */
    font-size: 16px; /* Increase the font size */
    text-align: center; /* Center align text */
    vertical-align: middle; /* Vertically align text */
    border: 2px solid #dee2e6; /* Add thicker border to make the header stand out */
    padding: 10px; /* Add padding for better spacing */
}

.pagination-container {
    margin-top: 20px;
}

.pagination .page-item.active .page-link {
    background-color: #343a40;
    border-color: #343a40;
}

.pagination .page-link {
    color: #343a40;
}

.table .action-icons i {
    cursor: pointer;
    margin: 0 5px;
    color: #343a40; /* Dark color for action icons */
}

.table .action-icons i:hover {
    color: #007bff; /* Change color on hover */
}

</style>

<?php $__env->startSection('title'); ?>
    <?php echo e(__('Manage Users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <?php if(Session::has('import_errors')): ?>
        <div class="col align-self-center alert alert-danger alert-dismissible fade show" role="alert">
            <h3 class="alert-heading">Errors on Rows while importing:</h3>
            <ul>
                <?php $__currentLoopData = Session::get('import_errors'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $failure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><p><?php echo e("ON SERIAL NO. "); ?> &nbsp; <?php echo e($failure->row()-1); ?> &nbsp; <?php echo e($failure->errors()[0]); ?> </p></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <strong>REST OF USER DATA IMPORTED SUCCESSFULLY!!!</strong>
            <button type="button" class="close" style="font-size: 2.25rem;" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <div class="all-button-box row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-toggle="modal" data-target="#createUserModal">
                <i class="fas fa-plus"></i> <?php echo e(__('Add')); ?>

            </a>
        </div>
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="javascript:void(0)" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true"  data-url="<?php echo e(route('admin.dashboard')); ?>">
                <i class="fas fa-plus"></i> <?php echo e(__('Bulk Create')); ?>

            </a>
        </div>
    </div>
    <!-- Modal for creating user -->
    <div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="createUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel"><?php echo e(__('Create User')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card bg-none card-box">
                        <form class="pl-3 pr-3" id="create_user_form" method="POST" action="<?php echo e(route('admin.users.store')); ?>" >
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="emp_id"><?php echo e(__('IPPIS Number')); ?></label>
                                    <input type="number" class="form-control emp_id_text" onkeypress="return /[0-9a-zA-Z]/i.test(event.key)" 
                                    id="ippis_no" name="ippis_no" value="<?php echo e(old('ippis_no')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
                                <div class="col-6 form-group">
                                    <?php
                                        $randomString = "STAFF";
                                        for ($i = 0; $i < 6; $i++) {
                                            if ($i < 6) {
                                            $randomString.=rand(0,9);
                                            }
                                            if ($i == 8) {
                                            //$randomString.=chr(rand(65,90));
                                            }
                                        }
                                    ?>
                                    <label class="form-control-label" for="staff_id"><?php echo e(__('Staff Id')); ?></label>
                                    <input type="text" class="form-control" id="staff_id" name="staff_id" value="<?php echo e($randomString); ?>" readonly="readonly" />
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="fname"><?php echo e(__('First Name')); ?></label>
                                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo e(old('fname')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="mid_name"><?php echo e(__('Middle Name')); ?></label>
                                    <input type="text" class="form-control" id="mid_name" name="mid_name" value="<?php echo e(old('mid_name')); ?>"/>
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="lname"><?php echo e(__('Last Name')); ?></label>
                                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo e(old('lname')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="email"><?php echo e(__('E-Mail Address')); ?></label>
                                    <input type="email" class="form-control" id="email" name="email"  value="<?php echo e(old('email')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="phone"><?php echo e(__('Phone Number')); ?></label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo e(old('phone')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="password"><?php echo e(__('Password')); ?></label>
                                    <input type="text" class="form-control" id="password" name="password" value="<?php echo e(old('password')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="job_title"><?php echo e(__('Job Title')); ?></label>
                                    <input type="text" class="form-control" id="job_title" name="job_title" value="<?php echo e(old('job_title')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="designation"><?php echo e(__('Designation')); ?></label>
                                    <input type="text" class="form-control" id="designation" name="designation" value="<?php echo e(old('designation')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="cadre"><?php echo e(__('Cadre')); ?></label>
                                    <input type="text" class="form-control" id="cadre" name="cadre" value="<?php echo e(old('cadre')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group" id='datetimepicker1'>
                                    <label class="form-control-label" for="date_of_current_posting"><?php echo e(__('Date of Current Posting')); ?></label>
                                    <input type="date" class="form-control" id="date_of_current_posting" name="date_of_current_posting" value="<?php echo e(old('date_of_current_posting')); ?>" max="<?php echo e(date('Y-m-d')); ?>">
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group" id='datetimepicker1'>
                                    <label class="form-control-label" for="date_of_MDA_posting"><?php echo e(__('Date of MDA Posting')); ?></label>
                                    <input type="date" class="form-control" id="date_of_MDA_posting" name="date_of_MDA_posting" value="<?php echo e(old('date_of_MDA_posting')); ?>">
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group" id='datetimepicker1'>
                                    <label class="form-control-label" for="date_of_last_promotion"><?php echo e(__('Date of last Promotion')); ?></label>
                                    <input type="date" class="form-control" id="date_of_last_promotion" name="date_of_last_promotion" value="<?php echo e(old('date_of_last_promotion')); ?>">
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="gender"><?php echo e(__('Gender')); ?></label>
                                    <select name="gender" class="form-control select2"  id="gender">
                                        <option value=""><?php echo e(__('Select Gender')); ?></option>
                                        <option value="male" <?php if(old('gender') == 'male'): ?> selected="selected" <?php endif; ?>>Male</option>
                                        <option value="female" <?php if(old('gender') == 'female'): ?> selected="selected" <?php endif; ?>>Female</option>
                                        <option value="others" <?php if(old('gender') == 'others'): ?> selected="selected" <?php endif; ?>>Others</option>
                                    </select>
                                    <span class="errorgender" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="grade_level"><?php echo e(__('Grade Level')); ?></label>
                                    <select name="grade_level" class="form-control select2"  id="grade_level" required>
                                        <option value=""><?php echo e(__('Select Grade Level')); ?></option>
                                        <option value="1" <?php if(old('grade_level') == '1'): ?> selected="selected" <?php endif; ?>>1</option>
                                        <option value="2" <?php if(old('grade_level') == '2'): ?> selected="selected" <?php endif; ?>>2</option>
                                        <option value="3" <?php if(old('grade_level') == '3'): ?> selected="selected" <?php endif; ?>>3</option>
                                        <option value="4" <?php if(old('grade_level') == '4'): ?> selected="selected" <?php endif; ?>>4</option>
                                        <option value="5" <?php if(old('grade_level') == '5'): ?> selected="selected" <?php endif; ?>>5</option>
                                        <option value="6" <?php if(old('grade_level') == '6'): ?> selected="selected" <?php endif; ?>>6</option>
                                        <option value="7" <?php if(old('grade_level') == '7'): ?> selected="selected" <?php endif; ?>>7</option>
                                        <option value="8" <?php if(old('grade_level') == '8'): ?> selected="selected" <?php endif; ?>>8</option>
                                        <option value="9" <?php if(old('grade_level') == '9'): ?> selected="selected" <?php endif; ?>>9</option>
                                        <option value="10" <?php if(old('grade_level') == '10'): ?> selected="selected" <?php endif; ?>>10</option>
                                        <option value="11" <?php if(old('grade_level') == '11'): ?> selected="selected" <?php endif; ?>>11</option>
                                        <option value="12" <?php if(old('grade_level') == '12'): ?> selected="selected" <?php endif; ?>>12</option>
                                        <option value="13" <?php if(old('grade_level') == '13'): ?> selected="selected" <?php endif; ?>>13</option>
                                        <option value="14" <?php if(old('grade_level') == '14'): ?> selected="selected" <?php endif; ?>>14</option>
                                        <option value="15" <?php if(old('grade_level') == '15'): ?> selected="selected" <?php endif; ?>>15</option>
                                        <option value="16" <?php if(old('grade_level') == '16'): ?> selected="selected" <?php endif; ?>>16</option>
                                    </select>
                                    <span class="errorgrade_level" style="color:red"></span>
                                </div>
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="organization"><?php echo e(__('Organization')); ?></label>
                                    <select name="organization" class="form-control select2" id="organization" required>
                                        <option value=""><?php echo e(__('Select Organization')); ?></option>
                                        <option value="Federal Ministry of Education" selected><?php echo e(__('Federal Ministry of Education')); ?></option>
                                    </select>
                                    <span class="errororganization" style="color:red"></span>
                                </div>
                                
    
                                   <div class="col-6 form-group">
                                      <label class="form-control-label" for="role"><?php echo e(__('Role')); ?></label>
                                       <select name="role" class="form-control select2" id="role" required>
                                        <option value=""><?php echo e(__('Select Role')); ?></option>
                                        <option value="user" selected><?php echo e(__('User')); ?></option>
                                        <option value="admin"><?php echo e(__('Admin')); ?></option>
                                    </select>
                                    <span class="errorrole" style="color:red"></span>
                                </div>

    
                                
    
                                <div class="col-6 form-group">
                                    <label class="form-control-label" for="email"><?php echo e(__('Recovery Email')); ?></label>
                                    <input type="email" class="form-control" id="email" name="recovery_email"  value="<?php echo e(old('recovery_email')); ?>" />
                                    <span class="error" style="color:red"></span>
                                </div>
    
                                <div class="form-group col-12 text-right">
                                    <input type="submit" id="save_user" value="<?php echo e(__('Create User')); ?>" 
                                           class="btn-create badge-blue" 
                                           style="padding: 10px 20px; font-size: 16px; background-color: blue; color: white; border: none; cursor: pointer;">
                            
                                    <input type="button" value="Cancel" 
                                           class="btn-create bg-gray" 
                                           style="padding: 10px 20px; font-size: 16px; background-color: gray; color: white; border: none; cursor: pointer;"
                                           data-dismiss="modal">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container mt-5">
                        <h2 class="mb-4">User Data</h2>
                        <div class="input-group mb-3">
                            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead >
                                    <tr>
                                        <th>Id</th>
                                        <th>IPPIS Number</th>
                                        <th>User Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Activity</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="datatable">
                                    <tr>
                                        <td>1</td>
                                        <td>12345</td>
                                        <td>1001</td>
                                        <td>John Doe</td>
                                        <td>john@example.com</td>
                                        <td>Active</td>
                                        <td>Admin</td>
                                        <td class="action-icons">
                                            <span> 
                                                <i class="fas fa-eye"></i>
                                                <i class="fas fa-edit"></i>
                                                <i class="fas fa-trash-alt"></i>
                                            </span>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>12346</td>
                                        <td>1002</td>
                                        <td>Jane Smith</td>
                                        <td>jane@example.com</td>
                                        <td>Inactive</td>
                                        <td>User</td>
                                        <td class="action-icons">
                                            <i class="bi bi-eye" title="Show"></i>
                                            <i class="bi bi-pencil" title="Edit"></i>
                                            <i class="bi bi-trash" title="Delete"></i>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>12347</td>
                                        <td>1003</td>
                                        <td>Robert Johnson</td>
                                        <td>robert@example.com</td>
                                        <td>Active</td>
                                        <td>Manager</td>
                                        <td class="action-icons">
                                            <i class="bi bi-eye" title="Show"></i>
                                            <i class="bi bi-pencil" title="Edit"></i>
                                            <i class="bi bi-trash" title="Delete"></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-container d-flex justify-content-end">
                            <ul id="pagination" class="pagination">
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            </ul>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<script>
    document.addEventListener('DOMContentLoaded', function () {
    const rows = document.querySelectorAll('#datatable tr');

    function filterRows(query) {
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const match = text.includes(query.toLowerCase());
            row.style.display = match ? '' : 'none';
        });
    }

    document.getElementById('searchInput').addEventListener('input', function () {
        const query = this.value;
        filterRows(query);
    });
});

</script>




<?php echo $__env->make('admin.layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\backend-pms\resources\views/admin/users/index.blade.php ENDPATH**/ ?>