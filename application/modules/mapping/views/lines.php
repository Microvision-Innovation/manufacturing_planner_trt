<div class="container">
    <div class="az-content-body">
        <h2 class="az-content-title tx-24 mg-b-5">Lines & Tanks</h2>
        <p class="mg-b-20">Lines & Tanks are mapped to job areas and job types.</p><br>
        <div class="card card-table-two">


            <table id="datatable1" class="display responsive table table-condensed nowrap">
                <thead>
                <tr>
                    <th >#</th>
                    <th >Lines/Tanks</th>
                    <th >Job Type</th>
                    <th >Job Areas</th>
                    <th >Modified By</th>
                    <th >Modified On</th>
                    <th class="wd-10p">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=0; foreach ($lines as $row): $num++;  $capacity=($row->capacity != "")?"(".$row->capacity.")":""; ?>
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo ucwords($row->line_name)." ".$capacity; ?></td>
                        <td><?php echo ucwords($row->job_type_name); ?></td>
                        <td><?php echo ucwords($row->job_area_name); ?></td>
                        <td><?php echo ($row->modified_name)?$row->modified_name:"N/A"; ?></td>
                        <td><?php echo ($row->modified_on)?date('d-M-Y h:i a', strtotime($row->created_on)):"N/A"; ?></td>
                        <td>
                            <div class="btn-group  btn-group-sm">
                                <a href="#txtResult2" class="btn-default btn-sm text-primary" data-toggle="modal" title="Edit Line/Tank"  onclick="htmlData2('<?php echo base_url(); ?>', 'ch=<?php echo $row->id; ?>')"><i class="fa fa-edit tx-13"></i></a>
                                <a href="#txtResult2" class="btn-default btn-sm text-warning" data-toggle="modal" title="Delete Tank"  onclick="htmlData2('<?php echo base_url(); ?>', 'ch=<?php echo $row->id; ?>')"><i class="fa fa-trash-alt tx-13"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="az-content-body-right">
        <div class="row mg-b-20">
            <div class="col">
                <label class="az-rating-label">Lines & Tanks</label>
                <h6 class="az-rating-value"><?php echo $lines_count; ?></h6>
            </div><!-- col -->
            <div class="col">
                <label class="az-rating-label">Mapping</label>
                <h6 class="az-rating-value">100%</h6>
            </div><!-- col -->
        </div>
            <hr class="mg-y-25">
        <div class="row mg-b-20">
            <div class="col">
                <label class="az-content-label tx-base mg-b-25">New Line/Tank </label>
                <form class="form-horizontal" name="new_line" method="post" action="<?php echo current_url(); ?>">
                <div class="d-flex flex-column mg-b-20 bg-gray-20">
                    <div class="form-group">
                        <input type="text" required class="form-control" name="line_name" id="line_name" placeholder="Line/Tank Name">
                    </div><!-- form-group -->

                    <div class="form-group">

                        <select name="county" id="job_type" required class="form-control select2" placeholder="Select Job Type" onchange="htmlData('<?php echo base_url(); ?>mapping/get_job_areas','ch='+this.value)">
                            <option label="Select Job Type" disabled selected>Select Job Type</option>
                            <?php foreach ($job_types as $row):?>
                            <option value="<?php echo $row->id; ?>"><?php echo ucwords($row->job_type_name); ?></option>
                            <?php endforeach;?>

                        </select>
                    </div><!-- form-group -->
                    <div id="txtResult"></div>
                    <button class="btn btn-az-primary pd-x-20" type="submit" name="submit" value="submit"><i class="fa fa-plus"></i> Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>