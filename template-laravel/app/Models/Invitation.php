<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $table = 'eventinvitation';
    protected $fillable = [
        'sentDate', 'event_id', 'user_invited_id', 'user_host_id', 'decision'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function invitedUser()
    {
        return $this->belongsTo(User::class, 'user_invited_id');
    }

    public function hostUser()
    {
        return $this->belongsTo(User::class, 'user_host_id');
    }

}
