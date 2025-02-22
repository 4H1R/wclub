<?php

namespace App\Filament\Resources;

use App\Enums\PermissionEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\UserResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Role;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->when(Auth::user()->hasPermissionTo(PermissionEnum::ViewOwnedUsers), function (Builder $builder) {
                return $builder->where('id', Auth::id());
            });
    }

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
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
            Forms\Components\TextInput::make('score')
                ->translateLabel()
                ->integer()
                ->minValue(0)
                ->default(0)
                ->required(),
            Forms\Components\DateTimePicker::make('email_verified_at')
                ->jalali()
                ->translateLabel(),
            Forms\Components\DateTimePicker::make('phone_verified_at')
                ->jalali()
                ->translateLabel(),
            Forms\Components\DatePicker::make('birth_date')
                ->translateLabel()
                ->date()
                ->jalali()
                ->required(),
            Password::make('password')
                ->translateLabel()
                ->copyable()
                ->regeneratePassword()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->maxLength(16)
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'),
            Password::make('password_confirmation')
                ->translateLabel()
                ->dehydrated(false)
                ->requiredWith('password'),
            Forms\Components\Select::make('roles')
                ->searchable()
                ->multiple()
                ->visible(Auth::user()->hasPermissionTo(PermissionEnum::UpdateAnyRoles))
                ->notIn([Role::superAdmin()->id], ! Auth::user()->isSuperAdmin())
                ->label(trans_choice('Roles', 2))
                ->preload()
                ->optionsLimit(50)
                ->relationship('safeRoles', 'title'),
        ]);
    }

    /**
     * @throws \Exception
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
