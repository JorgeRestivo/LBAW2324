<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Added to define Eloquent relationships.
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;

    // Don't add create and update timestamps in database.
    public $timestamps  = false;

    protected $table = 'events';

    protected $fillable = [
        'eventname',
        'startdatetime',
        'enddatetime',
        'registrationendtime',
        'local',
        'description',
        'capacity',
        'ispublic',
        'status',
        'tag_id',
        'photo',
        'owner_id',
    ];
}

