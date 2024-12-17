<?php

namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use App\Filament\Resources\SeriesCategoryResource\Pages;
use App\Models\Series;

class SeriesCategoryResource extends CategoryResource
{
    public static ?string $categoryModel = Series::class;

    public static ?PermissionEnum $viewAny = PermissionEnum::ViewAnySeriesCategories;

    public static ?PermissionEnum $create = PermissionEnum::CreateSeriesCategories;

    public static ?PermissionEnum $updateAny = PermissionEnum::UpdateAnySeriesCategories;

    public static ?PermissionEnum $deleteAny = PermissionEnum::DeleteAnySeriesCategories;

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Series', 2);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeriesCategories::route('/'),
            'create' => Pages\CreateSeriesCategory::route('/create'),
            'edit' => Pages\EditSeriesCategory::route('/{record}/edit'),
        ];
    }
}
