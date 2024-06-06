<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class position_model extends MY_Model {
	protected $table_name = 'vision_positions';
    protected $key = 'id';
    protected $set_created = true;
    protected $log_user = true;
    protected $set_modified = false;
    protected $soft_deletes = true;
    protected $date_format = 'datetime';
	
	protected $created_field    = 'created_on';
    
	public function update_sequences($sequence,$id)
	{
		return $this->db->query("")->row;
	}
	
}