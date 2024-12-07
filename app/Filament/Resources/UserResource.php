<?php

namespace App\Filament\Resources;

use App\Enums\User\UserTypeEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\FileInput;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Rawilk\FilamentPasswordInput\Password;

class UserResource extends CustomResource
{
    protected static ?string $model = User::class;

    protected static string $translationLabel = 'Users';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Users', 2);
    }

    public static function form(Form $form): Form
    {
        $basicSection = BasicSection::make([
            Forms\Components\TextInput::make('first_name')
                ->translateLabel()
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('last_name')
                ->translateLabel()
                ->required()
                ->maxLength(100),
            Forms\Components\TextInput::make('email')
                ->translateLabel()
                ->email()
                ->maxLength(255),
            Forms\Components\TextInput::make('phone')
                ->translateLabel()
                ->regex('/^[0][9][0-9]{9,9}$/')
                ->required(),
            Forms\Components\DateTimePicker::make('email_verified_at')
                ->translateLabel(),
            Forms\Components\DateTimePicker::make('phone_verified_at')
                ->translateLabel(),
            Password::make('password')
                ->translateLabel()
                ->copyable()
                ->regeneratePassword()
                ->dehydrateStateUsing(fn($state) => Hash::make($state))
                ->maxLength(16)
                ->dehydrated(fn($state) => filled($state))
                ->required(fn(string $context): bool => $context === 'create'),
            Password::make('password_confirmation')
                ->translateLabel()
                ->dehydrated(false)
                ->requiredWith('password'),
            FileInput::make($form, 'image', visibility: 'public')
                ->image()
                ->imageEditor(),
            FileInput::make($form, 'banner', visibility: 'public')
                ->image()
                ->imageEditor(),
        ]);

        $seriesLibraries = BasicSection::make([
            Forms\Components\Select::make('owned_series')
                ->label(trans_choice('Series', 2))
                ->searchable()
                ->preload()
                ->columnSpanFull()
                ->multiple()
                ->optionsLimit(50)
                ->relationship(name: 'ownedSeries', titleAttribute: 'title', modifyQueryUsing: function (Builder $query) {
                    return $query->select('series.id', 'series.title')->distinct();
                }),
        ]);

        $statusSection = StatusSection::make([
            Forms\Components\Toggle::make('is_admin')
                ->translateLabel(),
        ]);

        return ComplexForm::make($form, [$basicSection, $seriesLibraries], [$statusSection]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('is_admin')
                    ->translateLabel()
                    ->boolean(),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('first_name')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('last_name')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('phone')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_admin')
                    ->translateLabel(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
