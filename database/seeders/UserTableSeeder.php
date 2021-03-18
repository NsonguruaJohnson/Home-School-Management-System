<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where('name', 'Admin')->first();
        // $admin = Role::whereRole('admin')->first();
        User::create([
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),   # Password is admin123
            'role_id' => $admin->id
        ]);

        $teacher = Role::where('name', 'Teacher')->first();
        User::create([
            'name' => 'Teacher',
            'username' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('teacher1'),   # Password is teacher1
            'role_id' => $teacher->id
        ]);
    }
}
