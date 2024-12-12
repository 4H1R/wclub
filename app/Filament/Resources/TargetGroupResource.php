<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\TargetGroupResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\TargetGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class TargetGroupResource extends CustomResource
{
    protected static ?string $model = TargetGroup::class;

    protected static string $translationLabel = 'Target Groups';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            Forms\Components\TextInput::make('min_age')
                ->translateLabel()
                ->minValue(1)
                ->maxValue(150)
                ->integer(),
            Forms\Components\TextInput::make('max_age')
                ->translateLabel()
                ->gt('min_age')
                ->minValue(1)
                ->maxValue(150)
                ->integer(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('min_age')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('max_age')
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
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListTargetGroups::route('/'),
            'create' => Pages\CreateTargetGroup::route('/create'),
            'edit' => Pages\EditTargetGroup::route('/{record}/edit'),
        ];
    }
}
