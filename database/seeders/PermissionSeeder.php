<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        PermissionsEnum::all()->each(function (string $name) {
            if (Permission::where('name', $name)->exists()) {
                return;
            }

            Permission::create(['name' => $name, 'title' => PermissionsEnum::from($name)->getLabel()]);
        });
    }
}
