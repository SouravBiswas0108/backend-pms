
        <!DOCTYPE html>
        <html>
            <head>
                <meta http-equiv="content-type" content="text/html; charset=UTF-8">
                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
                <meta content="" name="description">
                <meta content="" name="author">
                <meta name="csrf-token" content="4Yo5cWVzqlgQQ9odrv8LUMxc6BKmdnR3UYQmUOkl">
                <!-- <link href="css/bootstrap.css" rel="stylesheet" type="text/css"> -->
                <style>
                  @import  url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700');
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }

        th,
        td {
            padding: 7px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .column {
            width: 45%;
            float: left;
            padding-right: 10px;
        }

        .column2 {
            width: 45%;
            float: right;
            padding-right: 10px;
        }

        .clearfix {
            clear: both;
        }

        .table-BN tr td{
            border: 0px;
        }

        .table-BN tr td:nth-child(2){
            border-left: 1px;
        }


                </style>

            </head>
          <!-- END HEAD -->
          <title><?php echo e($data['org_name']->org_name); ?></title>
            <body class="horizontal-menu" style="position: relative;">
                <!-- <div class="prient-page"> -->

                                        <div class="coomon-details">
                                            <h5 style="text-align: center">Appraisal Year : from <?php echo e($data['start_year']); ?> To <?php echo e($data['end_year']); ?></h5>
                                            <h5 style="text-align: center"><?php echo e($data['org_name']->org_name); ?></h5>


                                            <table>
                                             <tr>
                                                <td>
                                                <h3>Appraisee Information</h3>
                                                <table>

                                                    <tr>
                                                        <td>First Name</td>
                                                        <td><?php echo e($data['user_details']->fname ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Middle Name</td>
                                                        <td><?php echo e($data['user_details']->mid_name ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Name</td>
                                                        <td><?php echo e($data['user_details']->lname ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td><?php echo e($data['user_details']->gender ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Staff ID</td>
                                                        <td><?php echo e($data['user_details']->staff_id ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>IPPIS No.</td>
                                                        <td><?php echo e($data['user_details']->ippis_no ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Department</td>
                                                        <td><?php echo e($data['department']->dept_name ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><?php echo e($data['user_details']->email ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone No.</td>
                                                        <td><?php echo e($data['user_details']->phone ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MDA</td>
                                                        <td><?php echo e($data['org_name']->org_name); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Designation</td>
                                                        <td><?php echo e($data['user_details']->designation ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Grade Level</td>
                                                        <td><?php echo e($data['user_details']->grade_level ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date of Posting to MDA</td>
                                                        <td><?php echo e($data['user_details']->date_of_MDA_posting ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Division/Section/Unit</td>
                                                        <td><?php echo e($data['user_details']->division ?? 'N/A'); ?></td>
                                                    </tr>
                                                </table>

                                            </td>
                                            <td>

                                                <h3>Appraiser Information</h3>
                                                <table>

                                                    <tr>
                                                        <td>First Name</td>
                                                        <td><?php echo e($data['supervisor_info']->fname ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Middle Name</td>
                                                        <td><?php echo e($data['supervisor_info']->mid_name ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Last Name</td>
                                                        <td><?php echo e($data['supervisor_info']->lname ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Gender</td>
                                                        <td><?php echo e($data['supervisor_info']->gender ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Staff ID</td>
                                                        <td><?php echo e($data['supervisor_info']->staff_id ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>IPPIS No.</td>
                                                        <td><?php echo e($data['supervisor_info']->ippis_no ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Department</td>
                                                        <td><?php echo e($data['department']->dept_name ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email</td>
                                                        <td><?php echo e($data['supervisor_info']->email ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Phone No.</td>
                                                        <td><?php echo e($data['supervisor_info']->phone ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>MDA</td>
                                                        <td><?php echo e($data['org_name']->org_name); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Designation</td>
                                                        <td><?php echo e($data['supervisor_info']->designation ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Grade Level</td>
                                                        <td><?php echo e($data['supervisor_info']->grade_level ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date of Posting to MDA</td>
                                                        <td><?php echo e($data['supervisor_info']->date_of_MDA_posting ?? 'N/A'); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Division/Section/Unit</td>
                                                        <td><?php echo e($data['user_details']->division ?? 'N/A'); ?></td>
                                                    </tr>
                                                </table>
                                             </td>
                                            </tr>
                                        </table>


                                        </div>



                                        <div class="col-xs-12">
                                            <div class="sec-text-info">

                                                <h4 style="font-family: 'Montserrat-Regular' !important;">Section B : </h4>
                                                <h4 class="staff-info" style="font-size: 13px;line-height: 40px;border-bottom: 1px solid #eee;font-weight: bold;color: #000000;"> EMPLOYEE PRIORITIZED JOB OBJECTIVE [70] :</h4>

                                            </div>

                                                <div class="clearfix"></div>

                                        </div>

                            <div class="clearfix"></div>

                            <div class="core-Activities">

                                <?php if(!empty($data['planning_performance'])): ?>

                                    <?php for($quarter=1;$quarter<=4;$quarter++): ?>
                                    <h4>Quarter <?php echo e($quarter); ?></h4>
                                    <table style="border-collapse: collapse; width: 100%;">
                                        <thead>
                                          <tr>
                                            <th style="border: 1px solid black; padding: 5px;">Key Result Areas</th>
                                            <th style="border: 1px solid black; padding: 5px;">Objective(s)</th>
                                            <th style="border: 1px solid black; padding: 5px;">Measure/ Key Performance Indicator (KPI)</th>
                                            <th style="border: 1px solid black; padding: 5px;">Evidence of Performance</th>
                                            <th style="border: 1px solid black; padding: 5px;">Target Rating</th>
                                            <th style="border: 1px solid black; padding: 5px;">Appraisee’s Rating (Self Appraisal)</th>
                                            <th style="border: 1px solid black; padding: 5px;">Supervisor's Appraisal</th>
                                            <th style="border: 1px solid black; padding: 5px;">Actions Required to Support Performance Improvement</th>
                                            <th style="border: 1px solid black; padding: 5px;">Responsibility</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                         <?php $__currentLoopData = $data['planning_performance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planning_performance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                          <tr>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e($planning_performance->key_result_areas ?? 'N/A'); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e($planning_performance->job_objects ?? 'N/A'); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e($planning_performance->key_performance_indicators ?? 'N/A'); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::kpi_evidence($planning_performance->id,$quarter)); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e($planning_performance->planned_targets); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::self_rating($planning_performance->id,$quarter)); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::super_rating($planning_performance->id,$quarter)); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::Improvement($planning_performance->id,$quarter)); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::Responsibility($planning_performance->id,$quarter)); ?></td>
                                          </tr>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                          <tr>
                                            <td colspan="4" style="border: 1px solid black; padding: 5px;"></td>

                                            <td style="border: 1px solid black; padding: 5px;">Total</td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e(round($data['average'.$quarter])); ?></td>
                                            <td style="border: 1px solid black; padding: 5px;"><?php echo e(round($data['super_average'.$quarter])); ?></td>
                                            <td  colspan="2" style="border: 1px solid black; padding: 5px;"></td>

                                          </tr>
                                        </tbody>
                                      </table>
                                      <?php endfor; ?>

                                      <?php else: ?>
                                      <h4> NO Record Found</h4>
                                      <?php endif; ?>


                                </div>


                            <div class="col-xs-12">
                                <div class="sec-text-info">

                                    <h4 style="font-family: 'Montserrat-Regular' !important;">Section C : </h4>
                                    <h4 class="staff-info" style="font-size: 13px;line-height: 40px;border-bottom: 1px solid #eee;font-weight: bold;color: #000000;"> REVIEW OF PROCESSES / OPERATIONS [10] :</h4>

                                </div>

                                    <div class="clearfix"></div>

                            </div>

                      <div class="Process">

                            <?php if(!empty($data['process_planning_performance'])): ?>

                                <?php for($quarter=1;$quarter<=4;$quarter++): ?>
                                <h4>Quarter <?php echo e($quarter); ?></h4>
                                <table style="border-collapse: collapse; width: 100%;">
                                    <thead>
                                      <tr>
                                        <th style="border: 1px solid black; padding: 5px;">Key Result Areas</th>
                                        <th style="border: 1px solid black; padding: 5px;">Objective(s)</th>
                                        <th style="border: 1px solid black; padding: 5px;">Measure/ Key Performance Indicator (KPI)</th>
                                        <th style="border: 1px solid black; padding: 5px;">Evidence of Performance</th>
                                        <th style="border: 1px solid black; padding: 5px;">Target Rating</th>
                                        <th style="border: 1px solid black; padding: 5px;">Appraisee’s Rating (Self Appraisal)</th>
                                        <th style="border: 1px solid black; padding: 5px;">Supervisor's Appraisal</th>
                                        <th style="border: 1px solid black; padding: 5px;">Actions Required to Support Performance Improvement</th>
                                        <th style="border: 1px solid black; padding: 5px;">Responsibility</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                     <?php $__currentLoopData = $data['process_planning_performance']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $process_planning_performance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                      <tr>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e($process_planning_performance->key_result_areas ?? 'N/A'); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e($process_planning_performance->job_objects ?? 'N/A'); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e($process_planning_performance->key_performance_indicators ?? 'N/A'); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::kpi_evidence($process_planning_performance->id,$quarter)); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e($process_planning_performance->planned_targets); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::self_rating($process_planning_performance->id,$quarter)); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::super_rating($process_planning_performance->id,$quarter)); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::Improvement($process_planning_performance->id,$quarter)); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e(App\Http\Controllers\ApprisalController::Responsibility($process_planning_performance->id,$quarter)); ?></td>
                                      </tr>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                      <tr>
                                        <td colspan="4" style="border: 1px solid black; padding: 5px;"></td>

                                        <td style="border: 1px solid black; padding: 5px;">Total</td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e(round($data['process_average'.$quarter])); ?></td>
                                        <td style="border: 1px solid black; padding: 5px;"><?php echo e(round($data['process_super_average'.$quarter])); ?></td>
                                        <td  colspan="2" style="border: 1px solid black; padding: 5px;"></td>

                                      </tr>
                                    </tbody>
                                  </table>
                                  <?php endfor; ?>

                                  <?php else: ?>
                                  <h4> NO Record Found</h4>
                                  <?php endif; ?>


                            </div>



                                        <div class="block-information">
                                            <div class="col-xs-12">
                                                <div class="sec-text-info">
                                                    <h4 class="staff-info" style="font-size: 13px;line-height: 40px;border-bottom: 1px solid #eee;font-weight: bold;color: #494949;">Section D</h4>
                                                    <p style="margin: 0;">REVIEW OF KEY COMEPENCY.</p>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="section-D">
                                            <?php if(!empty($data['planning_competency'])): ?>
                                            <?php for($quarter=1;$quarter<=4;$quarter++): ?>
                                             <h4>Quarter <?php echo e($quarter); ?></h4>
                                             <table style="border-collapse: collapse; width: 100%;">
                                                <thead>
                                                  <tr>
                                                    <th style="border: 1px solid black; padding: 8px;">Competency Cluster</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Competency</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Evidence of Performance</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Target Rating</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Appraisee’s Rating (Self Appraisal)</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Supervisors Appraisal</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Actions Required to Support Performance Improvement</th>
                                                    <th style="border: 1px solid black; padding: 8px;">Responsibility</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <?php $__currentLoopData = $data['planning_competency']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $planning_competency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php if(!empty($planning_competency['competency_present_rating']) && !empty($planning_competency['competency_desired_rating'])): ?>
                                                  <tr>
                                                    <td style="border: 1px solid black; padding: 8px;text-transform:capitalize;"><?php echo e(str_replace("_", " ",$planning_competency['competency_cluster'] )); ?></td>
                                                    <td style="border: 1px solid black; padding: 8px;text-transform:capitalize;"><?php echo e(str_replace("_", " ",$planning_competency['competency'] )); ?></td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e(App\Http\Controllers\ApprisalController::evidence($planning_competency['competency_id'],$quarter)); ?> </td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e($planning_competency['competency_desired_rating']); ?></td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e(App\Http\Controllers\ApprisalController::comepency_self_rating($planning_competency['competency_id'],$quarter)); ?></td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e(App\Http\Controllers\ApprisalController::comepency_super_rating($planning_competency['competency_id'],$quarter)); ?></td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e(App\Http\Controllers\ApprisalController::compency_Improvement($planning_competency['competency_id'],$quarter)); ?></td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e(App\Http\Controllers\ApprisalController::compency_Responsibility($planning_competency['competency_id'],$quarter)); ?></td>
                                                  </tr>
                                                  <?php endif; ?>
                                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                <tfoot>
                                                  <tr>
                                                    <td colspan="4" style="border: 1px solid black; padding: 8px; text-align: right;">Total:</td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e(round($data['comepency_average'.$quarter])*4); ?></td>
                                                    <td style="border: 1px solid black; padding: 8px;"><?php echo e(round($data['super_comepency_average'.$quarter])*4); ?></td>
                                                    <td colspan="2" style="border: 1px solid black; padding: 8px;"></td>
                                                  </tr>
                                                </tfoot>
                                              </table>
                                              <?php endfor; ?>
                                              <?php else: ?>
                                              <h4> NO RECORD FOUND</h4>
                                              <?php endif; ?>

                                        </div>
                                        <div class="clearfix"></div>




                        <div class="functional-professional">
                     <h3 class="staff-info" style="font-size: 15px;line-height: 40px;border-bottom: 1px solid #eee;font-weight: bold;color:#000000;">Section E : Functional Professional Competency </h3>

                            <?php if(count($data['functional_professional_competency']) > 0): ?>


                            <table>

                                <tbody class="">
                                    <tr>
                                        <th>Designation</th>
                                        <th>Activities</th>
                                        <th>Skills</th>
                                        <th>Grade</th>
                                    </tr>

                                    <?php $__currentLoopData = $data['functional_professional_competency']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $functional_professional_competency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <textarea  type="textarea" class="form-control s-number"><?php echo e($functional_professional_competency->designation); ?></textarea>
                                            </td>
                                            <td>
                                                <textarea type="textarea" class="form-control s-number"><?php echo e($functional_professional_competency->activities); ?></textarea>
                                            </td>
                                            <td>
                                                <textarea  type="textarea" class="form-control s-number"><?php echo e($functional_professional_competency->skills); ?></textarea>
                                            </td>


                                            <td>
                                               <div style="float:left ; width: 50%;">
                                                    <div
                                                        style="
                                                        border: 1px solid #ced4da;
                                                            padding: 6px 10px 6px 20px;
                                                            border-bottom: none;
                                                            border-right: none;
                                                        ">
                                                        Present</div>
                                                    <div class="list-cell"
                                                        style="border: 1px solid #e5e5e5;">
                                                        <select class="comprtancy-list-item">
                                                            <option value="">Select Grade</option>
                                                            <option value="5"
                                                                <?php if($functional_professional_competency->present_grade == 5): ?> selected <?php endif; ?>>
                                                                Excellent</option>
                                                            <option value="4"
                                                                <?php if($functional_professional_competency->present_grade == 4): ?> selected <?php endif; ?>>
                                                                Very Good
                                                            </option>
                                                            <option value="3"
                                                                <?php if($functional_professional_competency->present_grade == 3): ?> selected <?php endif; ?>>
                                                                Good</option>
                                                            <option value="2" <?php if($functional_professional_competency->present_grade == 2): ?> selected  <?php endif; ?>> Fair</option>
                                                            <option value="1"  <?php if($functional_professional_competency->present_grade == 1): ?> selected <?php endif; ?>>Poor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div style="float: right ; width: 50%;">
                                                    <div
                                                        style="
                                                    border: 1px solid #ced4da;
                                                    padding: 6px 10px 6px 20px;
                                                    border-bottom: none;
                                                ">
                                                        Desired</div>
                                                    <div class="list-cell"
                                                        style="border: 1px solid #e5e5e5;">
                                                        <select class="comprtancy-list-item ">
                                                            <option value="">Select Grade</option>
                                                            <option
                                                                value="5"<?php if($functional_professional_competency->desired_grade == 5): ?> selected <?php endif; ?>>
                                                                Excellent</option>
                                                            <option value="4"
                                                                <?php if($functional_professional_competency->desired_grade == 4): ?> selected <?php endif; ?>>
                                                                Very Good
                                                            </option>
                                                            <option value="3"
                                                                <?php if($functional_professional_competency->desired_grade == 3): ?> selected <?php endif; ?>>
                                                                Good</option>
                                                            <option value="2"  <?php if($functional_professional_competency->desired_grade == 2): ?> selected <?php endif; ?>> Fair</option>
                                                            <option value="1"  <?php if($functional_professional_competency->desired_grade == 1): ?> selected <?php endif; ?>> Poor</option>
                                                        </select>
                                                    </div>
                                                </div>



                                            </td>



                                        </tr>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </tbody>
                            </table>
                            <?php else: ?>
                            <h5>No Record found</h5>
                            <?php endif; ?>
                        </div>


                          <div class="overall-section">
                            <?php
                            $total_sum=0;
                            $avg=0;
                       ?>
                              <table>

                                <tr>
                                    <td colspan=2>
                                   <table ><thead><tr><th><h4 class="m-0"><strong>Section 3 :</strong>  SUMMARY OF OVERALL ASSESSMENT :</h4></th><th>Assessment Year - <?php echo e($data['year'] ?? ''); ?></th> <th>Generated ON - <?php echo e(date("Y-m-d")); ?></th></tr></thead></table>
                                    <table>
                                        <tr>
                                            <th>
                                                Quater
                                            </th>
                                            <th>
                                                Prioritized Job Objective
                                                </th>
                                            <th>
                                                Process/Operations
                                            </th>
                                            <th>
                                                Key Compency
                                            </th>
                                            <th>
                                                Final
                                            </th>
                                            <th>
                                                Grade
                                            </th>
                                        </tr>

                                <?php if(!empty($data['records'])): ?>
                                     <?php $__currentLoopData = $data['records']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td> <?php echo e($record->quarter); ?></td>
                                            <td>
                                                <table class="table-BN" style="margin-bottom: 0px; border: 0px;">
                                                    <tr>
                                                        <td>Target  <?php echo e(round($record->target->prioritized_job_target)); ?>%</td>
                                                        <td>Achieved  <?php echo e(round($record->achieved->prioritized_job_achived )); ?>%</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table style="margin-bottom: 0px; border: 0px;">
                                                    <tr>
                                                        <td>Target <?php echo e(round($record->target->process_job_target)); ?>% </td>
                                                        <td>Achieved <?php echo e(round($record->achieved->process_job_achived)); ?>%</td>
                                                    </tr>

                                                </table>
                                            </td>
                                            <td>
                                                <table style="margin-bottom: 0px; border: 0px;">
                                                    <tr>
                                                        <td>Target  <?php echo e(round($record->target->competency_target)); ?>% </td>
                                                        <td>Achieved  <?php echo e(round($record->achieved->competency_achived)); ?>% </td>
                                                    </tr>

                                                </table>
                                            </td>
                                            <td>
                                                <table style="margin-bottom: 0px; border: 0px;">
                                                    <tr>
                                                        <td> <?php echo e($record->total); ?>% </td>

                                                    </tr>

                                                </table>
                                            </td>
                                            <td>
                                                <table style="margin-bottom: 0px; border: 0px;">
                                                    <tr>
                                                        <td> <?php echo e($record->grade); ?></td>

                                                    </tr>

                                                </table style="margin-bottom: 0px; border: 0px;">
                                            </td>
                                        </tr>
                                        <?php
                                        $total_sum= $total_sum+$record->total;
                                        $avg++;
                                    ?>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                      <?php
                                          $total_sum=$total_sum/$avg;
                                      ?>

                                <tr>
                                    <td colspan="3" style="border-bottom: 1px solid #fff; border-left: 1px solid #fff;"></td>
                                    <td style="padding: 5px;"><strong>Total</strong></td>
                                    <td style="padding: 5px;"><?php echo e(round($total_sum)); ?>%</td>
                                    <td><?php if($total_sum<60): ?> Poor <?php elseif($total_sum>=60 && $total_sum<70): ?> Fair
                                      <?php elseif($total_sum>=70 && $total_sum<80): ?> Good <?php elseif($total_sum>=80 && $total_sum<90): ?> Very Good
                                      <?php elseif($total_sum>=90 && $total_sum<=100): ?>
                                       Excellent
                                      <?php endif; ?>
                                  </td>
                                  </tr>
                             <?php else: ?>
                                 <tr>
                                    <td colspan="6" style="border-bottom: 1px solid #fff; border-left: 1px solid #fff;"> NO RECORD FOUND...!!!</td>
                                </tr>

                                <?php endif; ?>


                                    </table>
                                </td>
                            </tr>
                                 </table>
                        </div>

                                <div class="card-body" style="flex: 1 1 auto;min-height: 1px;padding: 0.5rem;color: #8492A6;">
                                    <div class="print-section">
                                        <div class="clearfix"></div>
                                        <div class="documentation">
                                            <div class="col-sm-12">
                                                <div class="header-text" style="font-size: 15px;color: #000000;font-weight: bold;">Documentations</div>
                                                <p class="desc-text" style="margin: 0;color: #000000;">I hereby certify that I understand the
                                                    duties listed in this performance planning form, and I agree with the
                                                plan as stated herein</p>
                                            </div>

                                            <div class="row" style="width: 100%; display: table;">
                                            <div class="col-sm-4 column" style="display: table-cell; width: 33.30%; padding: 0px 5px;">
                                                <div class="box-info" style="border: 1px solid #dbdbdb;padding: 0 5px;margin-top: 5px;height: 370px;">
                                                    <div class="staff-info" style="font-size: 13px;line-height: 40px;border-bottom: 1px solid #eee;font-weight: bold;color: #494949;">Employee's Comment</div>

                                                    <div class="tab-pane">
                                                        <div class="row column-seperation">
                                                            <div class="upto-creation-form">
                                                                <div class="" style="margin: 0">
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p style="margin: 0;">Employee's Name</p>
                                                                        <span class="form-control" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraisee_name ?? 'NA'); ?></span>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Declaration</p>
                                                                        <div style="position: relative;">
                                                                            <span class="form-control select-op2" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraisee_declaration ?? 'NA'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Date</p>
                                                                        <span class="form-control" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraisee_date ?? 'NA'); ?></span>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Comments</p>
                                                                        <span class="form-control" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraisee_comment ?? 'NA'); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 column" style="display: table-cell; width: 33.30%; padding: 0px 5px;">
                                                <div class="box-info" style="border: 1px solid #dbdbdb; padding: 0 5px;margin-top: 5px;height: 370px; overflow: scroll;">
                                                    <div class="staff-info" style="font-size: 13px;line-height: 40px;border-bottom: 1px solid #eee;font-weight: bold;color: #494949;">Supervisor's Comment</div>
                                                    <div class="tab-pane">
                                                        <div class="row column-seperation">
                                                            <div class="upto-creation-form">
                                                                <div class="" style="margin: 0">
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Employee's Name</p>
                                                                        <span class="form-control" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraiser_name ?? 'NA'); ?></span>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Declaration</p>
                                                                        <div style="position: relative;">
                                                                            <span class="form-control select-op2" style="height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraiser_declaration ?? 'NA'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Date</p>
                                                                        <span class="form-control" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraiser_date ?? 'NA'); ?></span>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;overflow: none;  max-width: 100%;">
                                                                        <p>Comments</p>
                                                                        <span class="form-control" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->appraiser_comment ?? 'NA'); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4 column" style="display: table-cell; width: 33.30%; padding: 0px 5px;">
                                                <div class="box-info" style="border: 1px solid #dbdbdb;padding: 0 5px;margin-top: 5px;height: 370px;">
                                                    <div class="staff-info" style="font-size: 13px;line-height: 40px;border-bottom: 1px solid #eee;font-weight: bold;color: #494949;">Officers Comment</div>
                                                    <div class="tab-pane">
                                                        <div class="row column-seperation">
                                                            <div class="upto-creation-form">
                                                                <div class="" style="margin: 0">
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Employee's Name</p>
                                                                        <div style="position: relative;">
                                                                            <span class="form-control select-op2" style="height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->officer_comment ?? 'NA'); ?></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Declaration</p>
                                                                        <span class="form-control" style="    height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->officer_comment ?? 'NA'); ?></span>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Date</p>
                                                                        <span style="height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->officer_comment ??'NA'); ?></span>
                                                                    </div>
                                                                    <div class="col-sm-12" style="flex: 0 0 100%;max-width: 100%;">
                                                                        <p>Comments</p>
                                                                        <span class="form-control" style="height: auto;font-size: 14px;border: 0px;padding: 5px 0;background-color: transparent;text-transform: none;font-weight: normal;color: #4a4a4a;"><?php echo e($data['planning_documentation']->officer_comment ?? 'NA'); ?></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            <div class="clearfix"></div>

                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <!-- </div>
                </div> -->
            </body>
        </html>

<?php /**PATH /home/deveduco/public_html/admin/resources/views/apprisal/generatePdfStaffKPIdetails.blade.php ENDPATH**/ ?>