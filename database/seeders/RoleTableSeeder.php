<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'description' => 'Admin',
        ]);

        Role::create([
            'name' => 'Teacher',
            'description' => 'Teacher'
        ]);

        Role::create([
            'name' => 'Student',
            'description' => 'Student'
        ]);
    }
}
