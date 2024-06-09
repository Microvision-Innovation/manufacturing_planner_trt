<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Migration_Install_messaging_permissions extends Migration
{

	/**
	 * Migrate Permissions for the finance module
	 *
	 * @var Array
	 */
	private $permission_values = array(
		array(
			'name'          => 'Planner.Messaging.View',
			'description'   => 'Access to messaging modules.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.Messaging.Emails',
			'description'   => 'Can send emails on messaging module.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.Messaging.Notifications',
			'description'   => 'Can create notifications on messaging module.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.Messaging.National',
			'description'   => 'Can send messages on national level.',
			'status'        => 'active',
		),
		array(
			'name'          => 'Planner.Messaging.Regional',
			'description'   => 'Can send messages on regional level.',
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