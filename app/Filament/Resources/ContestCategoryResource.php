<?php

namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use App\Filament\Resources\ContestCategoryResource\Pages;
use App\Models\Contest;

class ContestCategoryResource extends CategoryResource
{
    public static ?string $categoryModel = Contest::class;

    public static ?PermissionEnum $viewAny = PermissionEnum::ViewAnyContestCategories;

    public static ?PermissionEnum $create = PermissionEnum::CreateContestCategories;

    public static ?PermissionEnum $updateAny = PermissionEnum::UpdateAnyContestCategories;

    public static ?PermissionEnum $deleteAny = PermissionEnum::DeleteAnyContestCategories;

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Contests', 2);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContestCategories::route('/'),
            'create' => Pages\CreateContestCategory::route('/create'),
            'edit' => Pages\EditContestCategory::route('/{record}/edit'),
        ];
    }
}
