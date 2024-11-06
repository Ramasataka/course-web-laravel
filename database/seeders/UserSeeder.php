<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'admin')->first();
        $mentorRole = Role::where('name', 'mentor')->first();
        $studentRole = Role::where('name', 'student')->first();

        $admin = User::factory()->create([
            'nama_user' => 'Admin User',
            'email' => 'admin@admin.com'
        ]);
        $admin->assignRole($adminRole);

        $mentor = User::factory()->create([
            'nama_user' => 'Mentor User',
        ]);
        $mentor->assignRole($mentorRole);

        $student = User::factory()->create([
            'nama_user' => 'Student User',
        ]);
        $student->assignRole($studentRole);

        User::factory(5)->create()->each(function ($user) use ($studentRole) {
            $user->assignRole($studentRole);
        });

        User::factory(3)->create()->each(function ($user) use ($mentorRole) {
            $user->assignRole($mentorRole);
        });
    }
}
