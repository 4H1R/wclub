<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Resources\QuestionFormAnswerResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\QuestionFormAnswer;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class QuestionFormAnswerResource extends CustomResource
{
    protected static ?string $model = QuestionFormAnswer::class;

    protected static string $translationLabel = 'Question Form Answers';

    public static function getNavigationGroup(): ?string
    {
        return trans_choice('Question Forms', 2);
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.phone')
                    ->label(trans_choice('Users', 1)),
                Tables\Columns\TextColumn::make('questionForm.title')
                    ->label(trans_choice('Question Forms', 1)),
                Tables\Columns\TextColumn::make('score')
                    ->label(__('Score'))
                    ->sortable(),
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
            'index' => Pages\ListQuestionFormAnswers::route('/'),
            'create' => Pages\CreateQuestionFormAnswer::route('/create'),
            'view' => Pages\ViewQuestionFormAnswer::route('/{record}'),
            'edit' => Pages\EditQuestionFormAnswer::route('/{record}/edit'),
        ];
    }
}
