<?php

namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use App\Filament\Resources\RewardProgramCategoryResource\Pages;
use App\Models\RewardProgram;

class RewardProgramCategoryResource extends CategoryResource
{
    public static ?string $categoryModel = RewardProgram::class;

    public static ?PermissionEnum $viewAny = PermissionEnum::ViewAnyRewardProgramCategories;

    public static ?PermissionEnum $create = PermissionEnum::CreateRewardProgramCategories;

    public static ?PermissionEnum $updateAny = PermissionEnum::UpdateAnyRewardProgramCategories;

    public static ?PermissionEnum $deleteAny = PermissionEnum::DeleteAnyRewardProgramCategories;

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Reward Programs', 2);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRewardProgramCategories::route('/'),
            'create' => Pages\CreateRewardProgramCategory::route('/create'),
            'edit' => Pages\EditRewardProgramCategory::route('/{record}/edit'),
        ];
    }
}
