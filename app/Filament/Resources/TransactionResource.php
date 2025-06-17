<?php

namespace App\Filament\Resources;

use App\Enums\Transaction\TransactionGatewayNameEnum;
use App\Enums\Transaction\TransactionStatusEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\MoneyInput;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class TransactionResource extends CustomResource
{
    protected static ?string $model = Transaction::class;

    protected static string $translationLabel = 'Transactions';

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

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
            Forms\Components\Select::make('order_id')
                ->searchable()
                ->hiddenOn(OrderResource\RelationManagers\TransactionsRelationManager::class)
                ->label(trans_choice('Orders', 1))
                ->preload()
                ->optionsLimit(50)
                ->relationship('order', 'id'),
            Forms\Components\Select::make('status')
                ->translateLabel()
                ->searchable()
                ->options(TransactionStatusEnum::class)
                ->required(),
            Forms\Components\Select::make('gateway_name')
                ->translateLabel()
                ->searchable()
                ->options(TransactionGatewayNameEnum::class)
                ->required(),
            MoneyInput::make('amount')
                ->columnSpanFull(),
            Forms\Components\TextInput::make('ref_id')
                ->columnSpanFull()
                ->translateLabel(),
            Forms\Components\TextInput::make('token')
                ->columnSpanFull()
                ->translateLabel(),
            Forms\Components\Textarea::make('description')
                ->translateLabel()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('gateway_name')
                    ->badge()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label(trans_choice('Users', 1)),
                Tables\Columns\TextColumn::make('order.id')
                    ->hiddenOn(OrderResource\RelationManagers\TransactionsRelationManager::class)
                    ->label(trans_choice('Orders', 1)),
                Tables\Columns\TextColumn::make('amount')
                    ->sortable()
                    ->numeric()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->translateLabel()
                    ->options(TransactionStatusEnum::class),
                Tables\Filters\SelectFilter::make('gateway_name')
                    ->translateLabel()
                    ->options(TransactionGatewayNameEnum::class),
                Tables\Filters\SelectFilter::make('user')
                    ->preload()
                    ->optionsLimit(50)
                    ->relationship('user', 'phone')
                    ->label(trans_choice('Users', 1))
                    ->searchable(),
                Tables\Filters\SelectFilter::make('order')
                    ->preload()
                    ->optionsLimit(50)
                    ->relationship('order', 'id')
                    ->label(trans_choice('Orders', 1))
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}
