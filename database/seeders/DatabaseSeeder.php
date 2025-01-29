<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);

        $adminRole = Role::create(['name' => 'admin']);
        $empRole = Role::create(['name' => 'employee']);

        $userAdmin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@gmail.com'),
        ]);
        $userEmp = User::create([
            'name' => 'employee',
            'email' => 'employee@gmail.com',
            'password' => bcrypt('employee@gmail.com'),
        ]);

        $userAdmin->assignRole($adminRole);
        $userEmp->assignRole($empRole);
    }
}
