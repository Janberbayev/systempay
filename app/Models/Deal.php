<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    protected $fillable = [
        'project_id',
        'offer_id',
        'client_id',
        'contractor_id',
        'price',
        'duration',
        'status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
