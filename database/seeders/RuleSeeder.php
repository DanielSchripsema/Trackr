<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

	$role1 = Role::create(['name' => 'super-admin']);
	$role2 = Role::create(['name' => 'admin']);
	$role3 = Role::create(['name' => 'reciever']);

	$user = \App\Models\User::factory()->create([
	    'name' => 'superadmin',
	    'email' => 'sa@example.com',
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'a@example.com',
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'reciever',
            'email' => 'r@example.com',
        ]);
        $user->assignRole($role3);
    }
}
