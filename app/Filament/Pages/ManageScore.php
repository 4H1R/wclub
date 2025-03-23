<?php

namespace App\Filament\Pages;

use App\Filament\Forms\Components\MoneyInput;
use App\Filament\Forms\Layouts\BasicForm;
use App\Settings\ScoreSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageScore extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = ScoreSettings::class;

    public function getTitle(): string
    {
        return __('Manage score');
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['score_to_coupon_logic'] = collect($data['score_to_coupon_logic'])
            ->sortByDesc(fn ($item) => $item['score_amount'])
            ->values()
            ->toArray();

        return $data;
    }

    public function afterSave(): void
    {
        $this->fillForm();
    }

    public static function getNavigationGroup(): ?string
    {
        return __('Settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('Manage score');
    }

    public function form(Form $form): Form
    {
        return BasicForm::make($form, [
            Forms\Components\Repeater::make('score_to_coupon_logic')
                ->label('تبدیل امتیاز به کد تخفیف')
                ->required()
                ->reorderable(false)
                ->columnSpanFull()
                ->columns(2)
                ->schema([
                    MoneyInput::make('score_amount')->suffix(''),
                    MoneyInput::make('coupon_amount'),
                ]),
        ]);
    }
}
