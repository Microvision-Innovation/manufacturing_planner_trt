<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_setting_permissons extends Migration
{

	/**
	 * Migrate Permissions for the finance module
	 *
	 * @var Array
	 */
	private $permission_values = array(
		array(
			'name'          => 'Vision.Setting.View',
			'description'   => 'Manage general system settings.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Vision.Setting.User_Manage',
			'description'   => 'Manage users on the front end.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Vision.Setting.Company_view',
			'description'   => 'Edit company details and information.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Vision.Setting.Pay_periods',
			'description'   => 'Manage frequency of payments to employees in a year.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Vision.Setting.Department_Manage',
			'description'   => 'Edit company details and information.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Vision.Setting.Banks_Manage',
			'description'   => 'Manage employee payment banks.',
			'status'        => 'active',
		),	array(
			'name'          => 'Vision.Setting.Position_Manage',
			'description'   => 'Manage employee positions.',
			'status'        => 'active',
		),
		
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