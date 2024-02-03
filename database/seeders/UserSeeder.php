<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(20)->create();

        User::factory()->create([
            'first_name' => 'Alexandru',
            'last_name' => 'Iacob',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('pass@1234'),
            'role_id' => Role::inRandomOrder()->first()->id
        ]);
    }
}
