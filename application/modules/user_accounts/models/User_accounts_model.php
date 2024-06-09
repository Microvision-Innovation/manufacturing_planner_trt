<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_accounts_model extends MY_Model {
	protected $table_name = 'users';
    protected $key = 'id';
	protected $set_created = false;
	protected $log_user = false;
	protected $set_modified = false;
	protected $soft_deletes = true;
	protected $date_format = 'datetime';
	
	protected $created_field    = 'created_on';
	protected $created_by_field = 'created_by';
	protected $modified_field   = 'modified_on';
	protected $modified_by_field = 'modified_by';


	public function get_user_roles(){
	    return $this->db->query("SELECT * FROM bf_roles WHERE role_id>6 and deleted=0")->result();
    }
    public function get_user_activities($user_id){
        return $this->db->query("SELECT * FROM bf_activities WHERE user_id=".$user_id." and deleted=0 ORDER BY created_on DESC LIMIT 3")->result();
    }
    public function get_user_activities_month_count($user_id){
        return $this->db->query("SELECT count(*) as total,month(created_on) as months,year(created_on) as years,CONCAT_WS('-', month(created_on), year(created_on)) timeline FROM bf_activities 
                                                WHERE user_id=".$user_id." and deleted=0 and created_on >= DATE_FORMAT(CURDATE() - INTERVAL 10 MONTH,'%Y-%m-01')
                                                GROUP BY month(created_on),year(created_on) ORDER BY created_on")->result();
    }
    public function get_user_activities_module_count($user_id){
        return $this->db->query("SELECT count(*) as total,module FROM bf_activities
                                                WHERE user_id=".$user_id." and deleted=0 and created_on >= DATE_FORMAT(CURDATE() - INTERVAL 10 MONTH,'%Y-%m-01')
                                                GROUP BY module order by total desc LIMIT 5")->result();
    }
    public function get_user_activities_count($user_id){
        return $this->db->query("SELECT count(*) as total FROM bf_activities 
                                                WHERE user_id=".$user_id." and deleted=0 and created_on >= DATE_FORMAT(CURDATE() - INTERVAL 10 MONTH,'%Y-%m-01')")->row();
    }

}