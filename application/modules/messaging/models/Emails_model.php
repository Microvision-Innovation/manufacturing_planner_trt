<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails_model extends MY_Model {
	protected $table_name = 'email_queue';
    protected $key = 'id';
	protected $set_created = false;
	protected $log_user = false;
	protected $set_modified = false;
	protected $soft_deletes = false;
	protected $date_format = 'datetime';
	
	protected $created_field    = 'created_on';
	protected $created_by_field = 'created_by';
	protected $modified_field   = 'modified_on';
	protected $modified_by_field = 'modified_by';


   
}