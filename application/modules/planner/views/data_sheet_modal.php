

<!--<div class="modal-dialog modal-lg" role="modal" >-->
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
            <h6 class="modal-title">Data Sheet</h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
               <div class="col-md-12">
                   <?php if($schedule_data): ?>
                       <button id="btnExport" class="btn btn-primary"><i class="fa fa-file-excel tx-15"></i> Export to Excel</button><br>
                   <table class="table table-condensed" id="table_wrapper">
                       <thead>
                       <tr>
                           <th>Date</th>
                           <th>Day</th>
                           <th>Shift</th>
                           <th>Job Number</th>
                           <th>Description</th>
                           <th>Tank</th>
                           <th>Bulk Size</th>
                           <th>Pack line</th>
                           <th>Pack Units</th>
                           <th>Status</th>
                       </tr>
                       </thead>
                       <tbody>
                       <?php foreach($schedule_data as $row): ?>
                       <tr>
                           <td><?php echo date('d-m-Y', strtotime($row->schedule_date)); ?></td>
                           <td><?php echo $row->week_day; ?></td>
                           <td><?php echo $row->shift_name; ?></td>
                           <td><?php echo $row->job_number; ?></td>
                           <td><?php echo $row->description; ?></td>
                           <td><?php echo $row->tanks; ?></td>
                           <td><?php echo ($row->bulk_size)?round($row->bulk_size,2):''; ?></td>
                           <td><?php echo $row->pack_lines; ?></td>
                           <td><?php echo ($row->pack_units)?round($row->pack_units,2):''; ?></td>
                           <td><?php echo $row->schedule_status; ?></td>
                       </tr>
                       <?php endforeach; ?>
                       </tbody>
                   </table>
                   <?php else: ?>
                       <h3>No Schedule data was found within the specified timeline.</h3>
                   <?php endif; ?>
               </div>
            </div>
        </div><!-- modal-body -->
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-outline-light">Close</button>
        </div>
    </div>
<!--</div> modal-dialog-->