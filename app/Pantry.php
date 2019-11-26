<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pantry extends Model
{
    /**
     * pantry amount
     *
     * @var int
     */
    const SOLDOUT_STOCK = 0;
    const STOCK_UNIT = 1;

    /**
     * {@inheritdoc}
     */
    protected $fillable = [
        'existence', 'request_id'
    ];

    /**
     * @return BelongsTo
     */
    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }
}
