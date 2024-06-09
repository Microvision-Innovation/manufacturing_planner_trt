<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_user_accounts_permissions extends Migration
{

	/**
	 * Migrate Permissions for the finance module
	 *
	 * @var Array
	 */
	private $permission_values = array(
		array(
			'name'          => 'Planner.User_accounts.View_users',
			'description'   => 'Can the settings.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.User_accounts.Manage_users',
			'description'   => 'Can view user settings front end.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.User_accounts.Create_users',
			'description'   => 'Can create new user front end.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.User_accounts.Edit_users',
			'description'   => 'Can edit user details front end.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.User_accounts.Deactivate_users',
			'description'   => 'Can delete users and user settings front end.',
			'status'        => 'active',
		)	
		
		
	);

    /**
	 * The name of the permissions table
	 *
	 * @var String
	 */
	private $table_name = 'permissions';

	/**
	 * The name of the role/permissions ref table
	 *
	 * @var String
	 */
	private $roles_table = 'role_permissions';

	//--------------------------------------------------------------------

	/**
	 * Install this migration
	 *
	 * @return void
	 */
	public function up()
	{
		$role_permissions_data = array();
		foreach ($this->permission_values as $permission_value)
		{
			$this->db->insert($this->table_name, $permission_value);

			$role_permissions_data[] = array(
				'role_id' => '1',
				'permission_id' => $this->db->insert_id(),
			);
		}

		$this->db->insert_batch($this->roles_table, $role_permissions_data);
	}

	//--------------------------------------------------------------------

	/**
	 * Uninstall this migration
	 *
	 * @return void
	 */
	public function down()
	{
		foreach ($this->permission_values as $permission_value)
		{
			$query = $this->db->select('permission_id')
				->get_where($this->table_name, array('name' => $permission_value['name'],));

			foreach ($query->result() as $row)
			{
				$this->db->delete($this->roles_table, array('permission_id' => $row->permission_id));
			}

			$this->db->delete($this->table_name, array('name' => $permission_value['name']));
		}
	}

	//--------------------------------------------------------------------

}