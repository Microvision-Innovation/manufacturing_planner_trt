<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	class User_accounts_model extends MY_Model{
		
		protected $table_name = 'users';
		protected $key = 'id';
		protected $set_created = false;
		protected $log_user = true;
		protected $set_modified = false;
		protected $soft_deletes = true;
		protected $date_format = 'datetime';
		
		protected $created_field    = 'created_on';
		//protected $created_by_field = 'created_by';
		//protected $modified_field   = 'modified_on';
		//protected $modified_by_field = 'modified_by';
		
		//protected $deleted_field    = 'deleted';
		//protected $deleted_by_field = 'deleted_by';
		
		
		public function get_users_details()
		{
			return $this->db->query("SELECT bf_users.*,role_name FROM bf_users LEFT JOIN bf_roles ON bf_roles.role_id=bf_users.role_id WHERE bf_users.role_id>=8 order by display_name")->result();			
		}
		public function get_user_details($id)
		{
			return $this->db->query("SELECT bf_users.* FROM bf_users WHERE bf_users.id=".$id."")->row();			
		}
				
		
	}