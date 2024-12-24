<?php

namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use App\Filament\Resources\NewsCategoryResource\Pages;
use App\Models\News;

class NewsCategoryResource extends CategoryResource
{
    public static ?string $categoryModel = News::class;

    public static ?PermissionEnum $viewAny = PermissionEnum::ViewAnyContestCategories;

    public static ?PermissionEnum $create = PermissionEnum::CreateContestCategories;

    public static ?PermissionEnum $updateAny = PermissionEnum::UpdateAnyContestCategories;

    public static ?PermissionEnum $deleteAny = PermissionEnum::DeleteAnyContestCategories;

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('News', 2);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNewsCategories::route('/'),
            'create' => Pages\CreateNewsCategory::route('/create'),
            'edit' => Pages\EditNewsCategory::route('/{record}/edit'),
        ];
    }
}
