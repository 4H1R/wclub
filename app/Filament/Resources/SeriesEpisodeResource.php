<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\AparatVideoInput;
use App\Filament\Forms\Components\FileInput;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\SeriesEpisodeResource\Pages;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\SeriesEpisode;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SeriesEpisodeResource extends CustomResource
{
    protected static ?string $model = SeriesEpisode::class;

    protected static string $translationLabel = 'Episodes';

    protected static ?string $navigationIcon = 'heroicon-o-film';

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
                ->preload()
                ->reactive()
                ->optionsLimit(50)
                ->relationship('series', 'title')
                ->required(),
            Forms\Components\Select::make('chapter_id')
                ->label(trans_choice('Chapters', 1))
                ->searchable()
                ->preload()
                ->visible(fn (Forms\Get $get) => $get('series_id'))
                ->optionsLimit(50)
                ->relationship('chapter', 'title', fn (Builder $query, Forms\Get $get) => $query->where('series_id', $get('series_id')))
                ->required(),
            Forms\Components\MarkdownEditor::make('description')
                ->disableToolbarButtons(['attachFiles'])
                ->translateLabel()
                ->columnSpanFull()
                ->maxLength(2024),
            Forms\Components\TextInput::make('video_duration_seconds')
                ->translateLabel()
                ->integer()
                ->minValue(0)
                ->required(),
            Forms\Components\TextInput::make('watch_score')
                ->translateLabel()
                ->integer()
                ->minValue(0)
                ->required(),
            FileInput::make($form, 'video')
                ->previewable(false)
                ->reorderable(false)
                ->helperText('لطفا فایل های بزرگ تر از ۵۰ مگابایت رو با روش دستی اپلود و با اضافه کردن ویدیو در بالا ان را وصل کنید')
                ->acceptedFileTypes(['video/mp4']),
            AparatVideoInput::make(),
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
                    ->hiddenOn([SeriesResource\RelationManagers\EpisodesRelationManager::class])
                    ->label(trans_choice('Series', 1)),
                Tables\Columns\TextColumn::make('chapter.title')
                    ->label(trans_choice('Chapters', 1)),
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
            'index' => Pages\ListSeriesEpisodes::route('/'),
            'create' => Pages\CreateSeriesEpisode::route('/create'),
            'edit' => Pages\EditSeriesEpisode::route('/{record}/edit'),
        ];
    }
}
