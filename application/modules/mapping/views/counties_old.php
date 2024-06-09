
    <div class="az-content-body">
        <div class="az-content-body-left">
            <div class="az-content-breadcrumb">
                <span>Home</span>
                <span>Counties</span>
            </div>
            <h2 class="az-content-title tx-24 mg-b-5">Counties</h2>
            <p class="mg-b-20">Counties are linked to sub-counties, facilities and users.</p>
            <form class="form-horizontal pull-right" method="post" name="new_county" id="new_county" action="<?php echo current_url(); ?>">
                <div class="row row-sm">
                    <div class="col-md-7"></div>
                    <div class="col-md-3 pull-right">
                        <input type="text" class="form-control" required placeholder="New County Name">
                    </div><!-- col -->
                    <div class="col-md-2 pull-right">
                        <button class="btn btn-az-primary btn-block"><i class="fa fa-plus"></i> Add County</button>
                    </div><!-- col -->

                </div><!-- row -->
            </form>
            <div class="card card-table-two">


                        <table id="datatable1" class="display responsive  nowrap">
                            <thead>
                            <tr>
                                <th >#</th>
                                <th >County Name</th>
                                <th >Created By</th>
                                <th >Created On</th>
                                <th >Modified On</th>
                                <th class="wd-10p">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $num=0; foreach($counties as $row): $num++; ?>
                            <tr>
                                <td><?php echo $num; ?></td>
                                <td><?php echo ucwords($row->name); ?></td>
                                <td><?php echo $row->display_name; ?></td>
                                <td><?php echo date('d-M-Y h:i a', strtotime($row->created_on)); ?></td>
                                <td><?php echo ($row->modified_on)?date('d-M-Y h:i a', strtotime($row->created_on)):"N/A"; ?></td>
                                <td>
                                    <div class="btn-group  btn-group-sm">
                                        <a href="#txtResult2" class="btn-default btn-sm text-primary" data-toggle="modal" title="Edit County"  onclick="htmlData2('<?php echo base_url(); ?>', 'ch=<?php echo $row->id; ?>')"><i class="fa fa-edit tx-13"></i></a>
                                        <a href="<?php echo base_url()."facilities/index/".$row->id; ?>" class="btn-default btn-sm text-warning" title="County Stores" ><i class="fa fa-hospital tx-13"></i></a>
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

