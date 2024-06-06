<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting_model extends MY_Model {
	protected $table_name = 'bf_users';
    protected $key = 'id';
    protected $set_created = true;
    protected $log_user = false;
    protected $set_modified = false;
    protected $soft_deletes = false;
    protected $date_format = 'datetime';
	
	protected $created_field    = 'create_on';
    
	
}