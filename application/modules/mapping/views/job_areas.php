<div class="container">
    <div class="az-content-body">
        <h2 class="az-content-title tx-24 mg-b-5">Job Areas</h2>
        <p class="mg-b-20">Job Areas are mapped to lines and tanks.</p><br>
        <div class="card card-table-two">


            <table id="datatable1" class="display responsive table table-condensed nowrap">
                <thead>
                <tr>
                    <th >#</th>
                    <th >Job Areas</th>
                    <th >Job Types</th>
                    <th >Modified By</th>
                    <th >Modified On</th>
                    <th class="wd-10p">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php $num=0; foreach ($job_areas as $row): $num++; ?>
                    <tr>
                        <td><?php echo $num; ?></td>
                        <td><?php echo ucwords($row->job_area_name); ?></td>
                        <td><?php echo ucwords($row->job_type_name); ?></td>
                        <td><?php echo ($row->modified_name)?$row->modified_name:"N/A"; ?></td>
                        <td><?php echo ($row->modified_on)?date('d-M-Y h:i a', strtotime($row->created_on)):"N/A"; ?></td>
                        <td>
                            <div class="btn-group  btn-group-sm">
                                <a href="#txtResult2" class="btn-default btn-sm text-primary" data-toggle="modal" title="Edit Job Area"  onclick="htmlData2('<?php echo base_url(); ?>mapping/edit_job_area', 'ch=<?php echo $row->id; ?>')"><i class="fa fa-edit tx-13"></i></a>
<!--                                <a href="--><?php //echo base_url()."facilities/index/".$row->id; ?><!--" class="btn-default btn-sm text-warning" title="County Stores" ><i class="fa fa-hospital tx-13"></i></a>-->
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
                <label class="az-rating-label">Job Areas</label>
                <h6 class="az-rating-value"><?php echo $job_areas_count; ?></h6>
            </div><!-- col -->

        </div>
            <hr class="mg-y-25">
        <div class="row mg-b-20">
            <div class="col">
                <label class="az-content-label tx-base mg-b-25">New Job Area</label>
                <form class="form-horizontal" name="new_job_area" method="post" action="<?php echo current_url(); ?>">
                <div class="d-flex flex-column mg-b-20 bg-gray-20">
                    <div class="form-group">
                        <input type="text" required class="form-control" name="job_area_name" id="job_area_name" placeholder="Job Area Name">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                    </div><!-- form-group -->
                    <div class="form-group">
                        <select name="job_type_id" id="job_type_id" required class="form-control select2" placeholder="Select Job type">
                            <option label="Select Job Type"></option>
                            <?php foreach ($job_types as $row):?>
                            <option value="<?php echo $row->id; ?>"><?php echo ucwords($row->job_type_name); ?></option>
                            <?php endforeach;?>

                        </select>
                    </div><!-- form-group -->
                    <button class="btn btn-az-primary pd-x-20" type="submit" name="submit" value="submit"><i class="fa fa-plus"></i> Add Job Area</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="txtResult2" class="modal hide effect-scale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>