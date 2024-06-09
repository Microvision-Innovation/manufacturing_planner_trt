<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lines_model extends MY_Model {
	protected $table_name = 'bf_vision_job_lines';
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


    public function get_lines()
    {
        return $this->db->query("SELECT bf_vision_job_lines.*,bf_vision_job_areas.job_area_name as job_area_name,bf_vision_job_types.job_type_name as job_type_name,c.display_name as created_name,m.display_name as modified_name FROM bf_vision_job_lines 
                                        LEFT JOIN bf_vision_job_areas ON bf_vision_job_lines.job_area_id = bf_vision_job_areas.id 
                                        LEFT JOIN bf_vision_job_types ON bf_vision_job_areas.job_type_id = bf_vision_job_types.id 
                                        LEFT JOIN bf_users c ON c.id=bf_vision_job_lines.created_by
                                        LEFT JOIN bf_users m ON m.id=bf_vision_job_lines.modified_by
                                         WHERE bf_vision_job_lines.status=1 ORDER BY bf_vision_job_lines.line_name")->result();
    }

	
}