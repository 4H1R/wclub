<?php

namespace App\Filament\Resources;

use App\Enums\QuestionForm\QuestionFormTypeEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicForm;
use App\Filament\Resources\QuestionFormResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\QuestionForm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class QuestionFormResource extends CustomResource
{
    protected static ?string $model = QuestionForm::class;

    protected static string $translationLabel = 'Question Forms';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return BasicForm::make($form, [
            Forms\Components\TextInput::make('title')
                ->translateLabel()
                ->required()
                ->columnSpanFull()
                ->maxLength(255),
            Forms\Components\Repeater::make('questions')
                ->columnSpanFull()
                ->label(trans_choice('Questions', 2))
                ->collapsed()
                ->collapsible()
                ->required()
                ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                ->schema([
                    Forms\Components\Group::make()
                        ->columns(2)
                        ->schema([
                            Forms\Components\Hidden::make('id')
                                ->distinct()
                                ->default(fn () => Str::random(10)),
                            Forms\Components\TextInput::make('title')
                                ->translateLabel()
                                ->maxLength(255)
                                ->required(),
                            Forms\Components\Select::make('type')
                                ->translateLabel()
                                ->searchable()
                                ->options(QuestionFormTypeEnum::class)
                                ->required(),
                            Forms\Components\Textarea::make('description')
                                ->translateLabel()
                                ->columnSpanFull()
                                ->maxLength(255),
                            Forms\Components\Repeater::make('properties.options')
                                ->translateLabel()
                                ->columnSpanFull()
                                ->schema([
                                    Forms\Components\TextInput::make('label')
                                        ->translateLabel()
                                        ->maxLength(255)
                                        ->required(),
                                    Forms\Components\TextInput::make('value')
                                        ->translateLabel()
                                        ->maxLength(255)
                                        ->required(),
                                    Forms\Components\TextInput::make('score')
                                        ->integer()
                                        ->minValue(0)
                                        ->maxValue(5)
                                        ->translateLabel()
                                        ->required(),
                                ]),
                        ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable()
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
            'index' => Pages\ListQuestionForms::route('/'),
            'create' => Pages\CreateQuestionForm::route('/create'),
            'view' => Pages\ViewQuestionForm::route('/{record}'),
            'edit' => Pages\EditQuestionForm::route('/{record}/edit'),
        ];
    }
}
