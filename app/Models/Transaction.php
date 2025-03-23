<?php

namespace App\Models;

use App\Enums\Transaction\TransactionGatewayNameEnum;
use App\Enums\Transaction\TransactionStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperTransaction
 */
class Transaction extends Model
{
    /** @use HasFactory<\Database\Factories\TransactionFactory> */
    use HasFactory;

    protected $casts = [
        'status' => TransactionStatusEnum::class,
        'gateway_name' => TransactionGatewayNameEnum::class,
    ];

    /**
     * @return BelongsTo<User,$this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo<Order,$this>
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
