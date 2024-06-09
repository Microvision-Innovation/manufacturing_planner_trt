<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Job_types_model extends MY_Model {
	protected $table_name = 'bf_vision_job_types';
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


    public function get_job_types()
    {
        return $this->db->query("SELECT bf_vision_job_types.*,display_name FROM bf_vision_job_types 
                                    LEFT JOIN bf_users ON bf_users.id=bf_vision_job_types.created_by ORDER BY bf_vision_job_types.job_type_name")->result();
    }

	
}