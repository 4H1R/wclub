<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        PermissionEnum::all()->each(function (string $name) {
            if (Permission::where('name', $name)->exists()) {
                return;
            }

            Permission::create(['name' => $name, 'title' => PermissionEnum::from($name)->getLabel()]);
        });
    }
}
