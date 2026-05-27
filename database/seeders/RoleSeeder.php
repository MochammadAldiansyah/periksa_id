<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
   public function run(): void
    {
        // 1. Hapus cache permission Spatie terlebih dahulu
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Gunakan firstOrCreate untuk ketiga role agar tidak duplikat
        $adminRole  = Role::firstOrCreate(['name' => 'admin']);
        $dokterRole = Role::firstOrCreate(['name' => 'dokter']);
        $pasienRole = Role::firstOrCreate(['name' => 'pasien']);

        // 3. Cek apakah akun admin utama sudah ada (Kurung sudah diperbaiki)
      $admin = User::query()->where('email', 'admin@gmail.com')->first();
      
        if (!$admin) {
            $admin = User::create([
                'name' => 'Utama Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password123'),
            ]);

            // Berikan role admin ke akun baru
            $admin->assignRole($adminRole);
        }
    }
}
