<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_sync_model extends MY_Model {
	protected $table_name = 'tabwork order';

    public function scheduled_jobs()
    {
        // Load the other database
        $other_db = $this->load->database('erp', TRUE);
        return $other_db->query("SELECT * FROM `tabWork Order` WHERE creation >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND status NOT IN ('Cancelled','Closed','Completed') ORDER BY `tabWork Order`.creation")->result();
//        return $other_db->query("SELECT * FROM `tabWork Order` WHERE creation >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)")->result();
//        return $other_db->query("SELECT * FROM `tabwork order`")->result();
    }
    public function get_scheduled_jobs($start_date, $end_date)
    {
        // Load the other database
        $other_db = $this->load->database('erp', TRUE);
        return $other_db->query("SELECT * FROM `tabWork Order` 
									WHERE  status NOT IN ('Cancelled','Closed','Completed') AND creation BETWEEN '".$start_date."' AND '".$end_date."' 
									ORDER BY `tabWork Order`.creation")->result();
    }
	
}