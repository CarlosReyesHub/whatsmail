<?php

namespace Database\Seeders;

use App\Models\User; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'      => 'Dede Hidayatullah',
            'email'     => 'admin@mdh-digital.com',
            'role'      => 'admin',
            'phone'     => '6281290645584',
            'email_verified_at'     => now(),
            'password'  => Hash::make('11223344'),
        ]);
    }
}
