<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        /*border: 0px solid white;*/
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    }
    .padding-small td {
        padding: 0px;
        border-spacing: 0px;
    }
    .padding-medium td {
        padding: 8px;
        border-spacing: 10px;
    }
    .padding-large td {
        padding: 16px;
    }
    .bg-free {
        background-color: rgba(107, 0, 238, 0.08);
        color: purple;
    }
    .bg-noprogress {
        background-color: rgba(7, 63, 97, 0.25);
        color: darkslategrey;
    }
    .bg-workprogress {
        background-color: rgba(245, 179, 49, 0.26);
        color: #b58900;
    }
    .bg-complete {
        background-color: #F1FAF7;
        color: darkslategray;
    }
    .bg-onhold {
        background-color: rgba(255, 108, 33, 0.24);
        color: saddlebrown;
    }
    .bg-dispensed {
        background-color: rgba(75, 123, 250, 0.31);
    }
    .clickable-cell{
        cursor:pointer;
    }
</style>

<div class="az-content az-content-dashboard-four">
    <div class="media media-dashboard">
        <div class="media-body">
            <div class="az-content-header">
                <div>
                    <h6 class="az-content-title tx-18 mg-b-5">Manufacturing Planner</h6>
                    <p class="az-content-text tx-13 mg-b-0">Hi <?php echo $current_user->display_name; ?>, welcome back! Here's your planner summary.</p>
                </div>

                <div class="az-content-header-right">
                    <div class="media">
                        <div class="media-body">
                            <label>Start Date</label>
                            <h6>Oct 10, 2018</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                        <div class="media-body">
                            <label>End Date</label>
                            <h6>Oct 23, 2018</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <div class="media">
                        <div class="media-body">
                            <label>Job Type</label>
                            <h6><?php echo $job_area->job_type_name; ?></h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <a href="" class="btn btn-primary">Data Sheet  <i class="typcn typcn-export-outline"></i> </a>
                </div>
            </div><!-- az-content-header -->

            <div class="card card-dashboard-twelve mg-b-20">
                <div class="card-header">
                    <h6 class="card-title"><?php echo $job_area->job_area_name; ?> Schedule Overview <span>(<?php echo $job_area->symbol; ?>)</span></h6>

                    <div class="sales-overview">
                        <div class="media">
                            <div class="media-icon bg-purple"><i class="typcn typcn-ticket"></i></div>
                            <div class="media-body">
                                <label>Lines & Tanks Allocated</label>
                                <h4>23</h4>
                                <span><strong>10.5%</strong> of 30 Total</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-icon bg-teal"><i class="typcn typcn-ticket"></i></div>
                            <div class="media-body">
                                <label>Tanks Available</label>
                                <h4>15</h4>
                                <span><strong>89.5%</strong> of 10 Total</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-icon bg-primary"><i class="typcn typcn-chart-area-outline"></i></div>
                            <div class="media-body">
                                <label>Lines Available</label>
                                <h4>20</h4>
                                <span><strong>3.4%</strong> of 10 Total</span>
                            </div><!-- media-body -->
                        </div><!-- media -->
                        <div class="media">
                            <div class="media-body">
                                <label>About Schedule</label>
                                <p>The total allocation from all job areas is at 90% this week. Depending on your planning, you may need to spread jobs to the second week of the month. <a href="">Learn more</a></p>
                            </div><!-- media-body -->
                        </div><!-- media -->
                    </div><!-- sales-overview -->
                </div><!-- card-header -->
                <div class="card-body">
<!--                    <div class="card card-legend">-->
<!--                        <div><span class="bg-indigo"></span> Tickets Sold</div>-->
<!--                        <div><span class="bg-teal"></span> Tickets Available</div>-->
<!--                    </div>-->
                    <!-- chart-legend -->
                    <div class="table-wrapper">
                        <table  border="0" width="100%" align="center">
                            <thead class="thead-dark">
                                <tr bgcolor="#F8FAFC" style="height: 60px;">
                                    <th>Day</th>
                                    <th>Shift</th>
                                    <?php foreach($job_lines  as $row): ?>
                                        <th align="center"><?php echo $row->line_name; echo ($row->capacity !="")?"<br>(".$row->capacity.")":"";?></th>
                                    <?php endforeach;?>
                                </tr>
                            </thead>
                            <tbody>
                            <?php while($display_days >0): ?>
                                <tr class="padding-medium">
                                    <td rowspan="2" valign="center"><b><?php echo date('l', strtotime($start_date)); ?></b><br><small class="text-muted"><?php echo date('d M Y', strtotime($start_date)); ?></small></td>
                                    <td>Day</td>
                                    <?php foreach($job_lines  as $row): ?>
                                    <?php if(ISSET($area_schedule)): ?>
                                    <td>
                                        <table width="100%" border="0">
                                            <tr>
                                                <?php $num==0;
                                                    foreach($area_schedule as $as):
                                                    if($as->schedule_date==$start_date and $as->job_line_id==$row->id AND $as->shift_id==1): $num++;
                                                    //todo: figure out the status and match it with the correct color coding
                                                ?>
                                                    <td class="bg-complete clickable-cell" height="70px" data-target="#txtResult" data-toggle="modal" onclick="htmlData('<?php echo base_url(); ?>planner/schedule_modal','shift_id=1&line_id=<?php echo $row->id; ?>&schedule_date=<?php echo $start_date; ?>')">
                                                       <?php echo $as->job_number; ?><br><small><?php echo $as->description; ?></small>
                                                    </td>
                                                <?php
                                                    endif;
                                                    endforeach;
                                                   //if we did not have any then we display the free cell
                                                    if($num==0):
                                                    $num=0;
                                                ?>
                                                    <td class="bg-free" height="70px">FREE</td>
                                                <?php endif; ?>
                                            </tr>

                                        </table>
                                    </td>
                                    <?php else: ?>
                                    <!-- Since we dont have any schedule set we display free cells    -->
                                        <td>
                                            <table width="100%" border="0">
                                                <tr>
                                                    <td class="bg-free" height="70px" data-target="#txtResult" data-toggle="modal" onclick="htmlData('<?php echo base_url(); ?>planner/schedule_modal','shift_id=1&line_id=<?php echo $row->id; ?>&schedule_date=<?php echo $start_date; ?>')">FREE</td>
                                                </tr>
                                            </table>
                                        </td>
                                    <?php endif; endforeach;?>
                                </tr>
                                <tr class="padding-medium">
                                    <td>Night</td>
                                    <?php foreach($job_lines  as $row): ?>
                                        <?php if(ISSET($area_schedule)): ?>
                                            <td>
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <?php $num==0;
                                                        foreach($area_schedule as $as):
                                                            if($as->schedule_date==$start_date and $as->job_line_id==$row->id AND $as->shift_id==2): $num++;
                                                                //todo: figure out the status and match it with the correct color coding
                                                                ?>
                                                                <td class="bg-complete clickable-cell" height="70px" data-target="#txtResult" data-toggle="modal" onclick="htmlData('<?php echo base_url(); ?>planner/schedule_modal','')">
                                                                    <?php echo $as->job_number; ?><br><small><?php echo $as->description; ?></small>
                                                                </td>
                                                            <?php
                                                            endif;
                                                        endforeach;
                                                        //if we did not have any then we display the free cell
                                                        if($num==0):
                                                            $num=0;
                                                            ?>
                                                            <td class="bg-free" height="70px">FREE</td>
                                                        <?php endif; ?>
                                                    </tr>

                                                </table>
                                            </td>
                                        <?php else: ?>
                                            <!-- Since we dont have any schedule set we display free cells    -->
                                            <td>
                                                <table width="100%" border="0">
                                                    <tr>
                                                        <td class="bg-free" height="70px">FREE</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        <?php endif; endforeach;?>
                                </tr>
                                <tr class="padding-small"><td colspan="8"><hr></td></tr>

                            <?php
                                $display_days--;
                                $date = new DateTime($start_date);
                                $date->modify('+1 day');
                                $start_date = $date->format('d-m-Y');
                                endwhile;
                            ?>

                            </tbody>
                        </table>
                    </div><!-- chart-wrapper -->
                </div><!-- card-body -->
            </div><!-- card -->

        </div><!-- media-body -->

        <div class="media-aside">
            <div class="row row-sm">
                <div class="col-md-6 col-lg-4 col-xl-12">
                    <div class="card card-dashboard-calendar">
                        <h6 class="card-title">Event Calendar</h6>
                        <div class="media az-media-date">
                            <h1>04</h1>
                            <div class="media-body">
                                <p>Jun 2024</p>
                                <span>Tuesday</span>
                            </div>
                        </div>
                        <div class="card-body"><div class="fc-datepicker"></div></div>
                    </div><!-- card -->
                </div><!-- col -->
                <div class="col-md-6 col-lg-8 col-xl-12 mg-t-20 mg-md-t-0 mg-xl-t-20">
                    <div class="card card-dashboard-events">
                        <div class="card-header">
                            <h6 class="card-title"><?php echo date('M Y'); ?></h6>
                            <h5 class="card-subtitle">Job Areas</h5>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <nav class="nav az-nav-line az-nav-line-chat">
                                <?php $num=0; foreach($job_types as $row): ?>
                                <a href="" data-toggle="tab" data-target="#tabJobArea_<?php echo $row->id; ?>" class="nav-link <?php echo ($num==0)?'active show':'';?>"><?php echo $row->job_type_name; ?></a>
<!--                                <a href="" data-toggle="tab" class="nav-link">Manufacturing</a>-->
                                <?php $num++; endforeach; ?>
                            </nav>
                            <div class="tab tab-content">
                                <?php $num=0; foreach($job_types as $row): ?>
                                <div id="tabJobArea_<?php echo $row->id; ?>" class="tab-pane <?php echo ($num==0)?'active show':'';?>">
                                    <div class="list-group">
                                        <?php foreach($job_areas  as $row2): if($row->id == $row2->job_type_id): ?>
                                        <div class="list-group-item">
                                            <div class="event-indicator bg-primary"></div>
                                            <label><?php echo $row2->symbol; ?></label>
                                            <h6><?php echo $row2->job_area_name; ?></h6>
                                            <p><strong>12/15</strong> Lines (15%)</p>
                                        </div><!-- list-group-item -->
                                        <?php endif; endforeach; ?>
                                    </div><!-- list-group -->
                                </div>
                                <?php $num++; endforeach; ?>
                            </div>
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- media-aside -->
    </div><!-- media -->

</div><!-- az-content -->


<div id="txtResult" class="modal hide effect-scale" role="dialog" aria-labelledby="myModalLabel" > </div>
