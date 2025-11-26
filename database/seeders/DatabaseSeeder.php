<?php

namespace Database\Seeders;

use App\Enums\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Admin
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@voteunited.com',
            'email_verified_at' => now(),
            'role' => Role::Admin->value,
            'password' => Hash::make('voteunited'),
        ]);
    }
}
