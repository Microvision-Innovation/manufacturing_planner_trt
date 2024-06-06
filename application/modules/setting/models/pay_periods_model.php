<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pay_periods_model extends MY_Model {
	protected $table_name = 'vision_pay_periods';
    protected $key = 'id';
    protected $set_created = false;
    protected $log_user = false;
    protected $set_modified = false;
    protected $soft_deletes = true;
    protected $date_format = 'datetime';
	
	//protected $created_field    = 'create_on';
    
	public function update_sequences($sequence,$id)
	{
		return $this->db->query("")->row;
	}
	
}