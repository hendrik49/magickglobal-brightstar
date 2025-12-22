<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Punishment;

class MasterPermissionSeeder extends Seeder
{
    public function run()
    {
        // -----------------------------
        // 1️⃣ Semua permissions
        // -----------------------------
        $permissions = [
            // Punishment
            'manage punishment',
            'create punishment',
            'edit punishment',
            'delete punishment',
            'show punishment',

        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate([
                'name' => $perm,
                'guard_name' => 'web'
            ]);
        }

        // -----------------------------
        // 2️⃣ Buat role super admin
        // -----------------------------
        $superAdminRole = Role::firstOrCreate([
            'name' => 'HRD',
            'guard_name' => 'web'
        ]);

        // -----------------------------
        // 3️⃣ Assign semua permission ke role
        // -----------------------------
        $superAdminRole->syncPermissions($permissions);

        // -----------------------------
        // 4️⃣ Assign role ke user id 1
        // -----------------------------
        $user = User::find(4); // ganti sesuai id user admin
        if ($user) {
            $user->syncRoles(['HRD']);
        }

        $this->command->info('✅ MasterPermissionSeeder: semua permission & role sudah siap!');
    }
}
