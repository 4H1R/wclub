<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\ContactUsResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\ContactUs;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class ContactUsResource extends CustomResource
{
    protected static ?string $model = ContactUs::class;

    protected static string $translationLabel = 'Contact Us';

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function getNavigationBadge(): ?string
    {
        return (string) ContactUs::whereColumn('created_at', 'updated_at')->count();
    }

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Users', 2);
    }

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
            Forms\Components\TextInput::make('full_name')
                ->maxLength(255)
                ->translateLabel()
                ->required(),
            Forms\Components\TextInput::make('title')
                ->maxLength(255)
                ->translateLabel()
                ->required(),
            Forms\Components\TextInput::make('email')
                ->email()
                ->maxLength(255)
                ->translateLabel()
                ->required(),
            Forms\Components\TextInput::make('phone')
                ->translateLabel()
                ->required(),
            Forms\Components\Textarea::make('description')
                ->required()
                ->minLength(3)
                ->rows(10)
                ->maxLength(2024)
                ->translateLabel()
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\IconColumn::make('is_read')
                    ->translateLabel()
                    ->boolean(),
                Tables\Columns\TextColumn::make('full_name')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('description')
                    ->searchable()
                    ->limit(50)
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactUs::route('/'),
            'create' => Pages\CreateContactUs::route('/create'),
            'view' => Pages\ViewContactUs::route('/{record}'),
        ];
    }
}
