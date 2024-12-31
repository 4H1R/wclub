<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\FileInput;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\GardenResource\Pages;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\ImageColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Garden;
use Dotswan\MapPicker\Fields\Map;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class GardenResource extends CustomResource
{
    protected static ?string $model = Garden::class;

    protected static string $translationLabel = 'Gardens';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Gardens', 2);
    }

    public static function form(Form $form): Form
    {
        $basicSection = BasicSection::make([
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            Forms\Components\TextInput::make('max_participants')
                ->translateLabel()
                ->columnSpanFull()
                ->minValue(0)
                ->integer()
                ->required(),
            Forms\Components\Textarea::make('address')
                ->translateLabel()
                ->columnSpanFull()
                ->maxlength(1024)
                ->required(),
            Forms\Components\MarkdownEditor::make('description')
                ->disableToolbarButtons(['attachFiles'])
                ->translateLabel()
                ->columnSpanFull()
                ->required(),
            Forms\Components\TextInput::make('longitude')
                ->translateLabel()
                ->readOnly()
                ->required(),
            Forms\Components\TextInput::make('latitude')
                ->translateLabel()
                ->readOnly()
                ->required(),
            Map::make('location')
                ->translateLabel()
                ->columnSpanFull()
                ->afterStateUpdated(function (Forms\Set $set, ?array $state): void {
                    $set('latitude', $state['lat']);
                    $set('longitude', $state['lng']);
                })
                ->afterStateHydrated(function ($state, $record, Forms\Set $set): void {
                    $set('location', ['lat' => $record?->latitude, 'lng' => $record?->longitude]);
                })
                ->extraStyles([
                    'min-height: 100vh',
                    'border-radius: 50px',
                ])
                ->liveLocation()
                ->showMarker()
                ->markerColor('#e11d48')
                ->showFullscreenControl()
                ->showZoomControl()
                ->draggable()
                ->tilesUrl('https://tile.openstreetmap.de/{z}/{x}/{y}.png')
                ->zoom(15)
                ->detectRetina()
                ->showMyLocationButton()
                ->extraTileControl([])
                ->extraControl([
                    'zoomDelta' => 1,
                    'zoomSnap' => 2,
                ]),
            FileInput::make($form, 'images', visibility: 'public')
                ->image()
                ->imageEditor()
                ->reorderable()
                ->multiple()
                ->maxFiles(10)
                ->required(),
        ]);

        $statusSection = StatusSection::make(includePublishedAt: true);

        return ComplexForm::make($form, [$basicSection], [$statusSection]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
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
            'index' => Pages\ListGardens::route('/'),
            'create' => Pages\CreateGarden::route('/create'),
            'edit' => Pages\EditGarden::route('/{record}/edit'),
        ];
    }
}
