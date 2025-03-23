<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Filament\Custom\CustomRelationManager;
use App\Filament\Resources\TransactionResource;

class TransactionsRelationManager extends CustomRelationManager
{
    protected static string $relationship = 'transactions';

    protected static ?string $resource = TransactionResource::class;
}
