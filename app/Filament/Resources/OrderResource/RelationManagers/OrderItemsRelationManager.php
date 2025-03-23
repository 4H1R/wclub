<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\OrderItemResource;
use App\Models\OrderItem;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class OrderItemsRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $resource = OrderItemResource::class;

    public function table(Table $table): Table
    {
        return static::$resource::table($table)
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('view_model')
                    ->icon('heroicon-o-eye')
                    ->openUrlInNewTab()
                    ->translateLabel()
                    ->url(function (OrderItem $orderItem): string {
                        $resource = Str::of($orderItem->model_type)->replace('App\\Models\\', '')->slug()->value();

                        return route("filament.admin.resources.$resource.edit", $orderItem->model_id);
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
