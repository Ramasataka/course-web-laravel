<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'manage-user',
            'manage-courses',
            'manage-materials',
            'manage-quiz',
            'assign-courses',
            'view-enrolled-students',
            'view-materials',
            'take-quizzes',
            'lihat-materi',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $mentorRole = Role::firstOrCreate(['name' => 'mentor']);
        $studentRole = Role::firstOrCreate(['name' => 'student']);

        $adminRole->givePermissionTo([
            'manage-user', 'manage-courses', 'manage-materials', 'manage-quiz', 'assign-courses'
        ]);
        $mentorRole->givePermissionTo([
            'manage-materials', 'view-enrolled-students', 'manage-quiz'
        ]);
        $studentRole->givePermissionTo([
            'view-materials', 'take-quizzes'
        ]);
    }
}
