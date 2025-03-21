<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\SeriesChapterResource\Pages;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\SeriesChapter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class SeriesChapterResource extends CustomResource
{
    protected static ?string $model = SeriesChapter::class;

    protected static string $translationLabel = 'Chapters';

    protected static ?string $navigationIcon = 'heroicon-o-circle-stack';

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
            Forms\Components\Select::make('series_id')
                ->label(trans_choice('Series', 1))
                ->searchable()
                ->columnSpanFull()
                ->hiddenOn([SeriesResource\RelationManagers\ChaptersRelationManager::class])
                ->preload()
                ->optionsLimit(50)
                ->relationship('series', 'title')
                ->required(),
        ]);

        $statusSection = StatusSection::make(includePublishedAt: true);

        return ComplexForm::make($form, [$basicSection], [$statusSection]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable(config('eloquent-sortable.order_column_name'))
            ->defaultSort(config('eloquent-sortable.order_column_name'))
            ->columns([
                Tables\Columns\TextColumn::make('series.title')
                    ->hiddenOn([SeriesResource\RelationManagers\ChaptersRelationManager::class])
                    ->label(trans_choice('Series', 1)),
                Tables\Columns\TextColumn::make('title')
                    ->translateLabel()
                    ->sortable()
                    ->searchable(),
                CustomTimeColumn::make('published_at')
                    ->sortable()
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('published_at')
                    ->nullable()
                    ->translateLabel(),
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
            'index' => Pages\ListSeriesChapters::route('/'),
            'create' => Pages\CreateSeriesChapter::route('/create'),
            'edit' => Pages\EditSeriesChapter::route('/{record}/edit'),
        ];
    }
}
