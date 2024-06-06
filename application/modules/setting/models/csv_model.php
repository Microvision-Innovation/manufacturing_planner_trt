<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Csv_model extends MY_Model {
	protected $table_name = 'vision_misex';
    //protected $key = 'id';
    protected $set_created = false;
    protected $log_user = false;
    protected $set_modified = false;
    //protected $soft_deletes = true;
    protected $date_format = 'datetime';
	
	//protected $created_field    = 'create_on';
    
	public function get_all_csv()
	{
		return $this->db->query("SELECT min(STR_TO_DATE(Date, '%m/%d/%Y')) as start_date,max(STR_TO_DATE(Date, '%m/%d/%Y'))as end_date, uploaddate FROM bf_vision_misex GROUP BY uploaddate ORDER BY uploaddate DESC")->result();
	}
	public function delete_deductions($upload_date)
	{
		$this->db->query("DELETE FROM bf_vision_daily_transactions WHERE created_on='".$upload_date."'");
	}
	public function delete_uploads($upload_date)
	{
		$this->db->query("DELETE FROM bf_vision_misex WHERE uploaddate='".$upload_date."'");
	}
}