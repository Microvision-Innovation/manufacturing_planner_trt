<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends MY_Model {
	protected $table_name = 'vision_company_details';
    protected $key = 'id';
    protected $set_created = true;
    protected $log_user = true;
    protected $set_modified = true;
    protected $soft_deletes = false;
    protected $date_format = 'datetime';
	
	protected $created_field    = 'create_on';
    
	public function update_sequences($sequence,$id)
	{
		return $this->db->query("")->row;
	}
	
}