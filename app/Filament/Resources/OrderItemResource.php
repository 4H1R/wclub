<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\MoneyInput;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\OrderItemResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\OrderItem;
use App\Models\Series;
use Filament\Forms;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class OrderItemResource extends CustomResource
{
    protected static ?string $model = OrderItem::class;

    protected static string $translationLabel = 'Order Items';

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Orders', 2);
    }

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
            MorphToSelect::make('model')
                ->translateLabel()
                ->columnSpanFull()
                ->searchable()
                ->preload()
                ->optionsLimit(50)
                ->required()
                ->types([
                    MorphToSelect\Type::make(Series::class)
                        ->label(trans_choice('Series', 2))
                        ->titleAttribute('title'),
                ]),
            Forms\Components\Select::make('order_id')
                ->searchable()
                ->label(trans_choice('Orders', 1))
                ->hiddenOn(OrderResource\RelationManagers\OrderItemsRelationManager::class)
                ->preload()
                ->optionsLimit(50)
                ->relationship('order', 'id'),
            MoneyInput::make('price'),
            Forms\Components\TextInput::make('quantity')
                ->translateLabel()
                ->integer()
                ->minValue(1)
                ->required(),
            MoneyInput::make('subtotal'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order.id')
                    ->hiddenOn(OrderResource\RelationManagers\OrderItemsRelationManager::class)
                    ->label(trans_choice('Orders', 1)),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->numeric()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable()
                    ->numeric()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->sortable()
                    ->numeric()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListOrderItems::route('/'),
            'create' => Pages\CreateOrderItem::route('/create'),
            'edit' => Pages\EditOrderItem::route('/{record}/edit'),
        ];
    }
}
