<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{

	public function run()
	{
		$permissionsAdmin = [
			'products.index',
			'products.show',
			'products.store',
			'products.update',
			'products.destroy',
			'categories.index',
			'categories.get-all',
			'categories.create',
			'categories.store',
			'categories.edit',
			'categories.update',
			'categories.destroy',
			'users.index',
			'users.create',
			'users.store',
			'users.edit',
			'users.update',
			'users.destroy',
		];

		// Roles
		$admin = Role::create(['name' => 'admin']);
		Role::create(['name' => 'user']);

		foreach ($permissionsAdmin as $permission) {
			$permission = Permission::create(['name' => $permission]);
			$admin->givePermissionTo($permission);
		}
	}
}
