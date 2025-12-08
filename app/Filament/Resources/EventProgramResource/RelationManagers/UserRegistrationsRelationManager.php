<?php

namespace App\Filament\Resources\EventProgramResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\UserResource;
use App\Filament\Tables\Columns\TimestampsColumn;
use Filament\Tables;
use Filament\Tables\Table;

class UserRegistrationsRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'rawRegistrations';

    protected static ?string $resource = UserResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.phone')
                    ->label(__('Phone')),
                Tables\Columns\TextColumn::make('user.first_name')
                    ->label(__('First name')),
                Tables\Columns\TextColumn::make('user.last_name')
                    ->label(__('Last name')),
                ...TimestampsColumn::make(),
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
