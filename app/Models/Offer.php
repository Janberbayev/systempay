<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = [
        'user_id',
        'price',
        'duration',
        'comments',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
