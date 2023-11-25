<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    public $timestamps  = false;

    /**
     * Get the card where the item is included.
     */
    public function card(): BelongsTo
    {
        return $this->belongsTo(Card::class);
    }
}
