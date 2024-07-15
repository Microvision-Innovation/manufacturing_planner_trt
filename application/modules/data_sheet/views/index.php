
<div class="az-content az-content-dashboard-four">
    <div class="media media-dashboard">
        <div class="media-body">
            <div class="az-content-header">
                <div>
                    <h6 class="az-content-title tx-18 mg-b-5">TRT Manufacturing Planner - Data Sheet</h6>
                    <p class="az-content-text tx-13 mg-b-0">Hi <?php echo $current_user->display_name; ?>, welcome to your data sheet summary.</p>
                </div>
                <div class="az-content-header-right">
                </div>
            </div><!-- az-content-header -->

            <div class="card card-dashboard-twelve mg-b-20">
                <div class="card-header">
                    <h6 class="card-title">Data Sheet

                </div><!-- card-header -->
                <div class="card-body">
                    <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                    <input type="date" name="start_date" required value="<?php echo date('Y-m-d', strtotime($start_date)); ?>" class="form-control fc-datepicker" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>End Date</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="typcn typcn-calendar-outline tx-24 lh--9 op-6"></i>
                                        </div>
                                    </div>
                                    <input type="date" name="end_date" required value="<?php echo date('Y-m-d', strtotime($end_date)); ?>" class="form-control fc-datepicker" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><br></label><br>
                                <button type="submit" class="btn btn-primary" name="submit" id="submit"><i class="fa fa-file-excel"></i>Submit</button>
                            </div>
                        </div>
                    </div>
                    </form>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if($schedule_data): ?>
                                <button id="btnExport" class="btn btn-success pull-right"><i class="fa fa-file-excel tx-15"></i> Export to Excel</button><br>
                                <table class="table table-condensed table-bordered" id="table_wrapper" border="1" width="100%" >
                                    <thead>
                                    <tr>
                                        <th>Start Date</th>
                                        <th>Planned Date</th>
                                        <th>Day</th>
                                        <th>Shift</th>
                                        <th>Job Number</th>
                                        <th>Description</th>
                                        <th>Tank</th>
                                        <th>Bulk Size</th>
                                        <th>Pack line</th>
                                        <th>Pack Units</th>
                                        <th>Output Qty</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($schedule_data as $row): ?>
                                        <tr>
                                            <td><?php echo date('d-m-Y', strtotime($row->schedule_date)); ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($row->planned_start_date)); ?></td>
                                            <td><?php echo $row->week_day; ?></td>
                                            <td><?php echo $row->shift_name; ?></td>
                                            <td><?php echo $row->job_number; ?></td>
                                            <td><?php echo $row->description; ?></td>
                                            <td><?php echo $row->tanks; ?></td>
                                            <td><?php echo ($row->bulk_size)?round($row->bulk_size,2):''; ?></td>
                                            <td><?php echo $row->pack_lines; ?></td>
                                            <td><?php echo ($row->pack_units)?round($row->pack_units,2):''; ?></td>
                                            <td><?php echo ($row->produced_qty)?round($row->produced_qty,2):''; ?></td>
                                            <td><?php echo $row->schedule_status; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                                <button id="btnExport" class="btn btn-success pull-right"><i class="fa fa-file-excel tx-15"></i> Export to Excel</button>
                            <?php else: ?>
                                <h3>No Schedule data was found within the specified timeline.</h3>
                            <?php endif; ?>
                        </div>
                    </div>
                </div><!-- card-body -->
            </div><!-- card -->

        </div><!-- media-body -->


    </div><!-- media -->

</div><!-- az-content -->

