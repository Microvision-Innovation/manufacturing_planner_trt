
    <div class="container">
        <div class="az-content-body">
            <div class="az-content-breadcrumb">
                <span>Home</span>
                <span>Job Types</span>
            </div>
            <h2 class="az-content-title tx-24 mg-b-5">Job Types</h2>
            <p class="mg-b-20">Job Types are linked to job areas and lines.</p>
            <form class="form-horizontal" method="post" name="new_job_type" id="new_job_type" action="<?php echo current_url(); ?>">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" required placeholder="Job Type Name" name="job_type_name" required="">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                    </div><!-- col -->
                    <div class="col-md-1">
                        <button class="btn btn-primary btn-block" type="submit" name="submit" value="submit"><i class="fa fa-plus"></i> Add Job Type</button>
                    </div><!-- col -->
                </div>
            </form>
            <div class="card card-table-two">
                        <table id="datatable1" class="display responsive  nowrap">
                            <thead>
                            <tr>
                                <th >#</th>
                                <th >Job type</th>
                                <th >Created By</th>
                                <th >Created On</th>
                                <th >Modified On</th>
                                <th class="wd-10p">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $num=0; foreach($job_types as $row): $num++; ?>
                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo ucwords($row->job_type_name); ?></td>
                                <td><?php echo $row->display_name; ?></td>
                                <td><?php echo date('d-M-Y H:i', strtotime($row->created_on)); ?></td>
                                <td><?php echo ($row->modified_on)?date('d-M-Y H:i', strtotime($row->created_on)):"N/A"; ?></td>
                                <td>
                                    <div class="btn-group  btn-group-sm">
                                        <a href="#txtResult2" class="btn-default btn-sm text-primary" data-toggle="modal" title="Edit Job Type"  onclick="htmlData2('<?php echo base_url(); ?>mapping/edit_job_types', 'ch=<?php echo $row->id; ?>')"><i class="fa fa-edit tx-13"></i></a>

                                    </div>
                                </td>
                            </tr>
                           <?php endforeach; ?>
                            </tbody>
                        </table>

            </div>

            <div class="mg-lg-b-30"></div>

        </div><!-- az-content-body -->
    </div>

    <div id="txtResult2" class="modal hide effect-scale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>