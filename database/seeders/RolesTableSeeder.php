<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        [
            'role_name' => 'employer',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],[
            'role_name' => 'jobseeker',
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        ],
    ];
    Role::insert($roles);
    }
}
