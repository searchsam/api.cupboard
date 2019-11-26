<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Request extends Model
{
    /**
     * request status
     *
     * @var int
     */
    const REJECT = 0;
    const APPROVE = 1;
    const WAITING = 2;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'user_id', 'order_id', 'description', 'quantity', 'status'
    ];

    /**
     * {@inheritdoc}
     */
    public function scopeApproved($query)
    {
        return $query->where('status', Request::APPROVE);
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
