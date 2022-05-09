<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();

        $adminRoles = Roles::where('role_name','admin')->first();
        $shipperRoles = Roles::where('role_name','shipper')->first();
        $userRoles = Roles::where('role_name','user')->first();

        $admin = Admin::create([
			'admin_name' => 'MinhLe',
			'admin_email' => 'admin@gmail.com',
			'admin_phone' => '0932023991',
			'admin_pass' => md5('123456')	
        ]);
        $shipper = Admin::create([
			'admin_name' => 'MinhLe123',
			'admin_email' => 'minhle123@gmail.com',
			'admin_phone' => '0932023992',
			'admin_pass' => md5('123456')	
        ]);
        $user = Admin::create([
			'admin_name' => 'minhle456',
			'admin_email' => 'minhle456@gmail.com',
			'admin_phone' => '0932023993',
			'admin_pass' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $shipper->roles()->attach($shipperRoles);
        $user->roles()->attach($userRoles);
    }
}
