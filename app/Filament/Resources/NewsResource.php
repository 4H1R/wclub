<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\FileInput;
use App\Filament\Forms\Components\TopicsSelect;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\ImageColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class NewsResource extends CustomResource
{
    protected static ?string $model = News::class;

    protected static string $translationLabel = 'News';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('News', 2);
    }

    public static function form(Form $form): Form
    {
        $basicSection = BasicSection::make([
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            Forms\Components\Textarea::make('short_description')
                ->translateLabel()
                ->columnSpanFull()
                ->maxLength(255)
                ->required(),
            Forms\Components\MarkdownEditor::make('description')
                ->disableToolbarButtons(['attachFiles'])
                ->translateLabel()
                ->columnSpanFull()
                ->required(),
            Forms\Components\Select::make('categories')
                ->label(trans_choice('Categories', 2))
                ->searchable()
                ->preload()
                ->multiple()
                ->optionsLimit(50)
                ->relationship('categories', 'title')
                ->required(),
            Forms\Components\Select::make('target_groups')
                ->label(trans_choice('Target Groups', 2))
                ->searchable()
                ->preload()
                ->multiple()
                ->optionsLimit(50)
                ->relationship('targetGroups', 'title'),
            TopicsSelect::make(),
            FileInput::make($form, 'image', visibility: 'public')
                ->image()
                ->imageEditor()
                ->required(),
            FileInput::make($form, 'video', visibility: 'public')
                ->acceptedFileTypes(['video/*']),
        ]);

        $statusSection = StatusSection::make(includePublishedAt: true);

        return ComplexForm::make($form, [$basicSection], [$statusSection]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image', 'public'),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('min_participants')
                    ->sortable()
                    ->badge()
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->translateLabel(),
                Tables\Columns\TextColumn::make('max_participants')
                    ->sortable()
                    ->badge()
                    ->toggleable()
                    ->toggledHiddenByDefault()
                    ->translateLabel(),
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
