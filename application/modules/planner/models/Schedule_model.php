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
	protected $deleted_field = 'deleated';


	public function get_all_statuses()
    {
        return $this->db->query("SELECT * FROM bf_vision_schedule_status")->result();
    }

    public function get_area_schedules($job_area_id,$start_date,$end_date)
    {
        return $this->db->query("SELECT s.*, sj.job_number,sj.capacity, sj.description, ss.color_code,ss.text_color,ss.color_class FROM bf_vision_schedules s 
                                    LEFT JOIN bf_vision_schedule_jobs sj ON sj.id=s.schedule_job_id
                                    LEFT JOIN bf_vision_schedule_status ss ON ss.id = s.status
                                    INNER JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                    WHERE s.schedule_date >='".$start_date."' AND  s.schedule_date <='".$end_date."' AND jl.job_area_id='".$job_area_id."' AND s.deleated=0")->result();
    }
    public function get_line_shift_schedule($shift_id, $line_id, $schedule_date)
    {
        return $this->db->query("SELECT s.*, ss.schedule_status, sj.job_number,sj.capacity, sj.description,ja.id job_area_id, ja.job_area_name,jl.line_name, jt.job_type_name, jt.symbol FROM bf_vision_schedules s 
                                    LEFT JOIN bf_vision_schedule_jobs sj ON sj.id=s.schedule_job_id
                                    LEFT JOIN bf_vision_schedule_status ss ON ss.id = s.status
                                    LEFT JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                    LEFT JOIN bf_vision_job_areas ja ON jl.job_area_id = ja.id 
                                    LEFT JOIN bf_vision_job_types jt ON ja.job_type_id = jt.id 
                                    WHERE s.schedule_date ='".$schedule_date."' AND  s.shift_id ='".$shift_id."' AND s.job_line_id='".$line_id."' AND s.deleated=0")->result();
    }
    public function get_related_line_shifts_schedules($shift_id, $line_id, $schedule_date){
        return $this->db->query("SELECT s.*, ss.schedule_status, sj.job_number,sj.job_numbers,sj.capacity, sj.description,ja.id job_area_id, ja.job_area_name,jl.line_name, jt.job_type_name, jt.symbol FROM bf_vision_schedules s 
                                    INNER JOIN (SELECT sj.*,
                                                    CASE
                                                        WHEN RIGHT(job_number, 1) = 'B' THEN SUBSTRING(job_number, 1, LENGTH(job_number) - 1)
                                                        ELSE job_number
                                                    END AS job_numbers FROM bf_vision_schedule_jobs sj) sj ON sj.id=s.schedule_job_id
                                    LEFT JOIN bf_vision_schedule_status ss ON ss.id = s.status
                                    LEFT JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                    LEFT JOIN bf_vision_job_areas ja ON jl.job_area_id = ja.id 
                                    LEFT JOIN bf_vision_job_types jt ON ja.job_type_id = jt.id 
                                    INNER JOIN
                                    (SELECT sj.id,sj.job_number,
                                                    CASE
                                                        WHEN RIGHT(job_number, 1) = 'B' THEN SUBSTRING(job_number, 1, LENGTH(job_number) - 1)
                                                        ELSE job_number
                                                    END AS job_numbers FROM bf_vision_schedules s 
                                        LEFT JOIN bf_vision_schedule_jobs sj ON sj.id=s.schedule_job_id 
                                        WHERE s.schedule_date ='".$schedule_date."' AND  s.shift_id ='".$shift_id."' AND s.job_line_id='".$line_id."' AND s.deleated=0)rl ON rl.job_numbers = sj.job_numbers and rl.id != sj.id
                                         WHERE rl.id IS NOT NULL")->result();
    }
    public function get_related_job_schedules($job_number, $job_id)
    {
        return $this->db->query("SELECT s.*, ss.schedule_status, sj.job_number,sj.capacity, sj.description,ja.id job_area_id, ja.job_area_name,jl.line_name, jt.job_type_name, jt.symbol FROM bf_vision_schedules s 
                                    RIGHT JOIN (SELECT sj.*,
                                                    CASE
                                                        WHEN RIGHT(job_number, 1) = 'B' THEN SUBSTRING(job_number, 1, LENGTH(job_number) - 1)
                                                        ELSE job_number
                                                    END AS job_numbers FROM bf_vision_schedule_jobs sj WHERE id != '".$job_id."' HAVING job_numbers = '".$job_number."') sj ON sj.id=s.schedule_job_id
                                    LEFT JOIN bf_vision_schedule_status ss ON ss.id = s.status
                                    LEFT JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                    LEFT JOIN bf_vision_job_areas ja ON jl.job_area_id = ja.id 
                                    LEFT JOIN bf_vision_job_types jt ON ja.job_type_id = jt.id
                                    WHERE deleated=0")->result();
    }
    public function get_line_shift_schedule_extensions($shift_id, $line_id, $schedule_date)
    {
        return $this->db->query("SELECT s.*, ss.schedule_status, sj.job_number,sj.capacity, sj.description,ja.id job_area_id, ja.job_area_name,jl.line_name, jt.job_type_name, jt.symbol FROM bf_vision_schedules s
                                    LEFT JOIN bf_vision_schedule_jobs sj ON sj.id=s.schedule_job_id
                                    LEFT JOIN bf_vision_schedule_status ss ON ss.id = s.status
                                    LEFT JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                    LEFT JOIN bf_vision_job_areas ja ON jl.job_area_id = ja.id
                                    LEFT JOIN bf_vision_job_types jt ON ja.job_type_id = jt.id
                                    WHERE s.schedule_job_id IN (SELECT schedule_job_id FROM bf_vision_schedules s WHERE s.schedule_date ='".$schedule_date."' AND  s.shift_id ='".$shift_id."' AND s.job_line_id='".$line_id."' AND s.deleated='0')
                                        AND s.id NOT IN (SELECT id FROM bf_vision_schedules s WHERE s.schedule_date ='".$schedule_date."' AND  s.shift_id ='".$shift_id."' AND s.job_line_id='".$line_id."' AND s.deleated='0') AND s.deleated='0'")->result();
    }
    public function get_line_shift_schedule_logs($shift_id, $line_id, $schedule_date)
    {
        return $this->db->query("SELECT sl.*,ss.schedule_status as schedule_status_name,ss.step_order,u.display_name FROM bf_vision_schedule_logs sl 
                                        INNER JOIN bf_vision_schedules s ON s.id=sl.schedule_id 
                                        INNER JOIN bf_vision_schedule_status ss ON ss.id=sl.schedule_status
                                        INNER JOIN bf_users u ON u.id = sl.created_by
                                        WHERE s.schedule_date ='".$schedule_date."' AND  s.shift_id ='".$shift_id."' AND s.job_line_id='".$line_id."' AND s.deleated=0
                                        ORDER BY sl.created_on ASC")->result();
    }
    public function get_line_details($line_id)
    {
        return $this->db->query("SELECT jl.*, ja.job_area_name, ja.job_type_id, jt.job_type_name, jt.symbol from bf_vision_job_lines jl
                                        LEFT JOIN bf_vision_job_areas ja ON ja.id=jl.job_area_id
                                        LEFT JOIN bf_vision_job_types jt ON jt.id = ja.job_type_id
                                        WHERE jl.id='".$line_id."'")->row();
    }
    public function get_statuses($job_type_id)
    {
        return $this->db->query("SELECT * FROM bf_vision_schedule_status WHERE job_type_id='".$job_type_id."' and status=1")->result();
    }
    public function get_schedule_logs($schedule_id)
    {
        return $this->db->query("SELECT sl.*,ss.schedule_status as schedule_status_name,u.display_name FROM bf_vision_schedule_logs sl 
                                        INNER JOIN bf_vision_schedules s ON s.id=sl.schedule_id 
                                        INNER JOIN bf_vision_schedule_status ss ON ss.id=sl.schedule_status
                                        INNER JOIN bf_users u ON u.id = sl.created_by
                                        WHERE s.id ='".$schedule_id."' 
                                        ORDER BY sl.created_on ASC")->result();
    }
    public function get_search_results($job_number)
    {
        return $this->db->query("SELECT sj.*,jt.symbol FROM bf_vision_schedule_jobs sj 
                                        LEFT JOIN bf_vision_job_types jt ON jt.id = sj.job_type
                                        WHERE sj.job_number LIKE '%".$job_number."%' and sj.deleted=0 ORDER BY sj.created_on DESC LIMIT 10")->result();
    }
    public function get_search_results2($job_number,$job_type)
    {
        return $this->db->query("SELECT sj.*,jt.symbol FROM bf_vision_schedule_jobs sj 
                                        LEFT JOIN bf_vision_job_types jt ON jt.id = sj.job_type
                                        LEFT JOIN (SELECT DISTINCT(schedule_job_id) schedule_job_id FROM bf_vision_schedules WHERE deleated=0) s ON s.schedule_job_id = sj.id 
                                        WHERE sj.job_number LIKE '%".$job_number."%' and job_type='".$job_type."' and s.schedule_job_id IS NULL and sj.deleted=0 ORDER BY sj.created_on DESC LIMIT 5")->result();
    }
    public function get_data_sheet_data($start_date, $end_date)
    {
        return $this->db->query("SELECT date(s.schedule_date) schedule_date,DAYNAME(s.schedule_date) week_day, shift.shift_name,
                                       sj.job_number, sj.description, IF(sj.job_type=1,jl.line_name,NULL) AS tanks,IF(sj.job_type=1,sj.capacity,NULL) AS bulk_size,
                                       IF(sj.job_type=2,jl.line_name,NULL) AS pack_lines,IF(sj.job_type=2,sj.capacity,NULL) AS pack_units,vss.schedule_status FROM bf_vision_schedules s
                                        LEFT JOIN bf_vision_shifts shift ON shift.id = s.shift_id
                                        LEFT JOIN bf_vision_schedule_jobs sj ON sj.id = s.schedule_job_id
                                        LEFT JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                        LEFT JOIN bf_vision_schedule_status vss ON vss.id = s.status
                                        WHERE s.schedule_date BETWEEN '".$start_date."' AND '".$end_date."'
                                        ORDER BY s.schedule_date")->result();
    }
}