<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Send_emails extends Front_Controller
{
	
	public function __construct()
	{
		parent::__construct();
        $this->load->library('emailer/emailer');
	}

    public function index(){
	    //delete emails queue older than 10 months
        $this->db->query("DELETE FROM email_queue WHERE date_sent < DATE_SUB(NOW(),INTERVAL 10 MONTH)");
        //Disable activity logs older than 1 year
//        $this->db->query("UPDATE activities SET deleted=1 WHERE created_on < DATE_SUB(NOW(),INTERVAL 12 MONTH)");
        //delete activity logs older than 15 months
//        $this->db->query("DELETE FROM activities WHERE created_on < DATE_SUB(NOW(),INTERVAL 15 MONTH)");

        $this->emailer->enable_debug(true);
        // Use ob to catch output designed for CRON only
        ob_start();
        $success = $this->emailer->process_queue();
        ob_end_clean();

        if (! $success) {
            //Template::set('email_debug', $this->emailer->debug_message);
            echo $this->emailer->debug_message;
        }else{
            echo "All emails sent";
        }
    }
}