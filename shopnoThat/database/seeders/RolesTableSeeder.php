<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate();

        Roles::create(['role_name'=>'admin']);
        Roles::create(['role_name'=>'shipper']);
        Roles::create(['role_name'=>'user']);
    }
}
