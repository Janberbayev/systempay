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
        'sent_to_contractor_at',
    ];

    protected $casts = [
        'snapshot' => 'array',
        'sent_to_contractor_at' => 'datetime',
    ];

    public function deal()
    {
        return $this->belongsTo(Deal::class);
    }
}
