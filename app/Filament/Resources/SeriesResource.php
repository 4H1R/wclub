<?php

namespace App\Filament\Resources;

use App\Enums\Series\SeriesStatusEnum;
use App\Enums\Series\SeriesTypeEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\FileInput;
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
            Forms\Components\Select::make('type')
                ->translateLabel()
                ->searchable()
                ->reactive()
                ->options(SeriesTypeEnum::class)
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
            Forms\Components\Repeater::make('faqs')
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
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->translateLabel()
                    ->badge(),
                Tables\Columns\TextColumn::make('type')
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
                Tables\Filters\SelectFilter::make('type')
                    ->translateLabel()
                    ->options(SeriesTypeEnum::class),
                Tables\Filters\SelectFilter::make('status')
                    ->translateLabel()
                    ->options(SeriesStatusEnum::class),
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
