<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Resources\EventProgramResource\Pages;
use App\Models\EventProgram;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class EventProgramResource extends CustomResource
{
    protected static ?string $model = EventProgram::class;

    protected static string $translationLabel = 'Event Programs';

    protected static ?string $navigationIcon = 'heroicon-o-fire';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListEventPrograms::route('/'),
            'create' => Pages\CreateEventProgram::route('/create'),
            'edit' => Pages\EditEventProgram::route('/{record}/edit'),
        ];
    }
}
