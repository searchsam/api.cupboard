<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, HasOne, HasMany};

class Order extends Model
{
    /**
     * order status
     *
     * @var int
     */
    const COMPLETED = 0;
    const ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'name', 'status', 'deadline', 'user_id'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    /**
     * @return HasOne
     */
    public function pantry(): HasOne
    {
        return $this->hasOne(Pantry::class);
    }
}
