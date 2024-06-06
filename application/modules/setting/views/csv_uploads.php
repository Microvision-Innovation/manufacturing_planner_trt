<!-- Main Content -->
    <div class="container-fluid">
		<div class="side-body">
			<div class="page-title">
						<?php echo Template::message(); ?>
                        <span class="title">Uploaded CSV Files</span>
                        <div class="description">Delete and Upload CSV Files from the BIO Metric Machine fro hourly Rates.</div>
                    </div>
			<div class="row">
				<div class="col-xs-12">
					<div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <div class="title">CSV File Uploads</div>
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
																<form method="post" action="<? echo base_url();?>transactions/regular_time/upload_register" enctype="multipart/form-data">
																
																			<div class="control-group <?php echo form_error('file') ? 'error' : ''; ?>">
																			To update data
																				<?php echo form_label('Upload CSV File'. lang('bf_form_label_required'), 'register_file', array('class' => 'control-label') ); ?>
																				<div class='controls'>
																					<input id='register_file' type='file' name='register_file' required="required" maxlength="100" value="<?php echo set_value('register_file', isset($market_prices['file']) ? $market_prices['file'] : ''); ?>" />
																					<span class='help-inline'><?php echo form_error('file'); ?></span>
																					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>" > 
																				</div>
																			</div>
																		<hr>
																			<button id="upload" type="submit" name="upload" value="upload" class="btn btn-primary">Upload Data</button>
																			<a href="<?php echo Template::theme_url('images/register.csv'); ?>" target="_blank" class="btn btn-default pull-right"><i class="fa fa-download"></i> Download Template</a>
																	
															</form>
															</div>
														</div>
												
										</div>
										<div class="col-md-8 col-xs-12">
											 <table class="table table-hover">
																	<thead>
																		<tr>
																			<th>#</th>
																			<th>Report Period</th>												
																			<th>Upload Date</th> 
																			<th>Actions</th>                                                
																		</tr>
																	</thead>
																	<tbody>
																	<?php $num=0; foreach($csv_files as $row):  $num++;?>
																		<tr>
																			<th scope="row"><i class="fa fa-file-excel-o"></i></th>
																			<td><?php echo date("d-M-Y", strtotime($row->start_date))." &nbsp; &nbsp;  <i class=\"fa fa-long-arrow-right\"></i>  &nbsp; &nbsp;  ".date("d-M-Y", strtotime($row->end_date)); ?></td>												
																			<td><?php echo date("d-M-Y H:m:s", strtotime($row->uploaddate));?></td>
																			<td>
																				<div class="btn-group  btn-group-xs">																																			
																					<a href="#txtResult2" class="btn btn-dark" data-toggle="modal"  title="Delete CSV File" type="button" onclick="htmlData2('<?php echo base_url();?>setting/delete_csv', 'ch2=<?php echo $row->uploaddate;?>')"><i class="fa fa-trash"></i></a>
																				</div>
																			</td>
																		</tr>
																	<?php endforeach; ?>
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