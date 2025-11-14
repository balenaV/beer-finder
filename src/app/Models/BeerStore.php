<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BeerStore extends Pivot
{
    protected $table = 'beer_store';

    protected $fillable = [
        'beer_id',
        'store_id',
        'price',
        'url',
        'promo_label',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'integer',
        ];
    }

    public function beer(): BelongsTo
    {
        return $this->belongsTo(Beer::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
