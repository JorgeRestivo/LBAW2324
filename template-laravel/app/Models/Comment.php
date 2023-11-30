<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'content',
        'owner_id',
        'event_id',
        'dateTime',
    ];

    // Define the owner relationship
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Define the event relationship
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}
