<?php

namespace App\Filament\Resources;

use App\Enums\EventProgram\EventProgramStatusEnum;
use App\Enums\PaymentTypeEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Components\FileInput;
use App\Filament\Forms\Components\MoneyInput;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\EventProgramResource\Pages;
use App\Filament\Resources\EventProgramResource\RelationManagers;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\ImageColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\EventProgram;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class EventProgramResource extends CustomResource
{
    protected static ?string $model = EventProgram::class;

    protected static string $translationLabel = 'Event Programs';

    protected static ?string $navigationIcon = 'heroicon-o-bolt';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Event Programs', 2);
    }

    public static function form(Form $form): Form
    {
        $basicSection = BasicSection::make([
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            Forms\Components\Select::make('payment_type')
                ->translateLabel()
                ->searchable()
                ->reactive()
                ->options(PaymentTypeEnum::class)
                ->columnSpanFull()
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
            Forms\Components\TextInput::make('min_participants')
                ->translateLabel()
                ->minValue(0)
                ->integer(),
            Forms\Components\TextInput::make('max_participants')
                ->translateLabel()
                ->gt('min_participants')
                ->minValue(0)
                ->integer(),
            Forms\Components\MarkdownEditor::make('description')
                ->disableToolbarButtons(['attachFiles'])
                ->translateLabel()
                ->columnSpanFull()
                ->required(),
            Forms\Components\DateTimePicker::make('started_at')
                ->jalali()
                ->required()
                ->translateLabel(),
            Forms\Components\DateTimePicker::make('finished_at')
                ->jalali()
                ->after('started_at')
                ->required()
                ->translateLabel(),
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
            Forms\Components\Textarea::make('short_description')
                ->translateLabel()
                ->columnSpanFull()
                ->maxLength(255)
                ->required(),
            FileInput::make($form, 'image', visibility: 'public')
                ->image()
                ->imageEditor()
                ->required(),
        ]);

        $statusSection = StatusSection::make([
            Forms\Components\Select::make('status')
                ->translateLabel()
                ->options(EventProgramStatusEnum::class)
                ->required(),
        ], includePublishedAt: true);

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
                Tables\Columns\TextColumn::make('status')
                    ->translateLabel()
                    ->badge(),
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
                CustomTimeColumn::make('started_at')
                    ->sortable()
                    ->translateLabel(),
                CustomTimeColumn::make('finished_at')
                    ->sortable()
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
                Tables\Filters\SelectFilter::make('status')
                    ->options(EventProgramStatusEnum::class)
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
            RelationManagers\FaqsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEventPrograms::route('/'),
            'create' => Pages\CreateEventProgram::route('/create'),
            'edit' => Pages\EditEventProgram::route('/{record}/edit'),
        ];
    }
}
