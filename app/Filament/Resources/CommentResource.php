<?php

namespace App\Filament\Resources;

use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Tables\Columns\CustomTimeColumn;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\Comment;
use App\Models\EventProgram;
use Filament\Forms;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class CommentResource extends CustomResource
{
    protected static ?string $model = Comment::class;

    protected static string $translationLabel = 'Comments';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::whereNull('published_at')->count();
    }

    public static function form(Form $form): Form
    {
        $basicSection = BasicSection::make([
            Forms\Components\MorphToSelect::make('model')
                ->label(trans_choice('Models', 1))
                ->columnSpanFull()
                ->searchable()
                ->preload()
                ->optionsLimit(50)
                ->types([
                    MorphToSelect\Type::make(EventProgram::class)
                        ->label(trans_choice('Event Programs', 1))
                        ->titleAttribute('title'),
                ]),
            Forms\Components\Select::make('parent_id')
                ->searchable()
                ->label(trans_choice('Comments', 1))
                ->preload()
                ->optionsLimit(50)
                ->relationship('parent', 'id'),
            Forms\Components\Select::make('user_id')
                ->searchable()
                ->label(trans_choice('Users', 1))
                ->preload()
                ->optionsLimit(50)
                ->relationship('user', 'phone')
                ->required(),
            Forms\Components\Textarea::make('body')
                ->translateLabel()
                ->columnSpanFull()
                ->required(),
        ]);

        $statusSection = StatusSection::make(includePublishedAt: true);

        return ComplexForm::make($form, [$basicSection], [$statusSection]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('model_type')
                    ->label(__('Type'))
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            EventProgram::class => trans_choice('Event Programs', 1),
                            default => throw new \RuntimeException('This reportable type is not handled.')
                        };
                    }),
                Tables\Columns\TextColumn::make('parent.id')
                    ->label(trans_choice('Comments', 1)),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label(trans_choice('Users', 1)),
                Tables\Columns\TextColumn::make('model_type')
                    ->label(trans_choice('Models', 1))
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            EventProgram::class => trans_choice('EventPrograms', 1),
                            default => throw new \RuntimeException('This reportable type is not handled.')
                        };
                    }),
                Tables\Columns\TextColumn::make('body')
                    ->translateLabel()
                    ->limit(50)
                    ->searchable(),
                CustomTimeColumn::make('published_at')
                    ->translateLabel(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view_model')
                    ->icon('heroicon-o-eye')
                    ->openUrlInNewTab()
                    ->translateLabel()
                    ->url(function (Comment $comment): string {
                        $resource = match ($comment->model_type) {
                            EventProgram::class => 'event-programs',
                            default => throw new \RuntimeException('This reportable type is not handled.')
                        };

                        return route("filament.admin.resources.$resource.edit", $comment->model_id);
                    }),
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
