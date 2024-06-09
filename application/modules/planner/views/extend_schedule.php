<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

?>
<div class="form-group">
    <div class="row">
        <div class="col-md-6">
            <label >Job Area</label>
            <select class="form-control" required>
                <option label="Select Job Area"></option>
                <option value="January">Home Care (Area 1)</option>
                <option value="February">Personal Care (Area 1)</option>
                <option value="March">Aerosol 1 (Area 3)</option>
                <option value="April">Personal care (Area 2)</option>
                <option value="May">Home Care Bulk (Area 2)</option>
            </select>
        </div><!-- col -->
        <div class="col-md-6">
            <label>Tank</label>
            <select class="form-control">
                <option label="Choose Tank"></option>
                <option value="January">TK4 (1000Kg)</option>
                <option value="February">TK5 (1000Kg)</option>
                <option value="March">TK6 (1000Kg)</option>
                <option value="April">TK7 (1000Kg)</option>
                <option value="May">TK8 (1000Kg)</option>
            </select>
        </div><!-- col -->
    </div><!-- row -->
    <br>
    <div class="row ">
        <div class="col-sm-12">
            <label>Schedule Date</label>
            <div class="row">
                <div class="col-sm-6">
                    <input type="date" class="form-control" placeholder="" required="">
                </div><!-- col -->
                <div class="col-sm-6 mg-t-10 mg-sm-t-0">
                    <select class="form-control select2-no-search">
                        <option label="Choose Shift"></option>
                        <option value="2018">Day Shift</option>
                        <option value="2019">Night Shift</option>
                    </select>
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- col -->
    </div><!-- row -->
</div>