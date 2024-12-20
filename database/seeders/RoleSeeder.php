<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\RoleEnum;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RoleEnum::all()->each(function (string $name) {
            if (Role::where('name', $name)->exists()) {
                return;
            }

            Role::create(['name' => $name, 'title' => RoleEnum::from($name)->getLabel()]);
        });

        Role::query()
            ->where('name', RoleEnum::SuperAdmin)
            ->first()
            ?->syncPermissions(PermissionEnum::except([
                PermissionEnum::ViewOwnedUsers->name,
                PermissionEnum::UpdateOwnedUsers->name,
                PermissionEnum::ViewOwnedEventPrograms->name,
                PermissionEnum::UpdateOwnedEventPrograms->name,
                PermissionEnum::DeleteOwnedEventPrograms->name,
            ])->values()->toArray());

        Role::query()
            ->where('name', RoleEnum::Test)
            ->first()
            ?->syncPermissions([
                PermissionEnum::ViewAdminPanel->value,
                PermissionEnum::ViewAnyContests->value,
                PermissionEnum::UpdateAnyContests->value,
            ]);
    }
}
