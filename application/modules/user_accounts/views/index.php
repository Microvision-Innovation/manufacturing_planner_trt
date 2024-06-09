
<div class="container">
    <div class="az-content-body">
        <div class="az-content-breadcrumb">
            <span>Home</span>
            <span>User Accounts</span>
        </div>
        <h2 class="az-content-title tx-24 mg-b-5">User Accounts</h2>
        <p class="mg-b-20">Manage user accounts and access to the planner.</p>
        <div class="row">
            <div class="col-lg-12">
                <button type="button" class="modal-effect btn btn-primary pull-right" data-toggle="modal" data-target=".new_user"><i class="fa fa-user-plus"></i> Create New user</button>
            </div>
        </div>
        <?php if(ISSET($users) and $users): ?>
        <div class="card card-table-two">
            <table id="datatable1" class="display responsive table table-condensed">
                <thead>
                <tr>
                    <th>#</th>
                    <th>User Name</th>
                    <th>Full Names</th>
                    <th>Contact</th>                    
                    <th>Role</th>
                    <th>Last login</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                <?php $num=0; foreach($users as $row): $num++;?>
                    <tr>
                        <td width="3%"><?php echo $num; ?></td>
                        <td>
                            <?php   echo $row->username;
                                    echo($row->banned==1)?" <span class='small text-danger'><i class='fa fa-user-alt-slash'></i>Disabled</span>":"";
                                    echo($row->active==0)?" <span class='small text-muted'><i class='fa fa-user-times'></i>Pending Approval</span>":"";
                            ?><br>
                            <span class="small text-muted">Last Login: <?php echo date('d/m/Y H:i', strtotime($row->last_login)); ?></span>
                        </td>
                        <td><?php echo ucwords(strtolower($row->display_name)); ?></td>
                        <td> <i class="fa fa-phone tx-10"></i> : <?php echo $row->phone; ?><br>
                            <i class="fa fa-envelope tx-10"></i> : <a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a>
                        </td>
                        <td><?php echo $row->role_name; ?></td>
                        <td width="11%"><?php echo date('d-M-Y h:i',strtotime($row->last_login)); ?></td>
                        <td>
                            <div class="btn-group  btn-group-xs">
<!--                                <a href="#txtResult" data-toggle="modal"  title="Change Password" class="btn btn-primary" onclick="htmlData('--><?php //echo base_url();?><!--user_accounts/change_password', 'ch2=<?php //echo $row->id?><!--&ch=Maintenace Order')"><i class="fa fa-shield"></i></a> -->

                                <?php if((has_permission('Planner.User_accounts.Edit_users')) and ($row->banned==0)): ?>
                                    <?php if((has_permission('Planner.User_accounts.Deactivate_users')) and ($row->active==0)): ?>
                                        <a href="#txtResult" data-toggle="modal" title="Activate Account" class="btn-default btn-sm text-info" onclick="htmlData('<?php echo base_url();?>user_accounts/activate_user', 'ch2=<?php echo $row->id; ?>&ch=enable')"><i class="fa fa-user-check tx-13"></i></a>
                                    <?php else: ?>
                                        <a href="#txtResult" data-toggle="modal" title="Edit User info" class="btn-default btn-sm text-primary" onclick="htmlData('<?php echo base_url();?>user_accounts/edit_user', 'ch2=<?php echo $row->id; ?>&ch=user_edit')"><i class="fa fa-edit tx-13"></i></a>
                                        <a href="#txtResult" data-toggle="modal" title="Disable User" class="btn-default btn-sm text-warning" onclick="htmlData('<?php echo base_url();?>user_accounts/disable_user', 'ch2=<?php echo $row->id; ?>&ch=disable')"><i class="fa fa-user-alt-slash tx-13"></i></a>
                                    <?php endif; ?>
                                <?php elseif((has_permission('Planner.User_accounts.Deactivate_users')) and ($row->banned==1)): ?>
                                    <a href="#txtResult" data-toggle="modal" title="Enable Account" class="btn-default btn-sm text-danger" onclick="htmlData('<?php echo base_url();?>user_accounts/disable_user', 'ch2=<?php echo $row->id; ?>&ch=enable')"><i class="fa fa-user-plus tx-13"></i></a>
                                <?php endif;?>

                            </div>
                        </td>
                    </tr>

                <?php endforeach; ?>
                </tbody>
            </table>

        </div>
        <?php else: ?>
            <h2>There are no active users found in the system. </h2>
        <?php endif; ?>
        <div class="mg-lg-b-30"></div>

    </div><!-- az-content-body -->
</div>
<div id="txtResult" class="modal hide effect-scale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> </div>
<div class="modal fade new_user effect-flip-horizontal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-content-demo">
            <form method="post" id="new_user" class="form-horizontal" role="form" action="<?php echo base_url(); ?>user_accounts/new_user" accept-charset="utf-8" autocomplete="off">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">New User Account</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="block" id="account-details">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="alert alert-outline-success" role="alert">

                                    <strong><i class="fa fa-bullhorn"></i>&nbsp;</strong> &nbsp; Once you create an accout an email will be sent to the user with their login password.
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <label class="form-label mg-b-0 pull-right" for="username">User Name</label>
                            </div>
                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                <input id="username" name="username" required="required" type="text" class="form-control" />
                            </div>
                        </div><!-- End .form-group  -->
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <label class="form-label mg-b-0 pull-right" for="username">Full Names</label>
                            </div>
                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                <input id="display_name" required="required" name="display_name" type="text" class="form-control" />
                            </div>
                        </div><!-- End .form-group  -->

                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0 pull-right" for="email">Email Address</label>
                        </div>
                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                            <input class="form-control" required="required" id="email" name="email" type="email" />
                        </div>
                    </div><!-- End .form-group  -->
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0 pull-right" for="phone">Phone Contact</label>
                        </div>
                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                            <input id="phoneMask" type="text" class="form-control" placeholder="Enter your phone number" name="phone" >
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" >
                            <!--Since we have skiped some enrollment bit we hide some of the fields and send registration to the method with default values
                            <input hidden class="span6" id="pass_confirm" name="pass_confirm" value="default">-->
                            <input hidden name="timezones" value="UP3" >
                            <input hidden name="language" value="English" >
                            <input hidden name="street_name" value="Kenya" >
                            <input hidden name="state" value="KE" >
                            <input hidden name="country" value="KE" >
                            <input hidden name="language" value="English" >

                        </div>
                    </div><!-- End .form-group  -->

                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <label class="form-label mg-b-0 pull-right" for="role">User Level</label>
                        </div>
                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                            <select name="role" required="required" id="role" class="form-control select2-no-search" style="width: 100%;">
                                <option selected disabled value="">Select User level</option>
                                <?php foreach($roles as $role):?>
                                    <option value="<?php echo $role->role_id; ?>"><?php echo $role->role_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div><!-- End .form-group  -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="register"  class="btn btn-primary" value="Create New User">
                </div>
            </form>
        </div>
    </div>
</div>


							
