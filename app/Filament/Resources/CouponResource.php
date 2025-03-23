<?php

namespace App\Filament\Resources;

use App\Enums\Coupon\CouponTypeEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\MoneyInput;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\CouponResource\Pages;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Coupon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class CouponResource extends CustomResource
{
    protected static ?string $model = Coupon::class;

    protected static string $translationLabel = 'Coupons';

    protected static ?string $navigationIcon = 'heroicon-o-key';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Orders', 2);
    }

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('code')
                ->translateLabel()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(100),
            Forms\Components\DatePicker::make('expired_at')
                ->translateLabel()
                ->required(),
            Forms\Components\Select::make('type')
                ->translateLabel()
                ->reactive()
                ->searchable()
                ->options(CouponTypeEnum::class)
                ->required(),
            Forms\Components\Group::make()
                ->visible(fn (Forms\Get $get): bool => $get('type') === CouponTypeEnum::Amount->value)
                ->schema([
                    MoneyInput::make('amount'),
                ]),
            Forms\Components\Group::make()
                ->visible(fn (Forms\Get $get): bool => $get('type') === CouponTypeEnum::Percentage->value)
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    Forms\Components\TextInput::make('percentage')
                        ->translateLabel()
                        ->integer()
                        ->suffix('%')
                        ->minValue(0)
                        ->maxValue(100)
                        ->required(),
                    MoneyInput::make('max_percentage_amount'),
                ]),
            Forms\Components\Select::make('user_id')
                ->label(trans_choice('Users', 1))
                ->helperText('زمانی که کاربر انتخاب شده باشد به معنای آن است که کاربر با امتیازات خود این کد تخفیف را ساخته است')
                ->preload()
                ->searchable()
                ->optionsLimit(50)
                ->relationship('user', 'phone'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->limit(30)
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('code')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('amount')
                    ->searchable()
                    ->toggleable()
                    ->numeric()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('percentage')
                    ->searchable()
                    ->toggleable()
                    ->numeric()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('max_percentage_amount')
                    ->searchable()
                    ->toggleable()
                    ->numeric()
                    ->translateLabel(),
                CustomTimeColumn::make('expired_at')
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->translateLabel()
                    ->options(CouponTypeEnum::class),
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
            'index' => Pages\ListCoupons::route('/'),
            'create' => Pages\CreateCoupon::route('/create'),
            'edit' => Pages\EditCoupon::route('/{record}/edit'),
        ];
    }
}
