<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_accounts extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('users/auth');
		$this->load->helper('form_helper');
		$this->auth->restrict();

		$this->load->model('user_accounts_model');
	}
	
	public function index()
	{
		$this->auth->restrict('Planner.User_accounts.View_users');
		$user = $this->current_user->id;

        Template::set('roles', $this->user_accounts_model->get_user_roles());
        Template::set('users', $this->user_accounts_model
            ->join('roles', 'users.role_id = roles.role_id', 'INNER')
            ->where(array('users.role_id >' => 6,'users.role_id <' => 30))
            ->select('users.*,role_name')
            ->order_by('users.display_name')
            ->find_all());
		Template::set_theme('default');
		Template::set('page_title', 'User Accounts');
		Template::render('');
	}
	public function new_user()
    {
        $this->auth->restrict('Planner.User_accounts.Create_users');
        if($this->input->post("register")){
            $username=$this->input->post("username");
            $fullnames=$this->input->post("display_name");
            $email=$this->input->post("email");
            $phone=$this->input->post("phone");
            if($this->input->post("role")){
                $role = $this->input->post("role");
            }else{
                $role=7;
            }
            //check if username has been used
            $username_check = $this->user_accounts_model->find_by("username",$username);
            $email_check = $this->user_accounts_model->find_by("email",$email);
            if($this->user_accounts_model->find_by("username",$username)){
                Template::set_message('The user was not created. The username <b>".$username."</b> is already in use.', 'alert alert-solid-danger');
            }elseif($this->user_accounts_model->find_by("email",$email)){
                Template::set_message('The user was not created. The email <b>".$email."</b> is already in use.', 'alert alert-solid-danger');
            }else{
                //generate a random 8 character password for the user
                //$random_pass= mt_rand(100000,999999);
                $random_pass= substr(md5(uniqid(mt_rand(), true)), 0, 8);
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
                    'force_password_reset' => 1,
                    'active' => 1,

                    );
                $user_id = $this->user_accounts_model->insert($data);
                if($user_id){
                    //send the user an email notification for the account
                    $this->load->library('emailer/emailer');
                    $data = array(
                        'to'      => $_POST['email'],
                        'subject' => 'Congratulations. Your Account has been Created',
                        'message' => 'Congratulations. An account has been created for you on the TRT Planner System.<br>
                                        You can log in with the following credentials. <br> Username: '.$_POST['username'].'<br>Password: '.$random_pass.'<br> This is a one time password ensure you change it once you login.<br> Link: '.base_url().'',
                    );
                    $this->emailer->send($data);
                    // Log the Activity
                    log_activity($this->auth->user_id(),"Created new user id:".$user_id.", username: ".$this->input->post('username'), 'user_accounts');
                    Template::set_message('The user account for <b>'.$this->input->post('username').'</b> was succesfully created. An email has been sent to <b>'.$this->input->post('email').'</b> with account details and password.', 'alert alert-solid-success');
                }else{
                    Template::set_message('Error Saving!! The was a problem creating the new user. Please check the details submitted.', 'alert alert-solid-danger');
                }

                //send the user an email
//					header('Content-type: application/json');
//					//$user = $this->notifications_model->get_transport_order_detail($orderId);
//					$name = @trim(stripslashes("Vision EMR - JPHuruma"));
//					$email = @trim(stripslashes("Account Notification"));
//					$subject = @trim(stripslashes("Account Succesfully Created"));
//					$message = @trim(stripslashes("A user account has been created for you at the Vision EMR - JPHuruma hospital with the following credentials.\n\n Username: ".$username." \n Password: ".$random_pass." \n You can now be able to order for services with your account and you will receive notifications on your order status through this email.\n For clarifications or assitance please reply to this email." ));
//					$email_from = 'info@microvision.co.ke';
//					$email_to = $this->input->post('email');
//					$body = 'Name: ' . $name . "\n\n" . 'Email: ' . $email . "\n\n" . 'Subject: ' . $subject . "\n\n" . 'Message: ' . $message;
//					$success = @mail($email_to, $subject, $body, 'From: <'.$email_from.'>');
                redirect("user_accounts/index");
            }
        }
        redirect("user_accounts/index");
    }
	public function change_password()
    {

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
                    log_activity($this->auth->user_id(),"Changed password for: User id ".$id, 'user_accounts');
                    Template::set_message('The user password was successfully changed.', 'alert alert-solid-success');
                    redirect('user_accounts/index',true);
                }
            }else{
                Template::set_message('Sorry the password was not changed.The passwords submitted did not match.', 'alert alert-solid-danger');
                redirect('user_accounts/index',true);
            }
        }else{
            $id = $this->input->get("ch2");
            $details = $this->user_accounts_model->as_object()->find($id);
            $security_name = $this->security->get_csrf_token_name();
                $security_code = $this->security->get_csrf_hash();
                $url = base_url()."user_accounts/change_password";
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
	public function edit_password()
    {

        if($this->input->post("submit")){
            $id=$this->input->post("userId");
            $password = $this->input->post("password");
            $repeat_password = $this->input->post("repeat_password");
            if($password == $repeat_password){
                $password= $this->auth->hash_password($password);
                $data['password_hash']=$password['hash'];
                if ($this->user_accounts_model->update($id, $data))
                {
                    Template::set_message('Your login password was successfully changed.', 'alert alert-solid-success');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
                Template::set_message('Sorry the password was not changed.The passwords submitted did not match.', 'alert alert-solid-danger');
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            $id = $this->input->get("ch2");
            $details = $this->user_accounts_model->as_object()->find($id);
            $security_name = $this->security->get_csrf_token_name();
                $security_code = $this->security->get_csrf_hash();
                $url = base_url()."user_accounts/edit_password";
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
        redirect($_SERVER['HTTP_REFERER']);
    }
	public function edit_user()
    {

        if($this->input->post("submit")){
            $id=$this->input->post("userId");
            //check for email
            if($this->user_accounts_model->where(array("id != " => $id))->find_by("email",$this->input->post('email'))){
                Template::set_message("The changes requested could not be effected. The email <b>".$this->input->post('email')."</b> is already in use by another user.", 'alert alert-solid-danger');
                redirect('user_accounts/index', true);
            }else {
                $data = array(
                    'display_name' => $this->input->post('fullnames'),
                    'email' => $this->input->post('email'),
                    'role_id' => $this->input->post('role'),
                    'phone' => $this->input->post('phone')
                );
                if ($this->user_accounts_model->update($id, $data)) {
                    // Log the Activity
                    log_activity($this->auth->user_id(), "Changed password user details for id: " . $id . " User: " . $this->input->post('fullnames'), 'user_accounts');
                    Template::set_message('The user details were successfully edited.', 'alert alert-solid-success');
                    redirect('user_accounts/index', true);
                } else {
                    Template::set_message('Error Saving!! A problem was encountered editing user details. Please check the values submitted.', 'alert alert-solid-danger');
                    redirect('user_accounts/index', true);
                }
            }

        }else{

        $id = $this->input->get("ch2");
        $details = $this->user_accounts_model->as_object()
                ->join('roles', 'users.role_id = roles.role_id', 'LEFT')
                ->select('users.*,role_name')
                ->find($id);
        $roles = $this->user_accounts_model->get_user_roles();


        $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            $url = base_url()."user_accounts/edit_user";
            echo <<<eod
            <div class="modal-dialog modal-lg">
                <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h3>Edit User Infomation</h3>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                </button>						
                </div>
                <div class="modal-body">
                
                <form class="form-horizontal" method="post" action="$url" role="form">
                    <div class="block">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <label class="form-label mg-b-0 pull-right" for="username">Full Names</label>
                            </div>
                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                <input id="fullnames" required="required" name="fullnames" value="$details->display_name" type="text" class="form-control" />
                                <input type="hidden" name="userId" value="$id">								
                                <input type="hidden" name="$security_name" value="$security_code" >
                            </div>
                        </div><!-- End .form-group  -->
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <label class="form-label mg-b-0 pull-right" for="email">Email Address</label>
                            </div>
                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                <input class="form-control" required="required" value="$details->email" id="email" name="email" type="email" />
                            </div>
                        </div><!-- End .form-group  -->
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-2"></div>
                            <div class="col-md-2">
                                <label class="form-label mg-b-0 pull-right" for="phone">Phone Contact</label>
                            </div>
                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                <input id="phoneMask" type="text" class="form-control" value="$details->phone" placeholder="Enter your phone number" name="phone" >
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
eod;
                                        foreach($roles as $role){
                                            if($role->role_id==$details->role_id){$s="selected";}else{$s="";};
                                            echo "<option ".$s." value=\"".$role->role_id."\">".$role->role_name."</option>";
                                        }
            echo <<<eod
                                    </select>
                                </div>
                        </div>	
                        					
                    <div class="modal-footer">						
                        <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <button type="submit" name="submit" value="submit" class="btn btn-primary"> <span class="icon16 icomoon-icon-pencil-3 white"></span> Save Changes</button>							
                    </div>
                    </form>
                </div>
                </div>
            </div>
eod;
        }
    }
	public function edit_profile()
    {
        if($this->input->post("submit")){
            $id=$this->input->post("userId");
            //we check if the new email is in use by another user
            if($this->user_accounts_model->where(array("id != " => $id))->find_by("email",$this->input->post('email'))){
                Template::set_message("The changes requested could not be effected. The email <b>".$this->input->post('email')."</b> is already in use by another user.", 'alert alert-solid-danger');
                redirect($_SERVER['HTTP_REFERER']);
            }else {
                $data = array(
                    'display_name' => $this->input->post('fullnames'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone')
                );
                if ($this->user_accounts_model->update($id, $data)) {
                    // Log the Activity
                    log_activity($this->auth->user_id(), "Updated own user account details ", 'user_accounts');
                    Template::set_message('The user details were successfully updated.', 'alert alert-solid-success');
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    Template::set_message('Error Saving!! A problem was encountered editing user details. Please check the values submitted.', 'alert alert-solid-danger');
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
        }else{

        $id = $this->input->get("ch2");
        $details = $this->user_accounts_model->as_object()->find($id);
        //$departments = $this->user_accounts_model->get_departments();
        $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            $url = base_url()."user_accounts/edit_profile";
            echo <<<eod
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
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
                                        <input id="phone" name="phone" required="required" type="number" value="$details->phone" class="form-control" />									
                                </div>
                            </div>
                            
                        <div class="modal-footer">
                            <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <button type="submit" name="submit" value="submit" class="btn btn-primary"> <span class="icon16 icomoon-icon-pencil-3 white"></span> Save Changes</button>								
                        </div>
                        </form>
                    </div>
                </div>
            </div>
eod;
        }
    }
	public function disable_user()
    {
        $this->auth->restrict('Planner.User_accounts.Deactivate_users');
        if($this->input->post("submit")){
            $id=$this->input->post("userId");
            $details = $this->user_accounts_model->as_object()->find($id);
            //echo $this->input->post('todo');exit;
            $data = array(
                'banned' => $this->input->post('todo')
                );
            if ($this->user_accounts_model->update($id, $data))
            {
                //notify user via email on account deactivation
                $this->load->library('emailer/emailer');
                $data = array(
                    'to'      => $details->email,
                    'subject' => 'Account Deactivation!',
                    'message' => 'Notice! Your account on the TRT Planner System has been disabled! You will no longer be able to access the commodity system<br>
                                        <br> If this has been done in error please contact your county pharmacists for reactivation of your account',
                );
                $this->emailer->send($data);
                // Log the Activity
                log_activity($this->auth->user_id(),"Banned user account for ".$details->username." ID:".$details->id, 'user_accounts');
                Template::set_message('The user account status was succesfully changed.', 'alert alert-solid-success');
                redirect('user_accounts/index',true);
            }else{
                Template::set_message('A problem was encountered changing the user account. Please try again.', 'alert alert-solid-danger');
                redirect('user_accounts/index',true);
            }
        }else{
            $user_id = $this->input->get("ch2");
            $details = $this->user_accounts_model->as_object()->find($user_id);
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            $url = base_url()."user_accounts/disable_user";
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
            <div class="modal-dialog ">
                <div class="modal-content tx-size-sm">
                    <form class="form-horizontal" method="post" action="$url">
                    <div class="modal-body tx-center pd-y-20 pd-x-20">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-bullhorn tx-100 tx-warning lh-1 mg-t-20 d-inline-block"></i>
                        <h4 class="tx-warning mg-b-20">Confirm User $header Action!</h4>
                        <p class="mg-b-20 mg-x-20">Are you sure you want to <b> $header </b><br>the user <b> $details->display_name </b> ?</p>
                        $form
                        <input type="hidden" name="userId" value="$details->id">								
                        <input type="hidden" name="$security_name" value="$security_code" >
                        <button type="submit" name="submit" value="submit" class="btn btn-warning pd-x-25">$header User</button>
                    </div><!-- modal-body -->
                    </form>
                </div><!-- modal-content -->
            </div><!-- modal-content -->

eod;
        }
    }
    public function activate_user()
    {
        $this->auth->restrict('Planner.User_accounts.Deactivate_users');
        if($this->input->post("submit")){
            $id=$this->input->post("userId");
            $details = $this->user_accounts_model->as_object()->find($id);
            //echo $this->input->post('todo');exit;
            $data = array(
                'active' => 1
                );
            if ($this->user_accounts_model->update($id, $data))
            {
                //send activation email to user
                $this->load->library('emailer/emailer');
                $data = array(
                    'to'      => $details->email,
                    'subject' => 'Congratulations. Your account is now active!',
                    'message' => 'Congratulations. The account you created on the TRT Planner System is now registered and active!<br>
                                        <br> Link: '.base_url().'login',
                );
                $this->emailer->send($data);
                // Log the Activity
                log_activity($this->auth->user_id(),"Activated user account the User ".$details->username." ID:".$details->id, 'user_accounts');
                Template::set_message('The user account status was succesfully activated.', 'alert alert-solid-success');
                redirect('user_accounts/index',true);
            }else{
                Template::set_message('A problem was encountered activating the user account. Please try again.', 'alert alert-solid-danger');
                redirect('user_accounts/index',true);
            }
        }else{
            $user_id = $this->input->get("ch2");
            $details = $this->user_accounts_model->as_object()->find($user_id);
            $security_name = $this->security->get_csrf_token_name();
            $security_code = $this->security->get_csrf_hash();
            $url = base_url()."user_accounts/activate_user";

            echo <<<eod
            <div class="modal-dialog ">
                <div class="modal-content tx-size-sm">
                    <form class="form-horizontal" method="post" action="$url">
                    <div class="modal-body tx-center pd-y-20 pd-x-20">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <i class="fa fa-user-check tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                        <h4 class="tx-success mg-b-20">Confirm Account Activation!</h4>
                        <p class="mg-b-20 mg-x-20">Are you sure you want to activate <br>the user <b> $details->display_name </b> ?</p>
                        <input type="hidden" name="userId" value="$details->id">								
                        <input type="hidden" name="$security_name" value="$security_code" >
                        <button type="submit" name="submit" value="submit" class="btn btn-success pd-x-25">Activate Account</button>
                    </div><!-- modal-body -->
                    </form>
                </div><!-- modal-content -->
            </div><!-- modal-content -->

eod;
        }
    }
    public function profile(){
        Template::set('user_details', $this->user_accounts_model->as_object()
                                ->join('roles', 'users.role_id = roles.role_id', 'LEFT')
                                ->select('users.*,role_name')
                                ->find_by('users.id',$this->current_user->id));
        Template::set('activity', $this->user_accounts_model->get_user_activities($this->current_user->id));
        Template::set('activity_month_count', $this->user_accounts_model->get_user_activities_month_count($this->current_user->id));
        Template::set('activity_module_count', $this->user_accounts_model->get_user_activities_module_count($this->current_user->id));
        Template::set('activity_count', $this->user_accounts_model->get_user_activities_count($this->current_user->id));
        Template::set_theme('default');
        Template::set('page_title', 'My Profile');
        Template::render('');
    }

}