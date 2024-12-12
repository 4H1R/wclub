<?php

namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use App\Filament\Resources\EventProgramCategoryResource\Pages;
use App\Models\Category;
use App\Models\EventProgram;

class EventProgramCategoryResource extends CategoryResource
{
    protected static ?string $model = Category::class;

    public static ?string $categoryModel = EventProgram::class;

    public static ?PermissionEnum $viewAny = PermissionEnum::ViewAnyEventProgramCategories;

    public static ?PermissionEnum $create = PermissionEnum::CreateEventProgramCategories;

    public static ?PermissionEnum $updateAny = PermissionEnum::UpdateAnyEventProgramCategories;

    public static ?PermissionEnum $deleteAny = PermissionEnum::DeleteAnyEventProgramCategories;

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Event Programs', 2);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventProgramCategories::route('/'),
            'create' => Pages\CreateEventProgramCategory::route('/create'),
            'edit' => Pages\EditEventProgramCategory::route('/{record}/edit'),
        ];
    }
}
