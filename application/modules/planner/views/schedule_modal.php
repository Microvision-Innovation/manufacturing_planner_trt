<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<div class="modal-dialog modal-lg" role="modal" xmlns="http://www.w3.org/1999/html">
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
                                    <h6><?php echo $row->job_number; ?></h6>
                                    <span class="phone"><?php echo $row->capacity; ?></span>
                                </div><!-- az-contact-body -->
                            </div><!-- az-contact-item -->
                            <?php $num++; endforeach; endif; ?>
                            <div class="az-contact-item <?php echo (!$schedules)?"selected":""; ?> bg-gray-100" data-toggle="tab" data-target="#newjob">
                                <div class="az-contact-body">
                                    <h6>Add New <i class="fa fa-plus-circle"></i></h6>
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
                                                <p><?php echo $row->description; ?></p>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="az-contact-action nav">
                                            <a href="#" class="nav-link"><?php echo $row->job_type_name; ?></a>
                                            <a href="#" class="nav-link"><?php echo $row->symbol; ?> Size: <?php echo $row->capacity; ?></a>
                                        </div><!-- az-contact-action -->

                                    </div><!-- az-contact-info-header -->
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <div class="media">
                                            <div class="media-icon align-self-start">
                                                <i class="fa fa-receipt"></i>
                                                <span class="h4 text-success"><?php echo $row->schedule_status; ?></span>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <label>Job Area</label>
                                                    <span class="tx-medium"><?php echo $row->job_area_name; ?></span>
                                                </div>
                                                <div>
                                                    <label><?php echo ($row->symbol=="Bulk")?"Tank":"Line";?></label>
                                                    <span class="tx-medium"> <?php echo $row->line_name; echo ($row->capacity !="")?"(".$row->capacity.")":""; ?></span>
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
                                        <div class="media">
                                            <div class="media-icon"></div>
                                            <div class="media-body">
                                                <div>
                                                    <a href="#txtresult2" class="btn btn-primary btn-icon btn-xs pull-right" onclick="htmlData2('<?php echo base_url(); ?>planner/extend_schedule','job_area_id=<?php echo $row->job_area_id; ?>&line_id=<?php echo $line_details->id; ?>')"><i class="typcn typcn-plus-outline"></i></a>
                                                    <br><br><br>
                                                    <!-- Display for addtional shift that is displayed by ajax-->
                                                    <div id="txtResult2"></div>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->

                                    </div><!-- media-list -->
                                </div><!-- az-contact-info-body -->

                            <div class="row">
                                <div class="col-md-7">
                                    <?php if($schedule_logs): ?>
                                    <label>Job Logs</label>
                                    <table width="60%" align="left" cellspacing="3" cellpadding="3">
                                        <thead>
                                        <tr>
                                            <th><span align="left">User</span></th>
                                            <th><span align="left">Date</span></th>
                                            <th><span align="left">Status</span></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($schedule_logs as $logs): if($logs->schedule_id == $row->id): ?>
                                        <tr>
                                            <td align="left"><?php echo $logs->display_name; ?></td>
                                            <td><?php echo date('d M,Y H:i', strtotime($logs->created_on)); ?></td>
                                            <td><?php echo $logs->schedule_status_name; ?></td>
                                        </tr>
                                        <?php endif; endforeach; ?>
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <label>Job Status</label>
                                    <div class="row">

                                        <?php
                                            foreach($statuses as $st):
                                                $checked = "";
                                            foreach($schedule_logs as $logs){
                                                if($logs->schedule_id == $row->id and $st->id == $logs->schedule_status){
                                                    $checked = "checked disabled";
                                                }
                                            }
                                        ?>
                                        <div class="col-lg-12 ">
                                            <label class="checkbox">
                                                <input type="checkbox"  name="statuses[]" value="<?php echo $st->id; ?>" <?php echo $checked; ?>><span><?php echo $st->schedule_status; ?></span>
                                            </label>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <input type="hidden" name="schedule_id" value="<?php echo $row->id; ?>" >
                                <input type="hidden" name="schedule_job_id" value="<?php echo $row->schedule_job_id; ?>" >
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                                <button type="submit" class="btn btn-az-primary btn-block" name="submit" value="submit">Update Schedules</button>
                            </div>
                            </form>
                        </div><!-- tab-pane -->
                        </div><!-- tab-pane -->
                        <?php $num++; endforeach; endif; ?>
                        <div id="newjob" class="tab-pane <?php echo (!$schedules)?"active show":""; ?>">
                            <div class="az-content-body az-content-body-contacts">
                                <div class="az-contact-info-body">
                                    <div class="media-list">
                                        <div class="media">
                                            <div class="media-icon"><i class="fa fa-calendar-alt"></i></div>
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
                                            <div class="media-icon align-self-start"></div>
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
                                            <div class="media-icon"></div>
                                            <div class="media-body">
                                                <div>
                                                    <label><?php echo ($line_details->job_type_id == 1)?"Tank":"Line"; ?></label>
                                                    <span class="tx-medium"><?php echo $line_details->line_name; echo ($line_details->capacity != "")?" (".$line_details->capacity.")":""; ?> </span>
                                                </div>
                                            </div><!-- media-body -->
                                        </div><!-- media -->
                                        <div class="media">
                                            <div class="media-icon"><!--<i class="fa fa-pen"></i>--></div>
                                            <div class="media-body">
                                                <div><br>
                                                    <form class="form-horizontal" name="new_line_schedule_form" id="new_line_schedule_form" method="post" action="<?php echo base_url(); ?>planner/new_schedule">
                                                        <div class="form-group">
                                                            <div class="row row-sm">
                                                                <div class="col-sm-7">
                                                                    <label >Job Number</label>
                                                                    <input type="text" name="job_number" class="form-control" placeholder="" required="">
                                                                    <input type="hidden" name="line_id" value="<?php echo $line_details->id; ?>" >
                                                                    <input type="hidden" name="shift_id" value="<?php echo $shift_id; ?>" >
                                                                    <input type="hidden" name="schedule_date" value="<?php echo $schedule_date; ?>" >
                                                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                                                                </div><!-- col -->
                                                                <div class="col-sm-5">
                                                                    <label >Bulk Size</label>
                                                                    <input type="number" name="capacity" class="form-control" placeholder="" required="">
                                                                </div><!-- col -->
                                                            </div><!-- row -->
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Description</label>
                                                            <textarea class="form-control" rows="3" name="description" placeholder=""></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-az-secondary btn-block" name="submit" value="submit">Submit Schedule</button>
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
        <div class="modal-footer">
<!--            <button  id="submit" class="btn btn-primary"><i class="fa fa-save"></i> Submit</button>-->
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
        </div>
    </div>
</div><!-- modal-dialog