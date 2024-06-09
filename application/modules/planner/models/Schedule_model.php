<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_model extends MY_Model {
	protected $table_name = 'bf_vision_schedules';
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


    public function get_area_schedules($job_area_id,$start_date,$end_date)
    {
        return $this->db->query("SELECT s.*, sj.job_number,sj.capacity, sj.description FROM bf_vision_schedules s 
                                    LEFT JOIN bf_vision_schedule_jobs sj ON sj.id=s.schedule_job_id
                                    LEFT JOIN bf_vision_schedule_status ss ON ss.id = s.status
                                    INNER JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                    WHERE s.schedule_date >='".$start_date."' AND  s.schedule_date <='".$end_date."' AND jl.job_area_id='".$job_area_id."' AND s.deleated=0")->result();
    }
    public function get_line_shift_schedule($shift_id, $line_id, $schedule_date)
    {
        return $this->db->query("SELECT s.*, ss.schedule_status, sj.job_number,sj.capacity, sj.description, jt.job_type_name, jt.symbol FROM bf_vision_schedules s 
                                    LEFT JOIN bf_vision_schedule_jobs sj ON sj.id=s.schedule_job_id
                                    LEFT JOIN bf_vision_schedule_status ss ON ss.id = s.status
                                    LEFT JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                    LEFT JOIN bf_vision_job_areas ja ON jl.job_area_id = ja.id 
                                    LEFT JOIN bf_vision_job_types jt ON ja.job_type_id = jt.id 
                                    WHERE s.schedule_date ='".$schedule_date."' AND  s.shift_id <='".$shift_id."' AND s.job_line_id='".$line_id."' AND s.deleated=0")->result();
    }
}