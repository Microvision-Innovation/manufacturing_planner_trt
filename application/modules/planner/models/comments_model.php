<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comments_model extends MY_Model {
    protected $table_name = 'bf_vision_schedule_comments';
    protected $key = 'id';
    protected $set_created = true;
    protected $log_user = true;
    protected $set_modified = true;
    protected $soft_deletes = false;
    protected $date_format = 'datetime';

    protected $created_field    = 'created_on';
    protected $created_by_field = 'created_by';
    protected $modified_field   = 'modified_on';
    protected $modified_by_field = 'modified_by';

    public function get_line_shift_comments($shift_id, $line_id, $schedule_date)
    {
        return $this->db->query("SELECT c.*,s.schedule_job_id, u.display_name FROM bf_vision_schedules s
                                   INNER JOIN (SELECT c.*,s.schedule_job_id FROM bf_vision_schedule_comments c INNER JOIN bf_vision_schedules s ON c.schedule_id = s.id) c On c.schedule_job_id = s.schedule_job_id
                                   LEFT JOIN bf_users u ON u.id = c.created_by 
                                   WHERE s.schedule_date ='".$schedule_date."' AND  s.shift_id ='".$shift_id."' AND s.job_line_id='".$line_id."' AND s.deleated=0")->result();
    }
    public function get_schedule_comments($job_id){
        return $this->db->query("SELECT c.*,s.schedule_job_id, u.display_name FROM bf_vision_schedule_comments c 
                                    INNER JOIN bf_vision_schedules s ON c.schedule_id = s.id
                                    LEFT JOIN bf_users u ON u.id = c.created_by
                                    WHERE s.schedule_job_id ='".$job_id."'")->result();
    }

}