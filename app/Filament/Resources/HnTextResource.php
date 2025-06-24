<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\HnTextResource\Pages;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\HnText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class HnTextResource extends CustomResource
{
    protected static ?string $model = HnText::class;

    protected static string $translationLabel = 'Texts';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function getNavigationGroup(): ?string
    {
        return __('Hn');
    }

    public static function form(Form $form): Form
    {
        $basicSection = BasicSection::make([
            Forms\Components\Textarea::make('text')
                ->label(trans_choice('Texts', 1))
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            Forms\Components\TextInput::make('author')
                ->translateLabel()
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
        ]);

        $statusSection = StatusSection::make(includePublishedAt: true);

        return ComplexForm::make($form, [$basicSection], [$statusSection]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->sortable()
                    ->searchable()
                    ->limit(50)
                    ->label(trans_choice('Texts', 1)),
                Tables\Columns\TextColumn::make('author')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                CustomTimeColumn::make('published_at')
                    ->sortable()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListHnTexts::route('/'),
            'create' => Pages\CreateHnText::route('/create'),
            'view' => Pages\ViewHnText::route('/{record}'),
            'edit' => Pages\EditHnText::route('/{record}/edit'),
        ];
    }
}
