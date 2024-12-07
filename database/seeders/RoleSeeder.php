<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RolesEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RolesEnum::all()->each(function (string $name) {
            if (Role::where('name', $name)->exists()) {
                return;
            }

            Role::create(['name' => $name, 'title' => RolesEnum::from($name)->getLabel()]);
        });

        Role::query()
            ->where('name', RolesEnum::SuperAdmin)
            ->first()
            ?->syncPermissions(PermissionsEnum::except([
                PermissionsEnum::ViewUser->name,
                PermissionsEnum::UpdateUser->name,
            ])->values()->toArray());
    }
}
