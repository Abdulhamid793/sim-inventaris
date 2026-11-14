<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Demo',
            'email' => 'admin@battle.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff Demo',
            'email' => 'staff@battle.com',
            'password' => bcrypt('password'),
            'role' => 'staff', // Paket 2: 'author', Paket 3: 'anggota'
        ]);

        $this->call(ItemSeeder::class);
    }
}