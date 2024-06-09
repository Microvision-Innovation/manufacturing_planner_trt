<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Messaging extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('users/auth');
		$this->load->helper('form_helper');
		$this->auth->restrict();
        Assets::add_module_css('line-awesome/css/line-awesome.min.css');
        Assets::add_module_css('quill/quill.snow.css');
        Assets::add_module_css('quill/quill.bubble.css');
        //Assets::add_module_js('billables', 'jquery.dataTables.min');
		$this->load->model('messaging_model');
		$this->load->model('notifications_model');
		$this->load->model('emails_model');
	}
	
	public function index($email_status = -1)
	{

	    if($email_status!=-1 or $email_status==0){
            Template::set('emails', $this->messaging_model
                ->join("users", "tbl_emails.created_by=users.id", "LEFT")
                ->select("tbl_emails.*,display_name")
                ->where(array("tbl_emails.status" => $email_status))
                ->order_by("tbl_emails.id","DESC")
                ->limit(10)
                ->find_all());
        }else{
            Template::set('emails', $this->messaging_model
                ->join("users", "tbl_emails.created_by=users.id", "LEFT")
                ->select("tbl_emails.*,display_name")
                ->where(array("tbl_emails.status !=" => 2))
                ->order_by("tbl_emails.id","DESC")
                ->limit(10)
                ->find_all());
        }

        Template::set('email_status', $email_status);
        Template::set('draft_mails', $this->messaging_model->get_email_count(0));
        Template::set('sent_mails', $this->messaging_model->get_email_count(1));
        Template::set('deleted_mails', $this->messaging_model->get_email_count(2));
        Template::set('national', $this->messaging_model->get_user_count(9));
        Template::set('county', $this->messaging_model->get_user_count(8));
        Template::set('subcounty', $this->messaging_model->get_user_count(7));
	    Template::set_theme('default');
		Template::set('page_title', 'Messaging');
		Template::render('');
	}
    public function notifications(){
	    if(ISSET($_POST['submit'])){
            $notification_details1= $this->notifications_model->as_object()->find(1);
            if($notification_details1->notification != $_POST['message1'] or $notification_details1->title != $_POST['subject1']){
                $data = array(
                    'title' => $_POST['subject1'],
                    'notification' => $_POST['message1']
                );
                $this->notifications_model->update($_POST['id1'],$data);
            }
            $notification_details2= $this->notifications_model->as_object()->find(2);
            if($notification_details2->notification != $_POST['message2'] or $notification_details2->title != $_POST['subject2']){
                $data = array(
                    'title' => $_POST['subject2'],
                    'notification' => $_POST['message2']
                );
                $this->notifications_model->update($_POST['id2'],$data);
            }
            //log system activity
            log_activity($this->auth->user_id(), 'Updated Dashboard Notifications', 'Messaging');
            Template::set_message('The dashboard notifications were successfully updated', 'alert alert-solid-success');
            redirect('messaging/notifications',true);
        }
        Template::set('notification_details1', $this->notifications_model->as_object()->find(1));
        Template::set('notification_details2', $this->notifications_model->as_object()->find(2));
        Template::set('draft_mails', $this->messaging_model->get_email_count(0));
        Template::set('sent_mails', $this->messaging_model->get_email_count(1));
        Template::set('deleted_mails', $this->messaging_model->get_email_count(2));
        Template::set('national', $this->messaging_model->get_user_count(9));
        Template::set('county', $this->messaging_model->get_user_count(8));
        Template::set('subcounty', $this->messaging_model->get_user_count(7));
        Template::set_theme('default');
        Template::set('page_title', 'Notifications');
        Template::render('');
    }
    public function compose($id=null)
    {
        if($id){
            Template::set('mail_details', $this->messaging_model->as_object()->find($id));
        }
        Template::set('draft_mails', $this->messaging_model->get_email_count(0));
        Template::set('sent_mails', $this->messaging_model->get_email_count(1));
        Template::set('deleted_mails', $this->messaging_model->get_email_count(2));
        Template::set('user_levels', $this->messaging_model->get_user_levels());
        Template::set('national', $this->messaging_model->get_user_count(9));
        Template::set('county', $this->messaging_model->get_user_count(8));
        Template::set('subcounty', $this->messaging_model->get_user_count(7));
        Template::set('regions', $this->messaging_model->get_regions());
        Template::set('counties', $this->messaging_model->get_counties());
        Template::set_theme('default');
        Template::set('page_title', 'Compose');
        Template::render('');
    }
    public function filter_mail_recipients(){
	    $user_levels = $_GET['user_levels'];
	    $regions_selected = $_GET['regions'];
	    $counties_selected = $_GET['counties'];

	    $users  =($user_levels !="null")?"and users.role_id IN (".$user_levels.")":"";
	    $regions  =($regions_selected !="null")?"and tbl_regions.id IN (".$regions_selected.")":"";
	    $counties  =($counties_selected !="null")?"and tbl_county.id IN (".$counties_selected.")":"";
        $data['recipients']  = $this->messaging_model->get_email_recipients($users,$regions,$counties);
        $data['recipient_count']  = $this->messaging_model->get_email_recipients_count($users,$regions,$counties);
	    $this->load->view('messaging/mail_recipients',$data);
    }

    public function send_mail(){
//        echo $_POST['quillEditor'];
//
//        exit;

        //Check email action and save email by status
        if($_POST['submit']=='save'){$status=0;}elseif($_POST['submit']=='discard'){$status=2;}else{$status=1;}
        $data = array(
            'subject' => $_POST['subject'],
            'message' => $_POST['message'],
            'status' => $status
        );
        $this->messaging_model->insert($data);
        //check if email status is send and send emails
        if($_POST['submit']=='Send Emails'){
            $recipients = $_POST['recipients'];
            if($recipients){
                //$this->load->library('emailer/emailer');
                foreach($recipients as $r){
                    $data = array(
                        'to_email' => $r,
                        'subject' => $_POST['subject'],
                        'message' => $_POST['message'],
                        'max_attempts' => 3,
                        'attempts' => 0,
                        'success' => 0
                    );
                    //$this->emailer->send($data);
                    $this->emails_model->insert($data);
                }
                //log system activity
                log_activity($this->auth->user_id(), "Sent email broadcast: " . $_POST['subject'], 'Messaging');
                Template::set_message('The email was successfully sent to all recipients', 'alert alert-solid-success');
            }
        }


        redirect('messaging',true);
    }
}