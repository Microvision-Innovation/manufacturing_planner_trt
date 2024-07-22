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
                            <?php  if(ISSET($schedules)): $num=0; foreach($schedules as $row): ?>
                            <div class="az-contact-item <?php echo($num==0)?"selected":""; ?>" data-toggle="tab" data-target="#tabCont<?php echo $row->id; ?>">
                                <div class="az-contact-body">
                                    <h6>Job # :<?php echo $row->job_number; ?></h6>
                                    <span class="phone">Size :<?php echo round($row->capacity,2); ?></span>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                            <?php $num++; endforeach; endif; ?>
                            <div class="az-contact-item <?php echo (!$schedules)?"selected":""; ?> bg-gray-100" data-toggle="tab" data-target="#newjob">
                                <div class="az-contact-body"><br>
                                    <h6 class="text-primary"><i class="fa fa-plus-circle"></i> Add New Job</h6>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="tab tab-content">
                        <?php if(ISSET($schedules)): $num=0; foreach($schedules as $row): ?>
                        <div id="tabCont<?php echo $row->id; ?>" class="tab-pane <?php echo($num==0)?"active show":""; ?>">
                            <form class="form-horizontal" method="post" id="update_schedule_form" name="update_schedule_form" action="<?php echo base_url(); ?>planner/update_schedule">
                                <div class="az-content-body az-content-body-contacts">
                                    <div class="az-contact-info-header">
                                        <div class="media">

                                            <div class="media-body">
                                                <h4><?php echo $row->job_number; ?></h4>
                                                <p><?php echo $row->description." (".$row->symbol." Size".round($row->capacity,2).")"; ?></p>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="az-contact-action nav">
                                            <span class="h5 text-success pull-right" align="right"><i class="fa fa-hourglass tx-15"></i> <?php echo $row->schedule_status; ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <a href="#" class="nav-link"><?php echo $row->job_type_name; ?></a>
                                        </div><!-- az-contact-action -->

                                    </div><!-- az-contact-info-header -->
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <div class="media">
<!--                                            <div class="media-icon align-self-start"></div>-->
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
                                            <div class="media-icon"></div>
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
                                        <!-- display for current job profile -->
                                        <div class="media">
<!--                                            <div class="media-icon"></div>-->
                                            <div class="media-body">
                                                <div class="card bd-0">
                                                    <div class="card-header bg-gray-100 ">
                                                        <nav class="nav az-nav-line az-nav-line-chat">
                                                            <a class="nav-link active" data-toggle="tab" href="#profileSchedulesTab<?php echo $row->id; ?>">Other Schedules</a>
                                                            <a class="nav-link" data-toggle="tab" href="#profileJobsTab<?php echo $row->id; ?>">Bulk/Pack Jobs</a>
                                                            <a class="nav-link" data-toggle="tab" href="#profileLogsTab<?php echo $row->id; ?>">Status Logs</a>
                                                        </nav>
                                                    </div><!-- card-header -->
                                                    <div class="card-body bd bd-0 tab-content">
                                                        <div id="profileSchedulesTab<?php echo $row->id; ?>" class="tab-pane active show">
                                                            <?php if($schedules): ?>
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
                                                                    <?php  foreach ($schedule_extensions as $r): if($row->schedule_job_id == $r->schedule_job_id):?>
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
                                                        <div id="profileJobsTab<?php echo $row->id; ?>" class="tab-pane">
                                                            <?php if($related_schedules): $n=0;
                                                                foreach($related_schedules as $rl):
                                                                if($rl->job_numbers == rtrim($row->job_number, 'B')):
                                                                    $n++;?>
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
                                                            <?php
                                                                endif;
                                                                endforeach;
                                                                echo ($n == 0)?"<h6>There are no related jobs Found</h6>":"";
                                                                else:
                                                                ?>
                                                                    <h6>There are no related jobs Found</h6>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div id="profileLogsTab<?php echo $row->id; ?>" class="tab-pane">

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
                                                                    <?php $step_checker = 0; foreach($schedule_logs as $logs): if($logs->schedule_id == $row->id): ?>
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
                                                                <h5> There are no logs to show </h5>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div><!-- card-body -->
                                                </div><!-- card -->

                                            </div>
                                        </div>
                                        <!-- display for extension of the job -->
                                        <div class="media">
<!--                                            <div class="media-icon"></div>-->
                                            <div class="media-body">
                                                <div>
                                                    <a href="#txtresult2" class="btn btn-outline-primary btn-rounded pull-right" onclick="htmlData2('<?php echo base_url(); ?>planner/extend_schedule','job_area_id=<?php echo $row->job_area_id; ?>&line_id=<?php echo $line_details->id; ?>')"><i class="fa fa-plus"></i> Add Extension</a>
                                                    <br><br><br>
                                                    <!-- Display for addtional shift that is displayed by ajax-->
                                                    <div id="txtResult2"></div>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->

                                    </div><!-- media-list -->
                                </div><!-- az-contact-info-body -->

                            <div class="row">
                                <div class="col-md-4">

                                </div>
                                <div class="col-md-8">
                                    <label>Job Status</label>
                                    <!-- check if the job status is on hold and dont show the other status -->
                                    <?php if($row->status == 4 or $row->status == 8): ?>
                                        <div class="alert alert-outline-warning" role="alert">
                                            This job is currently on On-hold.
                                            <a href="<?php echo base_url()."planner/open_jobs/".$row->schedule_job_id;?>" class="btn btn-xs btn-outline-warning btn-rounded">Click here to Open</a>
                                        </div>
                                    <?php else: ?>
                                    <table>
                                        <tr>
                                            <?php
                                            foreach($statuses as $st):
                                                $checked = ((ISSET($step_checker))and($st->step_order < $step_checker) and ($st->step_order != 0))?"disabled":"";
                                                if($schedule_logs){
                                                    foreach($schedule_logs as $logs){
                                                        if(($logs->schedule_id == $row->id and $st->id == $logs->schedule_status) AND ($st->id != 4 AND $st->id !=8)){
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
                                    <?php endif; ?>
                                </div>
                                </div>
                                <input type="hidden" name="schedule_id" value="<?php echo $row->id; ?>" >
                                <input type="hidden" name="schedule_job_id" value="<?php echo $row->schedule_job_id; ?>" >
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

                            </form>
                        </div><!-- tab-pane -->
                        </div><!-- tab-pane -->
                        <?php $num++; endforeach; endif; ?>
                        <div id="newjob" class="tab-pane <?php echo (!$schedules)?"active show":""; ?>">
                            <div class="az-content-body az-content-body-contacts">
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <div class="media">
<!--                                            <div class="media-icon"><i class="fa fa-calendar-alt"></i></div>-->
                                            <div class="media-body">
                                                <div>
                                                    <label>Date</label>
                                                    <span class="tx-medium"><?php echo date('l d M,Y', strtotime($schedule_date));?></span>
                                                </div>
                                                <div>
                                                    <label>Time</label>
                                                    <span class="tx-medium"><?php echo ($shift_id ==1)?'Day':'Night';?> Shift</span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
<!--                                            <div class="media-icon align-self-start"></div>-->
                                            <div class="media-body">
                                                <div>
                                                    <label>Job type</label>
                                                    <span class="tx-medium"><?php echo $line_details->job_type_name; ?></span>
                                                </div>
                                                <div>
                                                    <label>Job Area</label>
                                                    <span class="tx-medium"><?php echo $line_details->job_area_name; ?></span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
<!--                                            <div class="media-icon"></div>-->
                                            <div class="media-body">
                                                <div>
                                                    <label><?php echo ($line_details->job_type_id == 1)?"Tank":"Line"; ?></label>
                                                    <span class="tx-medium"><?php echo $line_details->line_name; echo ($line_details->capacity != "")?" (".$line_details->capacity.")":""; ?> </span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
<!--                                            <div class="media-icon"><i class="fa fa-pen"></i></div>-->
                                            <div class="media-body">
                                                <div><br>
                                                    <form class="form-horizontal" name="new_line_schedule_form" id="new_line_schedule_form" method="post" action="<?php echo base_url(); ?>planner/new_schedule">
                                                        <div class="form-group">
                                                            <div class="row row-sm">
                                                                <div class="col-sm-12">
                                                                    <label >Search Job Number</label>
                                                                    <div class="input-group">
                                                                        <input type="text" class="form-control" placeholder="Search for jobs..." onkeypress="htmlData4('<?php echo base_url()."planner/search_job_type_numbers" ?>','job_type=<?php echo $line_details->job_type_id; ?>&job_number='+this.value)">
                                                                        <span class="input-group-btn">
                                                                          <button class="btn btn-outline-secondary" type="button"><i class="fa fa-search"></i></button>
                                                                        </span>
                                                                    </div><!-- input-group -->
                                                                    <input type="hidden" name="line_id" value="<?php echo $line_details->id; ?>" >
                                                                    <input type="hidden" name="shift_id" value="<?php echo $shift_id; ?>" >
                                                                    <input type="hidden" name="schedule_date" value="<?php echo $schedule_date; ?>" >
                                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="txtResult4"></div>

<!--                                                        <div class="form-group">-->
<!--                                                            <div class="row row-sm">-->
<!--                                                                <div class="col-sm-7">-->
<!--                                                                    <label >Job Number</label>-->
<!--                                                                    <input type="text" name="job_number" class="form-control" placeholder="" required="">                                                                    -->
<!--                                                                </div>-->
<!--                                                                <div class="col-sm-5">-->
<!--                                                                    <label >Bulk Size</label>-->
<!--                                                                    <input type="number" name="capacity" class="form-control" placeholder="" required="">-->
<!--                                                                </div>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                        <div class="form-group">-->
<!--                                                            <label>Description</label>-->
<!--                                                            <textarea class="form-control" rows="3" name="description" placeholder=""></textarea>-->
<!--                                                        </div>-->

                                                    </form>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                    </div><!-- media-list -->
                                </div><!-- az-contact-info-body -->
                            </div><!-- az-content-body -->
                        </div>
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