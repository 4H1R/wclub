<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(['email' => 'admin@email.com'])
            ->assignRole(RoleEnum::SuperAdmin);

        User::factory()->create(['email' => 'test@email.com'])
            ->assignRole(RoleEnum::Test);

        User::factory(30)->create();
    }
}
