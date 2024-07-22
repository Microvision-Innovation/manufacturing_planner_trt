<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_status_model extends MY_Model {
	protected $table_name = 'bf_vision_schedule_status';
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


    public function get_last_status($job_id){
        return $this->db->query("SELECT MAX(schedule_status) as status FROM bf_vision_schedule_logs l
                                    INNER JOIN bf_vision_schedules s ON s.id=l.schedule_id
                                    WHERE s.schedule_job_id='".$job_id."' AND (schedule_status !=8 AND schedule_status !=4)")->row();
    }

	
}