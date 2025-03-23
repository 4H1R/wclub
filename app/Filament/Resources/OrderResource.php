<?php

namespace App\Filament\Resources;

use App\Enums\Order\OrderPaymentStatusEnum;
use App\Enums\Order\OrderStatusEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\MoneyInput;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class OrderResource extends CustomResource
{
    protected static ?string $model = Order::class;

    protected static string $translationLabel = 'Orders';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Orders', 2);
    }

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
            Forms\Components\Select::make('user_id')
                ->searchable()
                ->label(trans_choice('Users', 1))
                ->preload()
                ->optionsLimit(50)
                ->relationship('user', 'phone'),
            Forms\Components\Select::make('coupon_id')
                ->searchable()
                ->label(trans_choice('Coupons', 1))
                ->preload()
                ->optionsLimit(50)
                ->relationship('coupon', 'code'),
            Forms\Components\Select::make('status')
                ->translateLabel()
                ->searchable()
                ->options(OrderStatusEnum::class)
                ->required(),
            Forms\Components\Select::make('payment_status')
                ->translateLabel()
                ->searchable()
                ->options(OrderPaymentStatusEnum::class)
                ->required(),
            MoneyInput::make('total_amount'),
            MoneyInput::make('coupon_amount'),
            MoneyInput::make('paying_amount'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->badge()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label(trans_choice('Users', 1)),
                Tables\Columns\TextColumn::make('total_amount')
                    ->sortable()
                    ->numeric()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('coupon_amount')
                    ->sortable()
                    ->numeric()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('paying_amount')
                    ->sortable()
                    ->numeric()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->translateLabel()
                    ->options(OrderStatusEnum::class),
                Tables\Filters\SelectFilter::make('payment_status')
                    ->translateLabel()
                    ->options(OrderPaymentStatusEnum::class),
                Tables\Filters\SelectFilter::make('user')
                    ->preload()
                    ->optionsLimit(50)
                    ->relationship('user', 'phone')
                    ->label(trans_choice('Users', 1))
                    ->searchable(),
                Tables\Filters\SelectFilter::make('coupon')
                    ->preload()
                    ->optionsLimit(50)
                    ->relationship('coupon', 'code')
                    ->label(trans_choice('Coupons', 1))
                    ->searchable(),
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
            RelationManagers\TransactionsRelationManager::class,
            RelationManagers\OrderItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
