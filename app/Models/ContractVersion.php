<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractVersion extends Model
{
    protected $fillable = [
        'deal_id',
        'version',
        'snapshot',
        'file_path',
        'hash',
        'status',
    ];

    protected $casts = [
        'snapshot' => 'array',
    ];

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
