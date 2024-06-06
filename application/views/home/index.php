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
                            <h6>Production(Bulk)</h6>
                        </div><!-- media-body -->
                    </div><!-- media -->
                    <a href="" class="btn btn-primary">Data Sheet  <i class="typcn typcn-export-outline"></i> </a>
                </div>
            </div><!-- az-content-header -->

            <div class="card card-dashboard-twelve mg-b-20">
                <div class="card-header">
                    <h6 class="card-title">Home Care Schedule Overview <span>(Bulk)</span></h6>

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
                                    <th align="center">TK4<br>(1 000KG)</th>
                                    <th align="center">TK5<br>(1 000KG)</th>
                                    <th align="center">TK6<br>(1 000KG)</th>
                                    <th align="center">TK7<br>(1 000KG)</th>
                                    <th align="center">TK8<br>(1 000KG)</th>
                                    <th align="center">TK2B<br>(1 000KG)</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr class="padding-medium">
                                <td rowspan="2" valign="center"><b>Monday</b><br><small class="text-muted">03 Jun 2024</small></td>
                                <td>Day</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="bg-complete clickable-cell" height="70px" data-target="#txtResult" data-toggle="modal" onclick="htmlData('<?php echo base_url(); ?>home/schedule_modal','')">
                                                DG77008 (1/3)<br><small>Roll On 150ml 6000</small>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="bg-workprogress clickable-cell" height="70px" data-target="#txtResult" data-toggle="modal" onclick="htmlData('<?php echo base_url(); ?>home/schedule_modal','')">
                                                DG77008 (1/3)<br><small>Roll On 150ml 6000</small>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr>
                                            <td class="bg-dispensed clickable-cell" height="70px" data-target="#txtResult" data-toggle="modal" onclick="htmlData('<?php echo base_url(); ?>home/schedule_modal','')">
                                                 DG77008 (1/3) <br><small>Roll On 150ml 6000</small>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-noprogress" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                                <td >
                                    <table height="100%" border="0" >
                                        <tr class="padding-small" ><td class="bg-noprogress" height="35px"> DG77008</td></tr>
                                        <tr class="padding-small" ><td class="bg-workprogress" height="35px">DG77008 (1/2)</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-noprogress" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="padding-medium">
                                <td>Night</td>
                                <td>
                                    <table height="100%" border="0" >
                                        <tr class="padding-small" ><td class="bg-workprogress" height="35px"> DG77008</td></tr>
                                        <tr class="padding-small" ><td class="bg-complete" height="35px">DG77008</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-dispensed" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-workprogress" height="70px"> DG77008 (2/2)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-onhold" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="padding-small"><td colspan="8"><hr></td></tr>

                            <tr class="padding-medium">
                                <td rowspan="2" valign="center"><b>Tuesday</b><br><small class="muted">03 Jun 2024</small></td>
                                <td>Day</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-complete" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-workprogress" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-dispensed" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-noprogress" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                                <td >
                                    <table height="100%" border="0" >
                                        <tr class="padding-small" ><td class="bg-noprogress" height="35px"> DG77008</td></tr>
                                        <tr class="padding-small" ><td class="bg-workprogress" height="35px">DG77008 (1/2)</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-noprogress" height="70px"> DG77008 (1/3)<br><small>Roll On 150ml 6000</small></td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="padding-medium">
                                <td>Night</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="padding-small"><td colspan="8"><hr></td></tr>

                            <tr class="padding-medium">
                                <td rowspan="2" valign="center"><b>Wednesday</b><br><small class="muted">03 Jun 2024</small></td>
                                <td>Day</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="padding-medium">
                                <td>Night</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="padding-small"><td colspan="8"><hr></td></tr>

                            <tr class="padding-medium">
                                <td rowspan="2" valign="center"><b>Thursday</b><br><small class="muted">03 Jun 2024</small></td>
                                <td>Day</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="padding-medium">
                                <td>Night</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                            </tr>

                            <tr class="padding-small"><td colspan="8"><hr></td></tr>

                            <tr class="padding-medium">
                                <td rowspan="2" valign="center"><b>Friday</b><br><small class="muted">03 Jun 2024</small></td>
                                <td>Day</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                            </tr>
                            <tr class="padding-medium">
                                <td>Night</td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px"> FREE </td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                                <td>
                                    <table width="100%" border="0">
                                        <tr><td class="bg-free" height="70px">FREE</td></tr>
                                    </table>
                                </td>
                            </tr>
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
                            <h6 class="card-title">June 2024</h6>
                            <h5 class="card-subtitle">Job Areas</h5>
                        </div><!-- card-header -->
                        <div class="card-body">
                            <nav class="nav az-nav-line az-nav-line-chat">
                                <a href="" data-toggle="tab" class="nav-link active show">Production</a>
                                <a href="" data-toggle="tab" class="nav-link">Manufacturing</a>
                            </nav>
                            <div class="list-group">
                                <div class="list-group-item">
                                    <div class="event-indicator bg-primary"></div>
                                    <label>Bulk</label>
                                    <h6>Home Care (Area 1)</h6>
                                    <p><strong>12/15</strong> Lines (15%)</p>

                                </div><!-- list-group-item -->
                                <div class="list-group-item">
                                    <div class="event-indicator bg-primary"></div>
                                    <label>Bulk</label>
                                    <h6>Personal Care (Area 1)</h6>
                                    <p><strong>12/15</strong> Lines (15%)</p>

                                </div><!-- list-group-item -->
                                <div class="list-group-item">
                                    <div class="event-indicator bg-primary"></div>
                                    <label>Bulk</label>
                                    <h6>Aerosol 1 (Area 3)</h6>
                                    <p><strong>12/15</strong> Lines (15%)</p>

                                </div><!-- list-group-item -->
                                <div class="list-group-item">
                                    <div class="event-indicator bg-primary"></div>
                                    <label>Bulk</label>
                                    <h6>Aerosol 2 (Area 4)</h6>
                                    <p><strong>12/15</strong> Lines (15%)</p>

                                </div><!-- list-group-item -->
                                <div class="list-group-item">
                                    <div class="event-indicator bg-primary"></div>
                                    <label>Bulk</label>
                                    <h6>Personal care (Area 2)</h6>
                                    <p><strong>12/15</strong> Lines (15%)</p>

                                </div><!-- list-group-item -->
                                <div class="list-group-item">
                                    <div class="event-indicator bg-primary"></div>
                                    <label>Bulk</label>
                                    <h6>Home Care Bulk (Area 2)</h6>
                                    <p><strong>12/15</strong> Lines (15%)</p>

                                </div><!-- list-group-item -->
                            </div><!-- list-group -->
                        </div><!-- card-body -->
                    </div><!-- card -->
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- media-aside -->
    </div><!-- media -->

</div><!-- az-content -->

<div id="txtResult2" class="modal hide effect-scale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="false"> </div>
<div id="txtResult" class="modal hide effect-scale" role="dialog" aria-labelledby="myModalLabel" > </div>


<!--modal for changing password -->
<div id="change_password" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title"><span class="fa fa-key tx-15"></span> Change Your Password</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url(); ?>user_accounts/edit_password" name="edit_user_password" id="edit_user_password" class="form-horizontal">
                <div class="modal-body">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>">
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label class="control-label mg-b-0 pull-right" for="password">New Password </label>
                        </div>
                        <div class="col-md-7 mg-t-5 mg-md-t-0">
                            <input id="password" name="password" required="required" type="password"  class="form-control" />
                            <input type="hidden" name="userId" value="">
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label class="control-label mg-b-0 pull-right" for="repeat_password">Confirm Password </label>
                        </div>
                        <div class="col-md-7 mg-t-5 mg-md-t-0">
                            <input id="repeat_password" name="repeat_password" required="required" type="password"  class="form-control" />

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" value="Update Profile" class="btn btn-indigo">Change Password</button>
                </div>
            </form>
        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->