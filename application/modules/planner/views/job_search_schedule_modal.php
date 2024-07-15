<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<div class="modal-dialog modal-lg" role="modal" >
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
            <h6 class="modal-title">Scheduler</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="az-content-left az-content-left-contacts">
                        <div id="azContactList" class="az-contacts-list nav">
                            <div class="az-contact-item selected" data-toggle="tab" data-target="#tabCont">
                                <div class="az-contact-body">
                                    <h6>Job # : <?php echo $job_details->job_number; ?></h6>
                                    <span class="phone">Size : <?php echo round($job_details->capacity,2); ?></span>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="tab tab-content">
                        <div id="tabCont" class="tab-pane active show">
                            <form class="form-horizontal" method="post" id="update_schedule_form" name="update_schedule_form" action="<?php echo base_url(); ?>planner/update_schedule">
                                <div class="az-content-body az-content-body-contacts">
                                    <div class="az-contact-info-header">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4>Job # : <?php echo $job_details->job_number; ?></h4>
                                                <p><?php echo $job_details->description." (".$job_details->symbol." Size".round($job_details->capacity,2).")"; ?></p>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="az-contact-action nav">
                                            <span class="h5 text-success pull-right" align="right"><i class="fa fa-hourglass tx-15"></i> <?php echo (ISSET($job_details->schedule_status))?$job_details->schedule_status:''; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#" class="nav-link"><?php echo $job_details->job_type_name; ?></a>
                                        </div><!-- az-contact-action -->

                                    </div><!-- az-contact-info-header -->
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <!--Display for schedules if they are available -->
                                        <?php if($job_schedules): $n=0; ?>
                                        <?php  foreach ($job_schedules as $row): if($n==0): $n++; ?>
                                        <div class="media">
<!--                                            <div class="media-icon align-self-start">-->
<!--                                                <i class="fa fa-receipt tx-20"></i>-->
<!--                                                <span class="h5 text-success">--><?php //echo $row->schedule_status; ?><!--</span>-->
<!--                                            </div>-->
                                            <div class="media-body">
                                                <div>
                                                    <label>Job Area</label>
                                                    <span class="tx-medium"><?php echo $row->job_area_name; ?></span>
                                                </div>
                                                <div>
                                                    <label><?php echo ($row->symbol=="Bulk")?"Tank":"Line";?></label>
                                                    <span class="tx-medium"> <?php echo $row->line_name; echo ($row->capacity !="")?"(".round($row->capacity,2).")":""; ?></span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
<!--                                            <div class="media-icon"></div>-->
                                            <div class="media-body">
                                                <div>
                                                    <label>Date</label>
                                                    <span class="tx-medium"><?php echo date('l d M, Y', strtotime($row->schedule_date)); ?></span>
                                                </div>
                                                <div>
                                                    <label>Time</label>
                                                    <span class="tx-medium"><?php echo ($row->shift_id == 1)?"Day":"Night"; ?> Shift</span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <?php
                                                $area_id = $row->job_area_id;
                                                $line_id = $row->job_line_id;
                                                $schedule_id = $row->id;
                                            endif; endforeach;  ?>
                                        <div class="media">
<!--                                            <div class="media-icon"></div>-->
                                            <div class="media-body">
                                                <div class="card bd-0">
                                                    <div class="card-header bg-gray-100 ">
                                                        <nav class="nav az-nav-line az-nav-line-chat">
                                                            <a class="nav-link active" data-toggle="tab" href="#tabCont1">Other Schedules</a>
                                                            <a class="nav-link" data-toggle="tab" href="#tabCont2">Bulk/Pack Jobs</a>
                                                            <a class="nav-link" data-toggle="tab" href="#tabCont3">Status Logs</a>
                                                        </nav>
                                                    </div><!-- card-header -->
                                                    <div class="card-body bd bd-0 tab-content">
                                                        <div id="tabCont1" class="tab-pane active show">
                                                            <?php if($job_schedules): ?>
                                                            <table class="table table-condensed">
                                                                <thead>
                                                                <th>Job Area</th>
                                                                <th>Line</th>
                                                                <th>Date</th>
                                                                <th>Shift</th>
                                                                <th>Status</th>
                                                                <th> </th>
                                                                </thead>
                                                                <tbody></tbody>
                                                            <?php  foreach ($job_schedules as $r): if($schedule_id != $r->id):?>
                                                                  <tr>
                                                                      <td><?php echo $r->job_area_name; ?></td>
                                                                      <td><?php echo $r->line_name; ?></td>
                                                                      <td><?php echo date('d M, Y', strtotime($r->schedule_date)); ?></td>
                                                                      <td><?php echo ($r->shift_id == 1)?"Day":"Night"; ?></td>
                                                                      <td><?php echo $r->schedule_status; ?></td>
                                                                      <td><a href="<?php echo base_url()."planner/delete_schedule/".$r->id; ?>" class="text-danger"> <i class="fa fa-trash tx-15"></i></a></td>
                                                                  </tr>
                                                            <?php endif; endforeach; ?>
                                                                </tbody>
                                                            </table>
                                                            <?php endif; ?>
                                                        </div><!-- tab-pane -->
                                                        <div id="tabCont2" class="tab-pane">
                                                            <?php if($related_jobs): foreach($related_jobs as $rl): ?>
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <span class="h5"><?php echo $rl->job_number; ?> <small class="text-muted">(<?php echo $rl->description; ?>)</small></span>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span class="text-success pull-right"><?php echo $rl->schedule_status; ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <span class="text-muted">Date</span>
                                                                    <?php echo date('D d M,Y',strtotime($rl->schedule_date)); ?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <span class="text-muted">Job Area</span>
                                                                    <?php echo $rl->job_area_name; ?>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <span class="text-muted"><?php echo $rl->line_name; ?></span>
                                                                    H1
                                                                </div>
                                                            </div>
                                                            <?php endforeach; else: ?>
                                                                <h6>There are no related jobs schedules found. </h6>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div id="tabCont3" class="tab-pane">
                                                            <?php if($schedule_logs): ?>
                                                                <table  class="table table-condensed" >
                                                                    <thead>
                                                                    <tr>
                                                                        <th><span align="left">User</span></th>
                                                                        <th><span align="left">Date</span></th>
                                                                        <th><span align="left">Status</span></th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $step_checker = 0; foreach($schedule_logs as $logs): if($logs->schedule_id == $schedule_id): ?>
                                                                        <tr>
                                                                            <td align="left"><?php echo $logs->display_name; ?></td>
                                                                            <td align="left"><?php echo date('d M,Y H:i', strtotime($logs->created_on)); ?></td>
                                                                            <td align="left"><?php echo $logs->schedule_status_name; ?></td>
                                                                        </tr>
                                                                    <?php
                                                                    //get the maximum step reached on the logs for the option boxes below
                                                                        $step_checker = (($logs->step_order) and ($logs->step_order > $step_checker))?$logs->step_order:$step_checker;
                                                                    ?>
                                                                    <?php endif; endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            <?php else: ?>
                                                                <h4> There are no logs to show </h4>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div><!-- card-body -->
                                                </div><!-- card -->

                                            </div>
                                        </div>
                                        <!-- Display for extending the current job -->
                                        <div class="media">
<!--                                            <div class="media-icon"></div>-->
                                            <div class="media-body">
                                                <div>
                                                    <a href="#txtresult2" class="btn btn-outline-primary btn-rounded pull-right" onclick="htmlData2('<?php echo base_url(); ?>planner/extend_schedule','job_area_id=<?php echo $area_id; ?>&line_id=<?php echo $line_id; ?>')"><i class="fa fa-plus"></i> Add Extension</a>
                                                    <br><br><br>
                                                    <!-- Display for addtional shift that is displayed by ajax-->
                                                    <div id="txtResult2"></div>
                                                </div>
                                                <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>" >
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <?php else: ?>
                                        <!-- display for a new job schedule -->
                                        <div class="media">
<!--                                            <div class="media-icon"></div>-->
                                            <div class="media-body">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label >Job Area</label>
                                                            <select class="form-control" name="job_area_id" id="job_area_id" required onchange="htmlData4('<?php echo base_url()."planner/filter_job_lines"; ?>','job_area_id='+this.value)">
                                                                <option label="Select Job Area"></option>
                                                                <?php foreach($job_areas as $ja):  ?>
                                                                    <option value="<?php echo $ja->id; ?>" ><?php echo $ja->job_area_name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div><!-- col -->
                                                        <div class="col-md-6" >
                                                            <label><?php echo ($job_details->symbol=='Bulk')?'Tank':'Line'; ?></label>
                                                            <div id="txtResult4">
                                                            <select class="form-control" name="line_id" id="line_id">
                                                                <option label="Choose <?php echo ($job_details->symbol=='Bulk')?'Tank':'Line'; ?>"></option>
                                                                <?php foreach($lines as $l):  ?>
                                                                    <option value="<?php echo $l->id; ?>" ><?php echo $l->line_name; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                            </div>
                                                        </div><!-- col -->
                                                    </div><!-- row -->
                                                    <br>
                                                    <div class="row ">
                                                        <div class="col-sm-12">
                                                            <label>Schedule Date</label>
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <input type="date" class="form-control" name="schedule_date" id="schedule_date" <?php echo ($job_details->planned_start_date)?'value="'.date('Y-m-d',strtotime($job_details->planned_start_date)).'"':''; ?> placeholder="" required="">
                                                                    <input type="hidden" name="capacity" value="<?php echo $job_details->capacity; ?>">
                                                                </div><!-- col -->
                                                                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                                                                    <select class="form-control select2-no-search" name="shift_id" id="shift_id">
                                                                        <option label="Choose Shift"></option>
                                                                        <option value="1">Day Shift</option>
                                                                        <option value="2">Night Shift</option>
                                                                    </select>
                                                                </div><!-- col -->
                                                            </div><!-- row -->
                                                        </div><!-- col -->
                                                    </div><!-- row -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                    </div><!-- media-list -->
                                </div><!-- az-contact-info-body -->

                            <div class="row">
                                <div class="col-md-5">

                                </div>

                                <div class="col-md-7">
                                    <label>Job Status</label>
                                    <table>
                                        <tr>
                                        <?php
                                        //check if the step cheker has a value and use it to determine the checkboxes
                                        //$checked = ($step_checker>0)?"disabled":"";
                                            foreach($statuses as $st):
                                                $checked = ((ISSET($step_checker))and($st->step_order < $step_checker) and ($st->step_order != 0))?"disabled":"";
                                                if($schedule_logs){
                                                    foreach($schedule_logs as $logs){
                                                        if($logs->schedule_id == $schedule_id and $st->id == $logs->schedule_status){
                                                            $checked = "checked disabled";
                                                    }
                                                }
                                            }
                                        ?>
                                        <td>
                                            <label class="checkbox">
                                                <input type="checkbox" class="form-control" name="statuses[]" value="<?php echo $st->id; ?>" <?php echo $checked; ?>><span><?php echo $st->schedule_status; ?></span>
                                            </label>
                                        </td>
                                        <?php endforeach; ?>
                                        </tr>
                                    </table>
                                    </div>
                                </div>
                                <input type="hidden" name="schedule_job_id" value="<?php echo $job_details->id; ?>" >
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                                <hr>
                                <table width="100%" border="0">
                                    <tr>
                                        <td width="12%">
                                            <button type="submit" class="btn btn-outline-light text-danger" name="submit" value="Delete"><i class="fa fa-trash"></i> Delete</button>
                                        </td>
                                        <td></td>
                                        <td width="30%">
                                            <button type="submit" class="btn btn-primary btn-rounded btn-block" name="submit" value="submit"><i class="fa fa-download"></i> Save Schedule</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            </form>
                        </div><!-- tab-pane -->
                    </div><!-- card-body -->
                </div>
            </div>
        </div><!-- modal-body -->
<!--        <div class="modal-footer">-->
<!--            <button  id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>-->
<!--            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>-->
<!--        </div>-->
    </div>
</div><!-- modal-dialog