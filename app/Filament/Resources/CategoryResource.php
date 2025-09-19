<?php

namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CategoryResource extends CustomResource
{
    protected static ?string $model = Category::class;

    protected static string $translationLabel = 'Categories';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static ?string $categoryModel = null;

    public static ?PermissionEnum $viewAny = null;

    public static ?PermissionEnum $create = null;

    public static ?PermissionEnum $updateAny = null;

    public static ?PermissionEnum $deleteAny = null;

    public static bool $showOnNavbar = false;

    public static function canViewAny(): bool
    {
        return static::$viewAny && Auth::check() && Auth::user()->hasPermissionTo(static::$viewAny);
    }

    public static function canCreate(): bool
    {
        return static::$create && Auth::check() && Auth::user()->hasPermissionTo(static::$create);
    }

    public static function canUpdate(Model $record): bool
    {
        return static::$updateAny && Auth::check() && Auth::user()->hasPermissionTo(static::$updateAny);
    }

    public static function canDelete(Model $record): bool
    {
        return static::$deleteAny && Auth::check() && Auth::user()->hasPermissionTo(static::$deleteAny);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('model', static::$categoryModel);
    }

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            Forms\Components\Toggle::make('show_on_navbar')
                ->translateLabel()
                ->visible(static::$showOnNavbar),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('show_on_navbar')
                    ->translateLabel()
                    ->boolean()
                    ->visible(static::$showOnNavbar),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
