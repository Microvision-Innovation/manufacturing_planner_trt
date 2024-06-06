<!-- Main Content -->
    <div class="container-fluid">
		<div class="side-body">
			<div class="page-title">
						<?php echo Template::message(); ?>
                        <span class="title">Manage Positions</span>
                        <div class="description">Manage Employees Positions.</div>
                    </div>
			<div class="row">
				<div class="col-xs-12">
					<div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">Positions Table</div>
                            </div>
                        </div>
                        <div class="card-body">
							
							
							
							
								<div class="row">
										<div class="col-md-4 col-xs-12">
												
												<div class="x_panel">
															<div class="x_title">
																
																<div class="clearfix"></div>
															</div>
															<div class="x_content">
																<br>
																<form class="form-horizontal form-label-left input_mask" method="post" id="position" action="<?php echo base_url();?>setting/positions">
																	<div class="form-group col-md-12 col-xs-12">
																		<label>Position Name</label>
                                                                        <span class="text-danger"><?php echo form_error('name'); ?></span>
                                                                        <input type="text" class="form-control" name="name" required="required" placeholder="Enter position name..">
																			<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" > 																		
																	</div>
                                                                    <div class="form-group  col-md-12 col-xs-12"">
                                                                        <label>Management Cadre?</label>

                                                                        <select name="is_management_cadre" class="form-control" title="Is this position within the management cadre" required="">
                                                                            <option value="1">Yes</option>
                                                                            <option value="0">No</option>
                                                                        </select>

                                                                    </div>
																	
																	<div class="form-group">
																		<div class="col-md-3 col-sm-3 col-xs-12 col-md-offset-5">                                                
																			<button type="submit" name="submit" value="submit" class="btn btn-info">Add New Position</button>
																		</div>
																	</div>

																</form>
															</div>
														</div>
												
										</div>
										<div class="col-md-8 col-xs-12">
											<div class="" role="tabpanel" data-example-id="togglable-tabs">
												<ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
													<li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Active Positions</a>
													</li>
													<li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Disabled Positions</a>
													</li>
												</ul>
											<div id="myTabContent" class="tab-content">
												<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
															   <table class="table table-hover">
																	<thead>
																		<tr>
																			<th>#</th>
																			<th>Position Name</th>	 
																			<th>Is Management Cadre</th>
																			<th>Status</th>
																			<th>Actions</th>                                                
																		</tr>
																	</thead>
																	<tbody>
																	<?php $num=0; if(isset($positions) && is_array($positions)): foreach($positions as $row): if($row->status==1): $num++;?>
																		<tr>
																			<th scope="row"><?php echo $num; ?></th>
																			<td><?php echo $row->name; ?></td>
																			<td><?php echo ($row->is_management_cadre==1)?'Yes':'No'; ?></td>
																			<td><h6><span class="label label-success">Active</span></h6></td>
																			<td>
																				<div class="btn-group  btn-group-xs">
																					<a href="#txtResult2" class="btn btn-dark" data-toggle="modal"  title="Edit Position" type="button" onclick="htmlData2('<?php echo base_url();?>setting/edit_position', 'ch2=<?php echo $row->id;?>')"><i class="fa fa-edit"></i></a>
																					<a href="#txtResult2" class="btn btn-dark" data-toggle="modal"  title="Disable" type="button" onclick="htmlData2('<?php echo base_url();?>setting/disable_position', 'ch2=<?php echo $row->id;?>')"><i class="fa fa-trash"></i></a>
																				</div>
																			</td>
																		</tr>
																	<?php endif; endforeach;endif ;?>
																													
																		
																	</tbody>
																</table>
												</div>
												<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
																<table class="table table-hover">
																	<thead>
																		<tr>
																			<th>#</th>
																			<th>Position Name</th>
																			<th>Status</th>
																			<th>Actions</th>                                                
																		</tr>
																	</thead>
																	<tbody>
																	<?php $num=0;if(isset($positions) && is_array($positions)):  foreach($positions as $row): if($row->status==0): $num++;?>
																		<tr>
																			<td scope="row"><?php echo $num; ?></td>
																			<td><?php echo $row->name; ?></td>
																			<td><h6><span class="label label-default">In-Active</span></h6></td>
																			<td>
																				<div class="btn-group  btn-group-xs">																					
																					<a href="#txtResult2" class="btn btn-danger" data-toggle="modal"  title="Activate" type="button" onclick="htmlData2('<?php echo base_url();?>setting/enable_position', 'ch2=<?php echo $row->id;?>')"><i class="fa fa-unlock"></i></a>
																				</div>
																			</td>
																		</tr>
																	<?php endif; endforeach;endif; ?>
																													
																		
																	</tbody>
																</table>
												</div>
											</div>
										</div>
									</div>
								</div>    
		
							
							
							
							
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>