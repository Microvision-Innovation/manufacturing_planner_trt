<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule_logs_model extends MY_Model {
	protected $table_name = 'bf_vision_schedule_logs';
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




	
}