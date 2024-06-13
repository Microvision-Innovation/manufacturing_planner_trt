<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label >Job Area</label>
            <select class="form-control" name="job_area_id" id="job_area_id" required>
                <option label="Select Job Area"></option>
                <?php foreach($job_areas as $ja): $selected = ($ja->id == $extension_job_area_id)?"selected":""; ?>
                <option value="<?php echo $ja->id; ?>" <?php echo $selected; ?>><?php echo $ja->job_area_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div><!-- col -->
        <div class="col-md-6">
            <label>Tank/Line</label>
            <select class="form-control" name="line_id" id="line_id">
                <option label="Choose Tank"></option>
                <?php foreach($lines as $l): $selected = ($l->id == $extension_line_id)?"selected":""; ?>
                    <option value="<?php echo $l->id; ?>" <?php echo $selected; ?>><?php echo $l->line_name; ?></option>
                <?php endforeach; ?>
            </select>
        </div><!-- col -->
    </div><!-- row -->
    <br>
    <div class="row ">
        <div class="col-sm-12">
            <label>Schedule Date</label>
            <div class="row">
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="extension_date" id="extension_date" placeholder="" required="">
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