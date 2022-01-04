<?php

namespace Database\Seeders;

use App\Models\Sekolah;
use App\Models\User;
use App\Models\Yayasan;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Admin Yayasan',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'Admin Sekolah',
            'guard_name' => 'web',
        ]);

        $admin =  User::create([
            'name' => 'Developer',
            'username' => '00001',
            'email' => 'developer@spp.com',
            'password' => bcrypt('password')
        ]);

        $yayasan = User::create([
            'name' => 'Admin Yayasan',
            'username' => '00002',
            'email' => 'yayasan@spp.com',
            'password' => bcrypt('password')
        ]);

        $sekolah = User::create([
            'name' => 'Admin Sekolah',
            'username' => '00003',
            'email' => 'sekolah@spp.com',
            'password' => bcrypt('password')
        ]);


        Yayasan::factory(1)->create(['user_id' => 2]);

        Sekolah::factory(2)->create(['yayasan_id' => 1]);

        $sekolah->staff()->create([
            'sekolah_id' => 1,
            'jabatan' => 'Staff Pengelola',
            'tanggal_lahir' => '1990-08-07'
        ]);

        $admin->assignRole(1);
        $yayasan->assignRole(2);
        $sekolah->assignRole(3);
    }
}
