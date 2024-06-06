<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Setting extends Front_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
        $this->auth->restrict();
		$this->load->library('users/auth');
		$this->load->helper('form_helper');
		
		$this->load->model('company_model');		
		$this->load->model('user_accounts_model');
		$this->load->model('departments_model');
		$this->load->model('divisions_model');
		$this->load->model('pay_periods_model');
		$this->load->model('banks_model');
		$this->load->model('suppliers_model');
		$this->load->model('csv_model');
		$this->load->model('position_model');

	}
	
	public function index()
	{
		
		$this->auth->restrict('Vision.setting.View');
		Template::set_theme('default');
		Template::set('page_title', 'Clients');
		Template::render('');
	}
	public function new_user(){
			$this->auth->restrict('Vision.setting.View');
			if($this->input->post("register")){
				$username=$this->input->post("username");
				$fullnames=$this->input->post("display_name");
				$email=$this->input->post("email");
				$phone=$this->input->post("phone");
				
				if($this->input->post("role")){
					$role = $this->input->post("role");
				}else{
					$role=8;
				}	
				//check if username has been used
				$username_check = $this->user_accounts_model->find_by("username",$username);
				$email_check = $this->user_accounts_model->find_by("email",$email);
				if($this->user_accounts_model->find_by("username",$username)){
					Template::set_message('The user was not succesfully created. The username is already in use.', 'alert fresh-color alert-danger');
				}elseif($this->user_accounts_model->find_by("email",$email)){
					Template::set_message('The user was not succesfully created. The email is already in use.', 'alert fresh-color alert-danger');
				}else{
					//generate a random pasword for the user
					$random_pass= mt_rand(100000,999999);
					$password= $this->auth->hash_password($random_pass);

					$data = array(
						'username'=> $this->input->post('username'),
						'password_hash'=> $password['hash'],
						'display_name'=> $this->input->post('display_name'),
						'email'=> $this->input->post('email'),
						'phone'=> $this->input->post('phone'),
						'role_id'=> $role,
						'language'		=> $this->input->post('language'),
						'timezone'		=> $this->input->post('timezones'),
						'password_iterations' => 2,
						
						);
					if($this->user_accounts_model->insert($data)){
                        //send the user an email notification for the account
                        $this->load->library('emailer/emailer');
                        $data = array(
                            'to'      => $_POST['email'],
                            'subject' => 'Congratulations. Your Account has been Created',
                            'message' => 'Congratulations. An account has been created for you on the TRT Manufacturing Planner.<br>
                                        You can log in with the following credentials. <br> Username: '.$_POST['username'].'<br>Password: '.$random_pass.'<br> This is a one time password ensure you change it once you login.<br> Link: '.base_url().'',
                        );
                        $this->emailer->send($data);
					    // Log the Activity
						log_activity($this->auth->user_id(),"Created new user: ".$this->input->post('display_name'), 'vision_setting');
						Template::set_message('The user account for <b>'.$this->input->post('username').'</b> was succesfully created. An email has been sent to <b>'.$this->input->post('email').'</b> with account details and password.', 'alert fresh-color alert-success');
					}else{
						Template::set_message('Error Saving!! The was a problem creating the new user. Please check the details submitted.', 'alert fresh-color alert-danger');
					}
					redirect("setting/user_accounts");
				}
			}
			
			$this->auth->restrict('Vision.setting.User_Manage');
			Template::set_theme('default');
			Template::set('page_title', 'New User ');
			Template::render('');
		}
	public function user_accounts(){
		$this->auth->restrict('Vision.setting.View');
		$user = $this->current_user->id;
		Template::set('users', $this->user_accounts_model->get_users_details());
		$this->auth->restrict('Vision.setting.User_Manage');
		Template::set_theme('default');
		Template::set('page_title', 'User Accounts');
		Template::render('');
	}
	public function change_password(){
			
			if($this->input->post("submit")){
				$id=$this->input->post("userId");
				$password = $this->input->post("password");
				$repeat_password = $this->input->post("repeat_password");
				if($password == $repeat_password){
					$password= $this->auth->hash_password($password);
					$data['password_hash']=$password['hash'];
					if ($this->user_accounts_model->update($id, $data))
					{
						// Log the Activity
						log_activity($this->auth->user_id(),"Changed password for: User id ".$id, 'vision_setting');
						Template::set_message('The user password was successfully changed.', 'alert fresh-color alert-success');
						redirect('setting/user_accounts',true);
					}
				}else{
					Template::set_message('Sorry the password was not changed.The passwords submitted did not match.', 'alert fresh-color alert-danger');
					redirect('setting/user_accounts',true);
				}
			}else{
				$id = $this->input->get("ch2");			
				$details = $this->user_accounts_model->as_object()->find($id);
				$security_name = $this->security->get_csrf_token_name();
					$security_code = $this->security->get_csrf_hash();
					$url = base_url()."setting/change_password";
					echo <<<eod
					<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
							<h3>Change Password</h3>
						</div>
						<div class="modal-body">
						<h4 align="center">Change the password for user <u> $details->display_name </u></h4>
						<form class="form-horizontal" method="post" action="$url" role="form">
							<div class="row">
								<div class="form-group">
									<label class="col-lg-5 control-label" for="username">New Password:</label>
										<div class="col-lg-3">
											<input id="password" name="password" required="required" type="password" data-validate-length="6,8" class="form-control" />							
										<input type="hidden" name="userId" value="$id">								
										<input type="hidden" name="$security_name" value="$security_code" > 
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-5 control-label" for="username">Confirm Password:</label>
										<div class="col-lg-3">
											<input id="repeat_password" name="repeat_password" data-validate-linked="password" required="required" type="password"  class="form-control" />							
										
									</div>
								</div>
							
							<div class="modal-footer">						
								<button type="submit" name="submit" value="submit" class="btn btn-primary"> <span class="icon16 icomoon-icon-vcard white"></span> Change Password</button>
								<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
							</div>
							</form>
						</div>
					</div>
					</div>
eod;
			}
		}
	public function edit_password(){
			
			if($this->input->post("submit")){
				$id=$this->input->post("userId");
				$password = $this->input->post("password");
				$repeat_password = $this->input->post("repeat_password");
				if($password == $repeat_password){
					$password= $this->auth->hash_password($password);
					$data['password_hash']=$password['hash'];
					if ($this->user_accounts_model->update($id, $data))
					{
						Template::set_message('The user password was successfully changed.', 'success');
						redirect('',true);
					}
				}else{
					Template::set_message('Sorry the password was not changed.The passwords submitted did not match.', 'error');
					redirect('',true);
				}
			}else{
				$id = $this->input->get("ch2");			
				$details = $this->user_accounts_model->as_object()->find($id);
				$security_name = $this->security->get_csrf_token_name();
					$security_code = $this->security->get_csrf_hash();
					$url = base_url()."setting/edit_password";
					echo <<<eod
					<div class="modal-dialog modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
								<h3>Change Your Password</h3>
							</div>
							<div class="modal-body">
							<h4 align="center">Change the password for  <u> $details->display_name </u></h4>
							<form class="form-horizontal" method="post" action="$url" role="form">
								<div class="row">
									<div class="form-group">
										<label class="col-lg-5 control-label" for="username">New Password:</label>
											<div class="col-lg-3">
												<input id="password" name="password" required="required" type="password"  class="form-control" />							
											<input type="hidden" name="userId" value="$id">								
											<input type="hidden" name="$security_name" value="$security_code" > 
										</div>
									</div>
									<div class="form-group">
										<label class="col-lg-5 control-label" for="username">Confirm Password:</label>
											<div class="col-lg-3">
												<input id="repeat_password" name="repeat_password" required="required" type="password"  class="form-control" />							
											
										</div>
									</div>
								
								<div class="modal-footer">						
									<button type="submit" name="submit" value="submit" class="btn btn-danger"> <span class="icon16 icomoon-icon-vcard white"></span> Change Password</button>
									<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
								</div>
								</form>
							</div>
						</div>
					</div>
eod;
			}
		}
	public function edit_user(){
			
			if($this->input->post("submit")){
				$id=$this->input->post("userId");
				$data = array(
					'display_name'=> $this->input->post('fullnames'),
					'email'=> $this->input->post('email'),
					'phone'=> $this->input->post('phone')
					);
				if ($this->user_accounts_model->update($id, $data))
				{
					// Log the Activity
					log_activity($this->auth->user_id(),"Changed password user details for: User id ".$this->input->post('fullnames'), 'vision_setting');
					Template::set_message('The user details were successfully edited.', 'alert fresh-color alert-success');
					redirect('setting/user_accounts',true);
				}else{
					Template::set_message('Error Saving!! A problem was encountered editing user details. Please check the values submitted.', 'alert fresh-color alert-danger');
					redirect('setting/user_accounts',true);
				}
					
			}else{
			
			$id = $this->input->get("ch2");
			$details = $this->user_accounts_model->get_user_details($id);
			$security_name = $this->security->get_csrf_token_name();
				$security_code = $this->security->get_csrf_hash();
				$url = base_url()."setting/edit_user";
				echo <<<eod
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
						<h3>Edit User Infomation</h3>
					</div>
					<div class="modal-body">
					
					<form class="form-horizontal" method="post" action="$url" role="form">
						<div class="row">
							<div class="form-group">
								<label class="col-lg-5 control-label" for="fullnames">Full Names</label>
									<div class="col-lg-3">
										<input id="fullnames" name="fullnames" required="required" type="text" value="$details->display_name" class="form-control" />							
									<input type="hidden" name="userId" value="$id">								
									<input type="hidden" name="$security_name" value="$security_code" > 
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-5 control-label" for="email">email</label>
									<div class="col-lg-3">
										<input id="email" name="email" required="required" type="email" value="$details->email" class="form-control" />							
									
								</div>
							</div>
							<div class="form-group">
								<label class="col-lg-5 control-label" for="phone">Phone Contact</label>
									<div class="col-lg-3">
										<input id="phone" name="phone" required="required"  type="number" step="0.01"  value="$details->phone" class="form-control" />									
								</div>
							</div>
													
						<div class="modal-footer">						
							<button type="submit" name="submit" value="submit" class="btn btn-primary"> <span class="icon16 icomoon-icon-pencil-3 white"></span> Save Changes</button>
							<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
						</div>
						</form>
					</div>
				</div>
eod;
			}
		}
	public function edit_profile(){
			if($this->input->post("submit")){
				$id=$this->input->post("userId");
				$data = array(
					'display_name'=> $this->input->post('fullnames'),
					'email'=> $this->input->post('email'),
					'phone'=> $this->input->post('phone')					
					);
				if ($this->user_accounts_model->update($id, $data))
				{
					// Log the Activity
					log_activity($this->auth->user_id(),"Changed password user details for: User id ".$this->input->post('fullnames'), 'vision_setting');
					Template::set_message('The user details were successfully edited.', 'alert fresh-color alert-success');
					redirect('',true);
				}else{
					Template::set_message('Error Saving!! A problem was encountered editing user details. Please check the values submitted.', 'alert fresh-color alert-danger');
					redirect('',true);
				}
			}else{
			
			$id = $this->input->get("ch2");
			$details = $this->user_accounts_model->get_user_details($id);;
			//$departments = $this->user_accounts_model->get_departments();
			$security_name = $this->security->get_csrf_token_name();
				$security_code = $this->security->get_csrf_hash();
				$url = base_url()."setting/edit_profile";
				echo <<<eod
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
							<h3>Edit Your Profile</h3>
						</div>
						<div class="modal-body">
						
						<form class="form-horizontal" method="post" action="$url" role="form">
							<div class="row">
								<div class="form-group">
									<label class="col-lg-5 control-label" for="fullnames">Full Names</label>
										<div class="col-lg-3">
											<input id="fullnames" name="fullnames" required="required" type="text" value="$details->display_name" class="form-control" />							
										<input type="hidden" name="userId" value="$id">								
										<input type="hidden" name="$security_name" value="$security_code" > 
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-5 control-label" for="email">email</label>
										<div class="col-lg-3">
											<input id="email" name="email" required="required" type="email" value="$details->email" class="form-control" />							
										
									</div>
								</div>
								<div class="form-group">
									<label class="col-lg-5 control-label" for="phone">Phone Contact</label>
										<div class="col-lg-3">
											<input id="phone" name="phone" required="required"  type="number" step="0.01"  value="$details->phone" class="form-control" />									
									</div>
								</div>
								
							<div class="modal-footer">						
								<button type="submit" name="submit" value="submit" class="btn btn-primary"> <span class="icon16 icomoon-icon-pencil-3 white"></span> Save Changes</button>
								<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
							</div>
							</form>
						</div>
					</div>
				</div>
eod;
			}
		}
	public function disable_user(){
			if($this->input->post("submit")){
				$id=$this->input->post("userId");
				//echo $this->input->post('todo');exit;
				$data = array(
					'banned' => $this->input->post('todo')					
					);
				if ($this->user_accounts_model->update($id, $data))
				{
					// Log the Activity
					log_activity($this->auth->user_id(),"Banned user account for: User id ".$this->input->post('fullnames'), 'vision_setting');
					Template::set_message('The user account status was succesfully changed.', 'alert fresh-color alert-success');					
					redirect('setting/user_accounts',true);
				}else{
					Template::set_message('A problem was encountered changing the user account. Please try again.', 'alert fresh-color alert-danger');					
					redirect('setting/user_accounts',true);
				}
			}else{
				$user_id = $this->input->get("ch2");
				$details = $this->user_accounts_model->as_object()->find($user_id);
				$security_name = $this->security->get_csrf_token_name();
				$security_code = $this->security->get_csrf_hash();
				$url = base_url()."setting/disable_user";
				if($this->input->get("ch")=="disable"){
					$header="Disable";
					$content="Note: When you disable a user they cannot be able to login or make any transactions. Their previous transactions remain in records though.";
					$form="<input type=\"hidden\" name=\"todo\" value=\"1\">";
				}elseif($this->input->get("ch")=="enable"){
					$header="Activate";
					$content="Note: Activating a user allows them to log in and make transactions. Previous records are still kept for reporting";
					$form="<input type=\"hidden\" name=\"todo\" value=\"0\">";
				}
				echo <<<eod
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
							<h3>$header User</h3>
						</div>
						<div class="modal-body">
						<form class="form-horizontal" method="post" action="$url" role="form">
							<div class="row">
								<h3 align="center">Are you sure you want to <u> $header </u>the user <u> $details->display_name </u></h3>
								<h5 align="center">$content</h5>
								<div class="form-group">							
								<div class="col-lg-3">	
									$form;
									<input type="hidden" name="userId" value="$details->id">								
									<input type="hidden" name="$security_name" value="$security_code" > 
								</div>
							</div>
							</div>
							<div class="modal-footer">						
								<button type="submit" name="submit" value="submit" class="btn btn-danger"> <span class="icon16 icomoon-icon-users-2 white"></span> $header User</button>
								<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
							</div>
							</form>
						</div>
					</div>
				</div>
eod;
			}
		}	
	public function company_details()
	{
		if(ISSET($_POST['submit'])){
			$data = array(
				'company_name'=> $_POST['company_name'],
				'company_no'=> $_POST['company_number'],		
				'kra_pin'=> $_POST['kra_pin'],
				'address'=> $_POST['address'],
				'town'=> $_POST['town'],
				'phone'=> $_POST['phone'],
				'email'=> $_POST['email']
			);
			if($this->company_model->update(1,$data))
			{
				// Log the Activity
				log_activity($this->auth->user_id(),"Changed company details", 'vision_setting');
				Template::set_message('The company details were succesfully updated.', 'alert fresh-color alert-success');
			}else{
				Template::set_message('Error Saving!! The was a problem updating company details. Please check the values submitted.', 'alert fresh-color alert-danger');
			}
			redirect('setting/company_details',true);
		}			
		$this->auth->restrict('Vision.Setting.Company_view');		
		Template::set('company_details', $this->company_model->as_object()->find(1));
		Template::set('page_title', 'Company Details');
		Template::set_theme('default');
		Template::render('');
	}
	public function departments()
	{
		if(ISSET($_POST['submit'])){
			$data = array(
				'department'=> $_POST['department'],
				'division_id'=> $_POST['division'],
				'status'=> 1
			);
			if($this->departments_model->insert($data))
			{
				// Log the Activity
				log_activity($this->auth->user_id(),"Created new department", 'vision_setting');
				Template::set_message('The new department was succesfully created.', 'alert fresh-color alert-success');
			}else{
				Template::set_message('Error Saving!! The department was not created. Please check the department name', 'alert fresh-color alert-danger');
			}
			redirect('setting/departments',true);
		}			
		$this->auth->restrict('Vision.Setting.Department_Manage');		
		Template::set('departments', $this->departments_model
                                                ->join('bf_vision_divisions d','d.id=division_id','LEFT')
                                                ->select('bf_vision_departments.*,d.division')
                                                ->order_by('department','asc')
												->find_all());
        Template::set('divisions', $this->divisions_model->where(array("status" => 1))->order_by('division','asc')->find_all());
		Template::set('page_title', 'Company Departments');
		Template::set_theme('default');
		Template::render('');
	}
	public function edit_department()
	{
		if(isset($_POST['submit'])){
			$department = $_POST['department'];
			$division = $_POST['division'];
			$id = $_POST['department_id'];
			//update the stage
			$data = array('department'=> $department,'division_id'=> $division);
			$this->departments_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Edited department", 'vision_setting');
			Template::set_message('The department was successfully updated', 'alert fresh-color alert-success');
			redirect("setting/departments");
		}else{
			$department_edit = $this->departments_model->as_object()
                                                        ->join('bf_vision_divisions d','d.id=division_id','LEFT')
                                                        ->select('bf_vision_departments.*,d.division')
                                                        ->find_by('bf_vision_departments.id',$this->input->get('ch2'));
            $divisions=$this->divisions_model->where(array("status" => 1))->order_by('division','asc')->find_all();
			$url=base_url()."setting/edit_department";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Edit $department_edit->department</h4>
												</div>
												<div class="modal-body">
													
													<p>
													<div class="form-group">
														<label >Select Division</label>
															<select class="form-control" required name="division">
															    <option value="">Select Division</option>
eod;
			                                                    foreach($divisions as $d){ echo '<option value="'.$d->id.'">'.$d->division.'</option>'; }
            echo <<<eod
                                                            </select>
													</div>
													<div class="form-group">
														<label >Department Name</label>
															<input type="text" class="form-control" name="department" required="required" placeholder="Enter stage.." value="$department_edit->department">
															<input type="hidden" name="department_id" value="$department_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function disable_department()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['department_id'];
			//update the stage
			$data = array('status'=> 0);
			$this->departments_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Disabled department", 'vision_setting');
			Template::set_message('The department was successfully disabled', 'alert fresh-color alert-success');
			redirect("setting/departments");
		}else{
			$department_edit = $this->departments_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/disable_department";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Disable $department_edit->department</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Delete!! </h4>
													
													<p>Are you Sure you want to disable the department <b>$department_edit->department</b></p>
													<div class="form-group">															
															<input type="hidden" name="department_id" value="$department_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-danger" name="submit" value="Disable Department">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function enable_department()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['department_id'];
			//update the department
			$data = array('status'=> 1);
			$this->departments_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Enabled department", 'vision_setting');
			Template::set_message('The department was successfully activated', 'alert fresh-color alert-success');
			redirect("setting/departments");
		}else{
			$department_edit = $this->departments_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/enable_department";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Activate $department_edit->department</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Activation </h4>
													
													<p>Are you Sure you want to activate the department <b>$department_edit->department</b></p>
													<div class="form-group">															
															<input type="hidden" name="department_id" value="$department_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Activate Department">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
    public function divisions()
    {
        if(ISSET($_POST['submit'])){
            $data = array(
                'division'=> $_POST['division'],
                'status'=> 1
            );
            if($this->divisions_model->insert($data))
            {
                // Log the Activity
                log_activity($this->auth->user_id(),"Created new divisions", 'vision_setting');
                Template::set_message('The new division was successfully created.', 'alert fresh-color alert-success');
            }else{
                Template::set_message('Error Saving!! The division was not created. Please check the division name', 'alert fresh-color alert-danger');
            }
            redirect('setting/divisions',true);
        }
        $this->auth->restrict('Vision.Setting.Division_Manage');
        Template::set('divisions', $this->divisions_model->order_by('division','asc')
            ->find_all());
        Template::set('page_title', 'Company Divisions');
        Template::set_theme('default');
        Template::render('');
    }
    public function edit_division()
    {
        if(isset($_POST['submit'])){
            $division = $_POST['division'];
            $id = $_POST['division_id'];
            //update the stage
            $data = array('division'=> $division);
            $this->divisions_model->update($id,$data);
            // Log the Activity
            log_activity($this->auth->user_id(),"Edited division", 'vision_setting');
            Template::set_message('The division was successfully updated', 'alert fresh-color alert-success');
            redirect("setting/divisions");
        }else{
            $division_edit = $this->divisions_model->as_object()->find_by('id',$this->input->get('ch2'));
            $url=base_url()."setting/edit_division";
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Edit $division_edit->division</h4>
												</div>
												<div class="modal-body">
													
													<p>
													<div class="form-group">
														<label >Campus Name</label>
															<input type="text" class="form-control" name="division" required="required" placeholder="Enter campus name.." value="$division_edit->division">
															<input type="hidden" name="division_id" value="$division_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
        }
    }
    public function disable_division()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['division_id'];
            //update the stage
            $data = array('status'=> 0);
            $this->divisions_model->update($id,$data);
            // Log the Activity
            log_activity($this->auth->user_id(),"Disabled division", 'vision_setting');
            Template::set_message('The division was successfully disabled', 'alert fresh-color alert-success');
            redirect("setting/divisions");
        }else{
            $division_edit = $this->divisions_model->as_object()->find_by('id',$this->input->get('ch2'));
            $url=base_url()."setting/disable_division";
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Disable $division_edit->division</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Delete!! </h4>
													
													<p>Are you Sure you want to disable the campus <b>$division_edit->division</b></p>
													<div class="form-group">															
															<input type="hidden" name="division_id" value="$division_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-danger" name="submit" value="Disable Campus">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
        }
    }
    public function enable_division()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['division_id'];
            //update the division
            $data = array('status'=> 1);
            $this->divisions_model->update($id,$data);
            // Log the Activity
            log_activity($this->auth->user_id(),"Enabled division", 'vision_setting');
            Template::set_message('The division was successfully activated', 'alert fresh-color alert-success');
            redirect("setting/divisions");
        }else{
            $division_edit = $this->divisions_model->as_object()->find_by('id',$this->input->get('ch2'));
            $url=base_url()."setting/enable_division";
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Activate $division_edit->division</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Activation </h4>
													
													<p>Are you Sure you want to activate the campus <b>$division_edit->division</b></p>
													<div class="form-group">															
															<input type="hidden" name="division_id" value="$division_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Activate Campus">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
        }
    }
	public function pay_periods()
	{
		if(ISSET($_POST['submit'])){
			$data = array(
				'description'=> $_POST['description'],
				'no_payday'=> $_POST['no_payday'],
				'status'=> 1				
			);
			if($this->pay_periods_model->insert($data))
			{
				// Log the Activity
				log_activity($this->auth->user_id(),"Created new pay periods", 'vision_setting');
				Template::set_message('The new payment period was succesfully created.', 'alert fresh-color alert-success');
			}else{
				Template::set_message('Error Saving!! The payment period was not created. Please check the values submitted', 'alert fresh-color alert-danger');
			}
			redirect('setting/pay_periods',true);
		}			
		$this->auth->restrict('Vision.Setting.Pay_periods');		
		Template::set('pay_periods', $this->pay_periods_model->order_by('no_payday','desc')
																			->find_all());
		Template::set('page_title', 'Payment Periods');
		Template::set_theme('default');
		Template::render('');
	}
	public function edit_pay_period()
	{
		if(isset($_POST['submit'])){
			$description = $_POST['description'];
			$no_payday = $_POST['no_payday'];
			$id = $_POST['period_id'];
			//update the stage
			$data = array('description'=> $description,'no_payday'=> $no_payday);
			$this->pay_periods_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Edited payment period ", 'vision_setting');
			Template::set_message('The payment period was successfully updated', 'alert fresh-color alert-success');
			redirect("setting/pay_periods");
		}else{
			$pay_period = $this->pay_periods_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/edit_pay_period";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Edit <b>$pay_period->description</b> payment period</h4>
												</div>
												<div class="modal-body">													
													<p>
													<div class="form-group">
														<label >Payment Period</label>
															<input type="text" class="form-control" name="description" required="required" placeholder="Name of payment period.." value="$pay_period->description">
															<input type="hidden" name="period_id" value="$pay_period->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													<div class="form-group">
														<label>Number of Pay days</label>																		
														<input  type="number" step="0.01"  class="form-control" name="no_payday" required="required" placeholder="Payment frequency in a year.." value="$pay_period->no_payday">																			
													</div>
													</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function disable_pay_period()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['period_id'];
			//update the stage
			$data = array('status'=> 0);
			$this->pay_periods_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Disabled payment period", 'vision_setting');
			Template::set_message('The payment period successfully disabled', 'alert fresh-color alert-success');
			redirect("setting/pay_periods");
		}else{
			$pay_period = $this->pay_periods_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/disable_pay_period";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Disable <b>$pay_period->description</b></h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Delete!! </h4>
													
													<p>Are you Sure you want to delete the payment period <b>$pay_period->description</b></p>
													<div class="form-group">															
															<input type="hidden" name="period_id" value="$pay_period->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-danger" name="submit" value="Disable Payment Period">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function enable_pay_period()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['period_id'];
			//update the department
			$data = array('status'=> 1);
			$this->pay_periods_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Enabled payment period", 'vision_setting');
			Template::set_message('The payment period was successfully activated', 'alert fresh-color alert-success');
			redirect("setting/pay_periods");
		}else{
			$pay_period = $this->pay_periods_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/enable_pay_period";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Activate $pay_period->description</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Activation </h4>
													
													<p>Are you Sure you want to activate the payment period <b>$pay_period->description</b></p>
													<div class="form-group">															
															<input type="hidden" name="period_id" value="$pay_period->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Activate Payment Period">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function banks()
	{
		if(ISSET($_POST['submit'])){
            $this->form_validation->set_rules('bank_name', 'Bank Name','required|is_unique[bf_vision_banks.bank_name]');
            $this->form_validation->set_rules('bank_code', 'Bank Code','required|is_unique[bf_vision_banks.bank_code]');
			if($this->form_validation->run()!=FALSE) {

                $data = array(
                    'bank_name' => $_POST['bank_name'],
                    'bank_code' => $_POST['bank_code'],
                    'status' => 1
                );
                if ($this->banks_model->insert($data)) {
                    // Log the Activity
                    log_activity($this->auth->user_id(), "Created new bank", 'vision_setting');
                    Template::set_message('The new bank was succesfully created.', 'alert fresh-color alert-success');
                } else {
                    Template::set_message('Error Saving!! The bank was not created. Please check the bank name', 'alert fresh-color alert-danger');
                }
                redirect('setting/banks', true);
            }
		}			
		$this->auth->restrict('Vision.Setting.Banks_Manage');		
		Template::set('banks', $this->banks_model->order_by('bank_name','asc')
																			->find_all());
		Template::set('page_title', 'Employee Payment Banks');
		Template::set_theme('default');
		Template::render('');
	}
	public function edit_bank()
	{
		if(isset($_POST['submit'])){
			$bank_name = $_POST['bank_name'];
			$bank_code = $_POST['bank_code'];
			$id = $_POST['bank_id'];
			//update the stage
			$data = array('bank_name'=> $bank_name,"bank_code"=>$bank_code);
			$this->banks_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Edited bank", 'vision_setting');
			Template::set_message('The bank was successfully updated', 'alert fresh-color alert-success');
			redirect("setting/banks");
		}else{
			$bank_edit = $this->banks_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/edit_bank";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Edit $bank_edit->bank_name</h4>
												</div>
												<div class="modal-body">
													
													<p>
													<div class="form-group">
														<label >Bank Name</label>
															<input type="text" class="form-control" name="bank_name" required="required" placeholder="Enter Bank Name.." value="$bank_edit->bank_name">
															<input type="hidden" name="bank_id" value="$bank_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													</p>
														<div class="form-group">
														<label >Bank Code</label>
															<input type="text" class="form-control" name="bank_code" required="required" placeholder="Enter Bank Code.." value="$bank_edit->bank_code">
															 
														 
													</div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function disable_bank()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['bank_id'];
			//update the stage
			$data = array('status'=> 0);
			$this->banks_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Disabled bank", 'vision_setting');
			Template::set_message('The bank was successfully disabled', 'alert fresh-color alert-success');
			redirect("setting/banks");
		}else{
			$bank_edit = $this->banks_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/disable_bank";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Disable $bank_edit->bank_name</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Delete!! </h4>
													
													<p>Are you Sure you want to disable the bank <b>$bank_edit->bank_name</b></p>
													<div class="form-group">															
															<input type="hidden" name="bank_id" value="$bank_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-danger" name="submit" value="Delete Bank">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function enable_bank()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['bank_id'];
			//update the bank
			$data = array('status'=> 1);
			$this->banks_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Enabled bank", 'vision_setting');
			Template::set_message('The bank was successfully activated', 'alert fresh-color alert-success');
			redirect("setting/banks");
		}else{
			$bank_edit = $this->banks_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/enable_bank";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Activate $bank_edit->bank_name</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Activation </h4>
													
													<p>Are you Sure you want to activate the bank <b>$bank_edit->bank_name</b></p>
													<div class="form-group">															
															<input type="hidden" name="bank_id" value="$bank_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Activate Bank">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
    public function positions()
    {
        if(ISSET($_POST['submit'])){
            $this->form_validation->set_rules('name', 'Position Name','required|is_unique[bf_vision_positions.name]');
            if($this->form_validation->run()!=FALSE) {

                $data = array(
                    'name' => $_POST['name'],
                    'is_management_cadre' => $_POST['is_management_cadre'],
                    'status' => 1
                );
                if ($this->position_model->insert($data)) {
                    // Log the Activity
                    log_activity($this->auth->user_id(), "Created new Position", 'vision_setting');
                    Template::set_message('The new position was succesfully created.', 'alert fresh-color alert-success');
                } else {
                    Template::set_message('Error Saving!! The position was not created. Please check the positiona name', 'alert fresh-color alert-danger');
                }
                redirect('setting/positions', true);
            }
        }
        $this->auth->restrict('Vision.Setting.Banks_Manage');
        Template::set('positions', $this->position_model->order_by('name','asc')
            ->find_all());
        Template::set('page_title', 'Employee Payment Banks');
        Template::set_theme('default');
        Template::render('');
    }
    public function edit_position()
    {
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $is_management_cadre = $_POST['is_management_cadre'];
            $id = $_POST['position_id'];
            //update the stage
            $data = array('name'=> $name,'is_management_cadre'=>$is_management_cadre);
            $this->position_model->update($id,$data);
            // Log the Activity
            log_activity($this->auth->user_id(),"Edited Position", 'vision_setting');
            Template::set_message('The Position was successfully updated', 'alert fresh-color alert-success');
            redirect("setting/positions");
        }else{
            $position_edit = $this->position_model->as_object()->find_by('id',$this->input->get('ch2'));
            $url=base_url()."setting/edit_position";
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Edit $position_edit->name</h4>
												</div>
												<div class="modal-body">
													
													<p>
													<div class="form-group">
														<label >Position Name</label>
															<input type="text" class="form-control" name="name" required="required" placeholder="Enter Position Name.." value="$position_edit->name">
															<input type="hidden" name="position_id" value="$position_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													</p>
													   <div class="form-group  col-md-12 col-xs-12"">
                                                                        <label>Management Cadre?</label>

                                                                        <select name="is_management_cadre" class="form-control" title="Is this position within the management cadre" required="">
                                                                            <option  value="1">Yes</option>
                                                                            <option value="0">No</option>
                                                                        </select>

                                                                    </div>
																		 
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
        }
    }
    public function disable_position()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['position_id'];
            //update the stage
            $data = array('status'=> 0);
            $this->position_model->update($id,$data);
            // Log the Activity
            log_activity($this->auth->user_id(),"Disabled position", 'vision_setting');
            Template::set_message('The position was successfully disabled', 'alert fresh-color alert-success');
            redirect("setting/positions");
        }else{
            $position_edit = $this->position_model->as_object()->find_by('id',$this->input->get('ch2'));
            $url=base_url()."setting/disable_position";
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Disable $position_edit->name</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Disable!! </h4>
													
													<p>Are you Sure you want to disable the bank <b>$position_edit->name</b></p>
													<div class="form-group">															
															<input type="hidden" name="position_id" value="$position_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-danger" name="submit" value="Disable Position">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
        }
    }
    public function enable_position()
    {
        if(isset($_POST['submit'])){
            $id = $_POST['position_id'];
            $data = array('status'=> 1);
            $this->position_model->update($id,$data);
            // Log the Activity
            log_activity($this->auth->user_id(),"Enabled Position", 'vision_setting');
            Template::set_message('The position was successfully activated', 'alert fresh-color alert-success');
            redirect("setting/positions");
        }else{
            $position_edit = $this->position_model->as_object()->find_by('id',$this->input->get('ch2'));
            $url=base_url()."setting/enable_position";
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Activate $position_edit->name</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Activation </h4>
													
													<p>Are you Sure you want to activate the position <b>$position_edit->name</b></p>
													<div class="form-group">															
															<input type="hidden" name="position_id" value="$position_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Activate Position">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
        }
    }
    public function csv_uploads()
	{
		
		Template::set('csv_files', $this->csv_model->get_all_csv());
		Template::set('page_title', 'Uploaded CSV Files');
		Template::set_theme('default');
		Template::render('');
	}
	public function delete_csv()
	{
		if(isset($_POST['submit'])){
			$upload_date = $_POST['uploaddate'];
			//delete deduction data
			$this->csv_model->delete_deductions($upload_date);
			//delete uploaded data
			$this->csv_model->delete_uploads($upload_date);
			// Log the Activity
			log_activity($this->auth->user_id(),"Deleted CSV File Content Dated:".$upload_date, 'Setting');
			Template::set_message('The CSV content uploaded on <b>'.$upload_date.'</b> was succesfully deleted', 'alert fresh-color alert-success');
			redirect("setting/csv_uploads");
		}else{
			$uploaddate = $this->input->get('ch2');
			$url=base_url()."setting/delete_csv";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			
			echo <<<eod
									<div class="modal-dialog modal-lg">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Delete CSV Upload Data</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Delete!! </h4>
													
													<p>Are you sure you want to delete this CSV File and all its associated data that was uploaded? </p>
													<div class="form-group">															
															<input type="hidden" name="uploaddate" value="$uploaddate">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-danger" name="submit" value="Delete CSV Content">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	
	}
	public function database_backup(){
		$db_name = 'vision_weberp_jphuruma-'. date("Y-m-d-H-i-s") .'.gz';
		// Load the DB utility class
		$this->load->dbutil();
		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup();
		// Load the file helper and write the file to your server
			//$this->load->helper('file');
			//write_file(FCPATH.'/downloads/'.$db_name, $backup);
		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download($db_name, $backup);		
	}
	public function suppliers()
	{
		if(ISSET($_POST['submit'])){
			$data = array(
				'supplier_name'=> $_POST['supplier_name'],
				'contact'=> $_POST['contact'],
				'status'=> 1				
			);
			if($this->suppliers_model->insert($data))
			{
				// Log the Activity
				log_activity($this->auth->user_id(),"Created new SUpplier", 'vision_setting');
				Template::set_message('The new supplier was succesfully created.', 'alert fresh-color alert-success');
			}else{
				Template::set_message('Error Saving!! The Supplier was not created. Please check the Supplier name or Contact', 'alert fresh-color alert-danger');
			}
			redirect('setting/suppliers',true);
		}			
		$this->auth->restrict('Vision.Setting.Banks_Manage');		
		Template::set('suppliers', $this->suppliers_model->order_by('supplier_name','asc')
																			->find_all());
		Template::set('page_title', 'Manage Suppliers');
		Template::set_theme('default');
		Template::render('');
	}
	public function edit_supplier()
	{
		if(isset($_POST['submit'])){
			$supplier_name = $_POST['supplier_name'];
			$id = $_POST['supplier_id'];
			//update the stage
			$data = array('supplier_name'=> $supplier_name,'contact'=> $_POST['contact']);
			$this->suppliers_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Edited Supplier", 'vision_setting');
			Template::set_message('The Supplier was successfully updated', 'alert fresh-color alert-success');
			redirect("setting/suppliers");
		}else{
			$supplier_edit = $this->suppliers_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/edit_supplier";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Edit $supplier_edit->supplier_name</h4>
												</div>
												<div class="modal-body">
													
													<p>
													<div class="form-group">
														<label >Supplier</label>
															<input type="text" class="form-control" name="supplier_name" required="required" placeholder="Suppliers Name.." value="$supplier_edit->supplier_name">
															<input type="hidden" name="supplier_id" value="$supplier_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													<div class="form-group">
														<label >Contact</label>
															<input type="text" class="form-control" name="contact" required="required" placeholder="Suppliers Contact.." value="$supplier_edit->contact">
															
													</div>
													</p>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Save Changes">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function disable_supplier()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['supplier_id'];
			//update the stage
			$data = array('status'=> 0);
			$this->suppliers_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Disabled Supplier", 'vision_setting');
			Template::set_message('The Supplier was successfully disabled', 'alert fresh-color alert-success');
			redirect("setting/suppliers");
		}else{
			$supplier_edit = $this->suppliers_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/disable_supplier";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Disable $supplier_edit->supplier_name</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Delete!! </h4>
													
													<p>Are you Sure you want to disable the supplier <b>$supplier_edit->supplier_name</b></p>
													<div class="form-group">															
															<input type="hidden" name="supplier_id" value="$supplier_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-danger" name="submit" value="Delete Supplier">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	public function enable_supplier()
	{
		if(isset($_POST['submit'])){
			$id = $_POST['supplier_id'];
			//update the supplier
			$data = array('status'=> 1);
			$this->suppliers_model->update($id,$data);
			// Log the Activity
			log_activity($this->auth->user_id(),"Enabled Supplier", 'vision_setting');
			Template::set_message('The supplier was successfully activated', 'alert fresh-color alert-success');
			redirect("setting/suppliers");
		}else{
			$supplier_edit = $this->suppliers_model->as_object()->find_by('id',$this->input->get('ch2'));
			$url=base_url()."setting/enable_supplier";
			$security_name = $this->security->get_csrf_token_name();
			$security_code = $this->security->get_csrf_hash();
			echo <<<eod
									<div class="modal-dialog modal-sm">
                                        <div class="modal-content">
											<form action="$url" method="post" >
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
													</button>
													<h4 class="modal-title" id="myModalLabel2">Activate $supplier_edit->supplier_name</h4>
												</div>
												<div class="modal-body">
													<h4>Confirm Activation </h4>
													
													<p>Are you Sure you want to activate the supplier <b>$supplier_edit->supplier_name</b></p>
													<div class="form-group">															
															<input type="hidden" name="supplier_id" value="$supplier_edit->id">
															<input type="hidden" name="$security_name" value="$security_code" > 
													</div>
													
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
													<input type="submit" class="btn btn-primary" name="submit" value="Activate Supplier">
												</div>
											</form>
                                        </div>
                                    </div>
                                
eod;
		}
	}
	
}