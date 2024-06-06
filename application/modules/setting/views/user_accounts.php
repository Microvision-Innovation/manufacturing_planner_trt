<!-- Main Content -->
    <div class="container-fluid">
		<div class="side-body">
			<div class="page-title">
						<?php echo Template::message(); ?>
                        <span class="title">User Management</span>
                        <div class="description">Manage accounts for users who work with the payroll.</div>
                    </div>
			<div class="row">
				<div class="col-xs-12">
					<div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">Accounts</div>
                            </div>
                        </div>
                        <div class="card-body">
							<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target=".new_user">Create New user</button>						
							<div role="tabpanel" data-example-id="togglable-tabs">
                                        <ul id="myTab1" class="nav nav-tabs" role="tablist">
											<li role="presentation" class="active"><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Active Users</a>
                                            </li>
                                            <li role="presentation" class=""><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Inactive Users</a>
                                            </li>
                                        </ul>
                                        <div id="myTabContent2" class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade" id="tab_content11" aria-labelledby="home-tab">
                                                <p><table class="table table-hover">
														<thead>
															<tr>
																<th>#</th>
																<th>User Name</th>
																<th>Full Names</th>
																<th>Email</th>
																<th>Role</th>
																<th>Last Login</th>												
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															
															<?php $num=0; foreach($users as $row): if($row->banned==1): $num++;?>
															<tr>
																<th scope="row"><?php echo $num; ?></th>
																<td><?php echo $row->username; ?></td>
																<td><?php echo $row->display_name; ?></td>
																<td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
																<td><?php echo $row->role_name; ?></td>
																<td><?php echo $row->last_login; ?></td>
																<td>
																	<div class="btn-group  btn-group-xs">
																		
																		<?php if($row->banned==0): ?>
																		<a href="#txtResult" data-toggle="modal" title="Deactivate User" class="btn btn-dark" onclick="htmlData('<?php echo base_url();?>setting/disable_user', 'ch2=<?php echo $row->id?>&ch=disable')"><i class="fa fa-lock"></i></a>
																		<?php else: ?>
																		<a href="#txtResult" data-toggle="modal" title="Activate User" class="btn btn-dark" onclick="htmlData('<?php echo base_url();?>setting/disable_user', 'ch2=<?php echo $row->id?>&ch=enable')"><i class="fa fa-unlock"></i></a>
																		<?php endif;?>
																	</div>
																</td>
															</tr>
															
															<?php endif; endforeach; ?>															
														</tbody>
													</table>
												</p>
                                            
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade active in" id="tab_content22" aria-labelledby="profile-tab">
                                                <p><table class="table table-hover">
														<thead>
															<tr>
																<th>#</th>
																<th>User Name</th>
																<th>Full Names</th>
																<th>Email</th>
																<th>Role</th>
																<th>Last Login</th>												
																<th>Actions</th>
															</tr>
														</thead>
														<tbody>
															
															<?php $num=0; foreach($users as $row): if($row->banned==0): $num++;?>
															<tr>
																<th scope="row"><?php echo $num; ?></th>
																<td><?php echo $row->username; ?></td>
																<td><?php echo $row->display_name; ?></td>
																<td><a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a></td>
																<td><?php echo $row->role_name; ?></td>
																<td><?php echo $row->last_login; ?></td>
																<td>
																	<div class="btn-group  btn-group-xs">
																		<a href="#txtResult" data-toggle="modal"  title="Change Password" class="btn btn-primary" onclick="htmlData('<?php echo base_url();?>setting/change_password', 'ch2=<?php echo $row->id?>&ch=Maintenace Order')"><i class="fa fa-shield"></i></a>
																		<a href="#txtResult" data-toggle="modal" title="Edit User info" class="btn btn-primary" onclick="htmlData('<?php echo base_url();?>setting/edit_user', 'ch2=<?php echo $row->id?>&ch=Maintenace Order')"><i class="fa fa-edit"></i></a>
																		<?php if($row->banned==0): ?>
																		<a href="#txtResult" data-toggle="modal" title="Deactivate User" class="btn btn-primary" onclick="htmlData('<?php echo base_url();?>setting/disable_user', 'ch2=<?php echo $row->id?>&ch=disable')"><i class="fa fa-lock"></i></a>
																		<?php else: ?>
																		<a href="#txtResult" data-toggle="modal" title="Activate User" class="btn btn-primary" onclick="htmlData('<?php echo base_url();?>setting/disable_user', 'ch2=<?php echo $row->id?>&ch=enable')"><i class="fa fa-unlock"></i></a>
																		<?php endif;?>
																	</div>
																</td>
															</tr>
															
															<?php endif; endforeach; ?>															
														</tbody>
													</table>
												</p>
                                            </div>
                                            
                                        </div>
                                    </div>
								</div>
							</div>
						</div>
					</div>
	</div>
                            
							
								<div class="modal fade new_user" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
										<form method="post" id="wizard" class="form-horizontal" role="form" action="<?php echo base_url(); ?>setting/new_user" accept-charset="utf-8" autocomplete="off">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                                                </button>
                                                <h4 class="modal-title" id="myModalLabel">New User Account</h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                                
											<div class="wizard-steps clearfix"></div>
											<div class="step" id="account-details"><br>
												<div class="form-group">
													<label class="col-lg-3 control-label" for="username">User Name:</label>
													<div class="col-lg-6">
														<input id="username" name="username" required="required" type="text" class="form-control col-md-7 col-xs-12" />
													</div>
												</div><!-- End .form-group  -->
												<div class="form-group">
													<label class="col-lg-3 control-label" for="username">Full Names:</label>
													<div class="col-lg-6">
														<input id="display_name" required="required" name="display_name" type="text" class="form-control col-md-7 col-xs-12" />
													</div>
												</div><!-- End .form-group  -->
												
											</div>
											<div class="step" id="contact-details">
												<span class="step-info" data-num="3" data-text="Contact details"></span>
												<div class="form-group">
													<label class="col-lg-3 control-label" for="email">email:</label>
													<div class="col-lg-6">
														<input class="form-control" required="required" id="email" name="email" type="email" />
													</div>
												</div><!-- End .form-group  -->
												<div class="form-group">
													<label class="col-lg-3 control-label" for="phone">Phone:</label>
													<div class="col-lg-6">
														<input class="form-control" required="required" id="phone" name="phone"  type="number" step="0.01"  />
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
												
													<div class="form-group">
														<label class="col-lg-3 control-label" for="role">User Level:</label>
														<div class="col-lg-6">
															<select name="role" required="required" id="role" class="form-control">
																<option selected="selected" value="">Select User level</option>
																<option value="8">Payroll Master</option>
																<option value="9">Payroll Clerk</option>
																<option value="11">Credit Controller</option>
															</select>
														</div>
													</div><!-- End .form-group  -->
												
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" name="register"  class="btn btn-primary" value="Register New User">
                                            </div>
										</form>
                                        </div>
                                    </div>
                                </div>					