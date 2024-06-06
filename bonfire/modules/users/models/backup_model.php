<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backup_model extends MY_Model {
	protected $table_name = 'vision_database_backup';
    protected $key = 'id';
    protected $set_created = false;
    protected $log_user = false;
    protected $set_modified = false;
    protected $soft_deletes = true;
    protected $date_format = 'datetime';
	
	//protected $created_field    = 'create_on';
    
	public function get_last_backup()
	{
		return $this->db->query("SELECT * FROM bf_vision_database_backup WHERE id=1 LIMIT 1")->row();
	}
	public function save_last_backup($today)
	{
		$this->db->query("UPDATE bf_vision_database_backup SET backup_date='".$today."' WHERE id=1");
	}
	
}