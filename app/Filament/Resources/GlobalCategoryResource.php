<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Resources\GlobalCategoryResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class GlobalCategoryResource extends CustomResource
{
    protected static ?string $model = Category::class;

    protected static string $translationLabel = 'Categories';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function canViewAny(): bool
    {
        return Auth::user()->isSuperAdmin();
    }

    public static function canCreate(): bool
    {
        return Auth::user()->isSuperAdmin();
    }

    public static function canUpdate(Model $record): bool
    {
        return Auth::user()->isSuperAdmin();
    }

    public static function canDelete(Model $record): bool
    {
        return Auth::user()->isSuperAdmin();
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('is_global', true);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('parent_id')
                    ->searchable()
                    ->label(__('Parent'))
                    ->columnSpanFull()
                    ->preload()
                    ->optionsLimit(50)
                    ->relationship('parentSelect', 'title'),
                Forms\Components\TextInput::make('title')
                    ->translateLabel()
                    ->required()
                    ->columnSpanFull()
                    ->maxLength(255),
                Forms\Components\Hidden::make('is_global')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('parent.title')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
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
            'index' => Pages\ListGlobalCategories::route('/'),
            'create' => Pages\CreateGlobalCategory::route('/create'),
            'edit' => Pages\EditGlobalCategory::route('/{record}/edit'),
        ];
    }
}
