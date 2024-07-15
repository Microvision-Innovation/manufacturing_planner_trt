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



    public function get_data_sheet_data($start_date, $end_date)
    {
        return $this->db->query("SELECT date(s.schedule_date) schedule_date,date(sj.planned_start_date) planned_start_date,DAYNAME(s.schedule_date) week_day, shift.shift_name,
                                       sj.job_number, sj.description,sj.produced_qty, IF(sj.job_type=1,jl.line_name,NULL) AS tanks,IF(sj.job_type=1,sj.capacity,NULL) AS bulk_size,
                                       IF(sj.job_type=2,jl.line_name,NULL) AS pack_lines,IF(sj.job_type=2,sj.capacity,NULL) AS pack_units,vss.schedule_status FROM bf_vision_schedules s
                                        LEFT JOIN bf_vision_shifts shift ON shift.id = s.shift_id
                                        LEFT JOIN bf_vision_schedule_jobs sj ON sj.id = s.schedule_job_id
                                        LEFT JOIN bf_vision_job_lines jl ON jl.id = s.job_line_id
                                        LEFT JOIN bf_vision_schedule_status vss ON vss.id = s.status
                                        WHERE s.schedule_date BETWEEN '".$start_date."' AND '".$end_date."'
                                        GROUP BY job_number
                                        ORDER BY s.schedule_date")->result();
    }
}