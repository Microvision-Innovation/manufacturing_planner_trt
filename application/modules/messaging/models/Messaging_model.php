<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messaging_model extends MY_Model {
	protected $table_name = 'tbl_emails';
    protected $key = 'id';
	protected $set_created = true;
	protected $log_user = true;
	protected $set_modified = true;
	protected $soft_deletes = true;
	protected $date_format = 'datetime';
	
	protected $created_field    = 'created_on';
	protected $created_by_field = 'created_by';
	protected $modified_field   = 'modified_on';
	protected $modified_by_field = 'modified_by';


    public function get_email_count($status)
    {
        return $this->db->query("SELECT count(*) as total FROM tbl_emails WHERE status = '".$status."'")->row();
    }
    public function get_user_count($role){
        return $this->db->query("SELECT count(*) as total FROM users WHERE users.banned=0 and users.deleted=0 and role_id = '".$role."'")->row();
    }
    public function get_user_levels()
    {
        return $this->db->query("SELECT * FROM roles WHERE role_id >= 7 and deleted=0")->result();
    }
    public function get_regions()
    {
        return $this->db->query("SELECT * FROM tbl_regions")->result();
    }
    public function get_counties()
    {
        return $this->db->query("SELECT * FROM tbl_county order by name")->result();
    }
    public function get_email_recipients($users,$regions,$counties)
    {
        return $this->db->query("SELECT users.*,role_name,tbl_county.name as county FROM users 
                                          LEFT JOIN roles ON roles.role_id=users.role_id 
                                          LEFT JOIN tbl_subcounty ON tbl_subcounty.id = users.scope_id
                                          LEFT JOIN  tbl_county ON tbl_county.id=tbl_subcounty.county_id
                                          LEFT JOIN  tbl_regions ON tbl_regions.id=tbl_county.region_id
                                          WHERE users.banned=0 and users.deleted=0 ".$users." ".$regions." ".$counties."
                                          ORDER BY display_name")->result();
    }
    public function get_email_recipients_count($users,$regions,$counties)
    {
        return $this->db->query("SELECT count(*) as total FROM users LEFT JOIN roles ON roles.role_id=users.role_id 
                                          INNER JOIN tbl_subcounty ON tbl_subcounty.id = users.scope_id
                                          INNER JOIN  tbl_county ON tbl_county.id=tbl_subcounty.county_id
                                          INNER JOIN  tbl_regions ON tbl_regions.id=tbl_county.region_id
                                          WHERE users.banned=0 and users.deleted=0 ".$users." ".$regions." ".$counties."")->row();
    }
}