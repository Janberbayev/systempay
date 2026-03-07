<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'conversable_type',
        'conversable_id',
        'last_message_at'
    ];

    protected $casts = ['last_message_at' => 'datetime'];

    public function conversable()
    {
        return $this->morphTo();
    }

    public function participants()
    {
        return $this->belongsToMany(User::class, 'conversation_participants')
            ->withPivot('last_read_at')
            ->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

}
