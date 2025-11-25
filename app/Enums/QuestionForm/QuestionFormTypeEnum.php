<?php

namespace App\Enums\QuestionForm;

use EmreYarligan\EnumConcern\EnumConcern;
use Filament\Support\Contracts\HasLabel;

enum QuestionFormTypeEnum: string implements HasLabel
{
    use EnumConcern;

    case SingleChoice = 'SINGLE_CHOICE';

    public function getLabel(): string
    {
        return match ($this) {
            self::SingleChoice => 'یک گزینه',
        };
    }
}
