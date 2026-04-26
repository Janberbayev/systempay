<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealItem extends Model
{
    protected $fillable = [
        'deal_id',
        'title',
        'qty',
        'price',
    ];
}
