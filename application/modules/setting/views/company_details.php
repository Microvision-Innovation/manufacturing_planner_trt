<!-- Main Content -->
    <div class="container-fluid">
		<div class="side-body">
			<div class="page-title">
						<?php echo Template::message(); ?>
                        <span class="title">Company Information</span>
                        <div class="description">Edit company details as you would like them to appear in the reports.</div>
                    </div>
			<div class="row">
						<div class="col-xs-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">
                                        <div class="title"><?php echo $page_title; ?></div>
                                    </div>
                                </div>
                                <div class="card-body">
									<form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo base_url();?>setting/company_details">
										<div class="form-group">
											<label for="company_name" class="control-label col-md-4 col-sm-4 col-xs-12">Company Name<span class="required">*</span></label>
											<div class="col-md-5 col-sm-5 col-xs-12">
												<input type="text" name="company_name" placeholder="Name of company" id="company_name" required="" value="<?php echo $company_details->company_name; ?>" class="form-control col-md-8" />
												<input type="hidden" name="<?php echo $this->security->get_csrf_token_name()?>" value="<?php echo $this->security->get_csrf_hash()?>" > 
											</div>
										</div>
										<div class="form-group">
											<label for="company_number" class="control-label col-md-4 col-sm-4 col-xs-12">Official Company Number</label>
											<div class="col-md-5 col-sm-5 col-xs-12">
												<input type="text" name="company_number" placeholder="Official Company number" id="company_number" value="<?php echo $company_details->company_no; ?>" class="form-control col-md-8" />
											</div>
										</div>
										<div class="form-group">
											<label for="kra_pin" class="control-label col-md-4 col-sm-4 col-xs-12">KRA PIN Number<span class="required">*</span></label>
											<div class="col-md-5 col-sm-5 col-xs-12">
												<input type="text" name="kra_pin" placeholder="Company KRA PIN(Tax Reffence)" id="kra_pin" required="" value="<?php echo $company_details->kra_pin; ?>" class="form-control col-md-8" />
											</div>
										</div>
										<div class="form-group">
											<label for="address" class="control-label col-md-4 col-sm-4 col-xs-12">Company Address</label>
											<div class="col-md-5 col-sm-5 col-xs-12">
												<textarea name="address" id="address" class="form-control col-md-8" rows="3"><?php echo $company_details->address; ?></textarea>
											</div>
										</div>
										<div class="form-group">
											<label for="town" class="control-label col-md-4 col-sm-4 col-xs-12">Company Location<span class="required">*</span></label>
											<div class="col-md-5 col-sm-5 col-xs-12">
												<input type="text" name="town" placeholder="Physical location e.g Town/City" id="town" required="" value="<?php echo $company_details->town; ?>" class="form-control col-md-8" />
											</div>
										</div>
										<div class="form-group">
											<label for="kra_pin" class="control-label col-md-4 col-sm-4 col-xs-12">Official Phone Number<span class="required">*</span></label>
											<div class="col-md-5 col-sm-5 col-xs-12">
												<input  type="number" step="0.01"  name="phone" placeholder="Official company phone contact" id="phone" required="" value="<?php echo $company_details->phone; ?>" class="form-control col-md-8" />
											</div>
										</div>
										<div class="form-group">
											<label for="email" class="control-label col-md-4 col-sm-4 col-xs-12">Company e-mail address<span class="required">*</span></label>
											<div class="col-md-5 col-sm-5 col-xs-12">
												<input type="email" name="email" placeholder="Company official email address" id="email" required="" value="<?php echo $company_details->email; ?>" class="form-control col-md-8" />
											</div>
										</div>
										<div class="ln_solid"><hr></div>
                                        <div class="form-group">
                                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                                                <button type="cancel" class="btn btn-default">Cancel</button>
                                                <input type="submit" class="btn btn-info" name="submit" value="Save Changes">
                                            </div>
                                        </div>
									</form>
								</div>
							</div>
						</div>
			</div>
		</div>
	</div>