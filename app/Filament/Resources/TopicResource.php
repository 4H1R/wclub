<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\TopicResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Topic;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class TopicResource extends CustomResource
{
    protected static ?string $model = Topic::class;

    protected static string $translationLabel = 'Topics';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
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
                ->maxLength(100),
            Forms\Components\Toggle::make('show_on_navbar')
                ->translateLabel(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('show_on_navbar')
                    ->translateLabel()
                    ->boolean(),
                Tables\Columns\TextColumn::make('parent.title')
                    ->label(__('Parent')),
                Tables\Columns\TextColumn::make('title')
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
            'index' => Pages\ListTopics::route('/'),
            'create' => Pages\CreateTopic::route('/create'),
            'edit' => Pages\EditTopic::route('/{record}/edit'),
        ];
    }
}
