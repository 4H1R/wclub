<?php

namespace App\Filament\Forms\Components;

use CodeWithDennis\FilamentSelectTree\SelectTree;

class TopicsSelect
{
    public static function make(): SelectTree
    {
        return SelectTree::make('topics')
            ->label(trans_choice('Topics', 2))
            ->columnSpanFull()
            ->relationship('topics', 'title', 'parent_id');
    }
}
