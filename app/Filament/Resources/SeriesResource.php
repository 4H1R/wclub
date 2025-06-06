<?php

namespace App\Filament\Resources;

use App\Enums\PaymentTypeEnum;
use App\Enums\Series\SeriesPresentationModeEnum;
use App\Enums\Series\SeriesStatusEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\FileInput;
use App\Filament\Forms\Components\MoneyInput;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\SeriesResource\Pages;
use App\Filament\Resources\SeriesResource\RelationManagers;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\ImageColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Series;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class SeriesResource extends CustomResource
{
    protected static ?string $model = Series::class;

    protected static string $translationLabel = 'Series';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Series', 2);
    }

    public static function form(Form $form): Form
    {
        $basicSection = BasicSection::make([
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->columnSpanFull()
                ->maxLength(255)
                ->required(),
            Forms\Components\Select::make('status')
                ->translateLabel()
                ->searchable()
                ->options(SeriesStatusEnum::class)
                ->required(),
            Forms\Components\Select::make('payment_type')
                ->translateLabel()
                ->searchable()
                ->reactive()
                ->options(PaymentTypeEnum::class)
                ->required(),
            Forms\Components\Group::make()
                ->columnSpanFull()
                ->visible(fn (Forms\Get $get) => PaymentTypeEnum::tryFrom($get('payment_type')) === PaymentTypeEnum::Paid)
                ->columns(2)
                ->schema([
                    MoneyInput::make('price'),
                    MoneyInput::make('previous_price')
                        ->gt('price')
                        ->required(false),
                ]),
            Forms\Components\Select::make('presentation_mode')
                ->translateLabel()
                ->searchable()
                ->reactive()
                ->options(SeriesPresentationModeEnum::class)
                ->required(),
            FileInput::make($form, 'image', visibility: 'public')
                ->image()
                ->imageEditor()
                ->required(),
        ]);

        $textSection = BasicSection::make([
            Forms\Components\Textarea::make('short_description')
                ->translateLabel()
                ->columnSpanFull()
                ->maxLength(255)
                ->required(),
            Forms\Components\MarkdownEditor::make('description')
                ->translateLabel()
                ->columnSpanFull()
                ->disableToolbarButtons(['attachFiles'])
                ->maxLength(5012)
                ->required(),
            Forms\Components\Repeater::make('faqs_array')
                ->translateLabel()
                ->columnSpanFull()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->translateLabel()
                        ->maxLength(255)
                        ->required(),
                    Forms\Components\Textarea::make('description')
                        ->translateLabel()
                        ->maxLength(1024)
                        ->required(),
                ]),
        ]);

        $statusSection = StatusSection::make(includePublishedAt: true);

        return ComplexForm::make($form, [$basicSection, $textSection], [$statusSection]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                    ->translateLabel()
                    ->sortable()
                    ->limit(30)
                    ->searchable(),
                Tables\Columns\TextColumn::make('presentation_mode')
                    ->translateLabel()
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->translateLabel()
                    ->badge(),
                Tables\Columns\TextColumn::make('payment_type')
                    ->translateLabel()
                    ->badge(),
                CustomTimeColumn::make('published_at')
                    ->sortable()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('published_at')
                    ->nullable()
                    ->translateLabel(),
                Tables\Filters\SelectFilter::make('payment_type')
                    ->translateLabel()
                    ->options(PaymentTypeEnum::class),
                Tables\Filters\SelectFilter::make('presentation_mode')
                    ->translateLabel()
                    ->options(SeriesPresentationModeEnum::class),
                Tables\Filters\SelectFilter::make('status')
                    ->translateLabel()
                    ->options(SeriesStatusEnum::class),
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
            RelationManagers\ChaptersRelationManager::class,
            RelationManagers\EpisodesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeries::route('/'),
            'create' => Pages\CreateSeries::route('/create'),
            'edit' => Pages\EditSeries::route('/{record}/edit'),
        ];
    }
}
