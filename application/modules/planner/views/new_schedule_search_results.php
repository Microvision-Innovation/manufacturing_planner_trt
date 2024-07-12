<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<?php if($search_results):?>
<div class="row row-sm">
    <div class="col-sm-12">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Job Number</th>
                <th>Size</th>
                <th>Item Details</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach($search_results as $row): ?>
            <tr>
                <td><input name="jobs_id" type="radio" value="<?php echo $row->id; ?>" required></td>
                <td><?php echo $row->job_number; ?></td>
                <td><?php echo number_format(round($row->capacity,2)); ?></td>
                <td><?php echo $row->description; ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="form-group">
    <label>Comments</label>
    <textarea class="form-control" rows="3" name="comments" placeholder="Comments"></textarea>
</div>
    <div class="row">
        <div class="col-md-5">

        </div>

        <div class="col-md-7">
            <label>Job Status</label>
            <table>
                <tr>
                    <?php foreach($statuses as $st): ?>
                        <td>
                            <label class="checkbox">
                                <input type="checkbox" class="form-control" name="statuses[]" value="<?php echo $st->id; ?>" ><span><?php echo $st->schedule_status; ?></span>
                            </label>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </table>
        </div>
    </div>
<hr>
<button type="submit" class="btn btn-az-secondary btn-block" name="submit" value="submit">Submit Schedule</button>
<?php else: ?>
<h5>No results were found matching your job number. Please check if the job has already been scheduled</h5>
<?php endif; ?>
