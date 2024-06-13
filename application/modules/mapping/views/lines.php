<div class="container">
    <div class="az-content-body">
        <div class="az-content-breadcrumb">
            <span>Home</span>
            <span>Lines/Tanks</span>
        </div>
        <h2 class="az-content-title tx-24 mg-b-5">Lines & Tanks</h2>
        <p class="mg-b-20">Lines & Tanks are mapped to job areas and job types.</p><br>
        <div class="row">
            <div class="col-md-9">
                <div class="card bd-0">
                    <div class="card-header bg-gray-400 bd-b-0-f pd-b-0">
                        <nav class="nav az-nav-line-chat ">
                            <?php $n=0; foreach($job_types as $jt): ?>
                                <a class="nav-link <?php echo($n==0)?"active":""; ?>" data-toggle="tab" href="#tabCont<?php echo $jt->id; ?>"><?php echo $jt->job_type_name; ?></a>
                                <?php $n++; endforeach; ?>
                        </nav>
                    </div><!-- card-header -->
                    <div class="card-body bd bd-t-0 tab-content">
                        <?php $n=0; foreach($job_types as $jt): $n++;?>
                            <div id="tabCont<?php echo $jt->id; ?>" class="tab-pane <?php echo($n==1)?"active show":""; ?>">

                                <table id="datatable<?php echo $n; ?>" width="100%" class="display responsive table table-condensed nowrap">
                                    <thead>
                                    <tr>
<!--                                        <th >#</th>-->
                                        <th >Job Areas</th>
                                        <th ><?php if($jt->symbol=='Bulk'){ echo 'Tanks';}elseif($jt->symbol=='Pack'){ echo "Lines";}else{echo 'Lines/Tanks '; } ?></th>
<!--                                        <th >Job Type</th>-->

<!--                                        <th >Modified By</th>-->
<!--                                        <th >Modified On</th>-->
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $num=0; foreach ($lines as $row): if($jt->id == $row->job_type_id): $num++;  $capacity=($row->capacity != "")?"(".$row->capacity.")":""; ?>
                                        <tr>
<!--                                            <td>--><?php //echo $num; ?><!--</td>-->
                                            <td><?php echo ucwords($row->job_area_name); ?></td>
                                            <td><?php echo ucwords($row->line_name)." ".$capacity; ?></td>
<!--                                            <td>--><?php //echo ucwords($row->job_type_name); ?><!--</td>-->

<!--                                            <td>--><?php //echo ($row->modified_name)?$row->modified_name:"N/A"; ?><!--</td>-->
<!--                                            <td>--><?php //echo ($row->modified_on)?date('d-M-Y h:i a', strtotime($row->created_on)):"N/A"; ?><!--</td>-->
                                            <td>
                                                <div class="btn-group  btn-group-sm">
                                                    <a href="#txtResult2" class="btn-default btn-sm text-primary" data-toggle="modal" title="Edit Line/Tank"  onclick="htmlData2('<?php echo base_url(); ?>', 'ch=<?php echo $row->id; ?>')"><i class="fa fa-edit tx-13"></i></a>
                                                    <a href="#txtResult2" class="btn-default btn-sm text-warning" data-toggle="modal" title="Delete Tank"  onclick="htmlData2('<?php echo base_url(); ?>', 'ch=<?php echo $row->id; ?>')"><i class="fa fa-trash-alt tx-13"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; endforeach; ?>
                                    </tbody>
                                </table>

                            </div><!-- tab-pane -->
                            <?php  endforeach; ?>

                    </div><!-- card-body -->
                </div><!-- card -->
            </div>
            <div class="col-md-3">
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
                                    <button class="btn btn-az-secondary pd-x-20" type="submit" name="submit" value="submit"><i class="fa fa-plus-circle"></i> Add New</button>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>


    </div>

</div>