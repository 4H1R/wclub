<?php

namespace App\Filament\Resources;

use App\Enums\Faq\FaqStatusEnum;
use App\Filament\Custom\CustomResource;
use App\Filament\Forms\Layouts\BasicSection;
use App\Filament\Forms\Layouts\ComplexForm;
use App\Filament\Forms\Layouts\StatusSection;
use App\Filament\Resources\FaqResource\Pages;
use App\Filament\Tables\Columns\TimestampsColumn;
use App\Models\EventProgram;
use App\Models\Faq;
use Filament\Forms;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Form;
use Filament\Tables;
use Filament\Tables\Table;

class FaqResource extends CustomResource
{
    protected static ?string $model = Faq::class;

    protected static string $translationLabel = 'Faqs';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationBadge(): ?string
    {
        return (string) static::getModel()::where('status', FaqStatusEnum::UnderReview)->count();
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
                ->required()
                ->types([
                    MorphToSelect\Type::make(EventProgram::class)
                        ->label(trans_choice('Event Programs', 1))
                        ->titleAttribute('title'),
                ]),
            Forms\Components\Select::make('user_id')
                ->searchable()
                ->columnSpanFull()
                ->label(trans_choice('Users', 1))
                ->preload()
                ->optionsLimit(50)
                ->relationship('user', 'phone')
                ->required(),
            Forms\Components\Textarea::make('question')
                ->translateLabel()
                ->columnSpanFull()
                ->required(),
            Forms\Components\Textarea::make('answer')
                ->translateLabel()
                ->columnSpanFull(),
        ]);

        $statusSection = StatusSection::make([
            Forms\Components\Select::make('status')
                ->translateLabel()
                ->searchable()
                ->options(FaqStatusEnum::class)
                ->required(),
        ]);

        return ComplexForm::make($form, [$basicSection], [$statusSection]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->translateLabel()
                    ->badge(),
                Tables\Columns\TextColumn::make('model_type')
                    ->label(__('Type'))
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            EventProgram::class => trans_choice('Event Programs', 1),
                            default => throw new \RuntimeException('This reportable type is not handled.')
                        };
                    }),
                Tables\Columns\TextColumn::make('user.phone')
                    ->label(trans_choice('Users', 1)),
                Tables\Columns\TextColumn::make('model_type')
                    ->label(trans_choice('Models', 1))
                    ->formatStateUsing(function (string $state) {
                        return match ($state) {
                            EventProgram::class => trans_choice('Event Programs', 1),
                            default => throw new \RuntimeException('This reportable type is not handled.')
                        };
                    }),
                Tables\Columns\TextColumn::make('question')
                    ->translateLabel()
                    ->limit(50)
                    ->searchable(),
                ...TimestampsColumn::make(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->translateLabel()
                    ->options(FaqStatusEnum::class),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('view_model')
                    ->icon('heroicon-o-eye')
                    ->openUrlInNewTab()
                    ->translateLabel()
                    ->url(function (Faq $faq): string {
                        $resource = match ($faq->model_type) {
                            EventProgram::class => 'event-programs',
                            default => throw new \RuntimeException('This reportable type is not handled.')
                        };

                        return route("filament.admin.resources.$resource.edit", $faq->model_id);
                    }),
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
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }
}
