<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    public const STATUS_PENDING = 'pending';

    public const STATUS_CONTRACT_REVIEW = 'contract_review';

    public const STATUS_CONTRACT_SIGNED = 'contract_signed';

    public const STATUS_ESCROW_SETUP = 'escrow_setup';

    public const STATUS_IN_PROGRESS = 'in_progress';

    public const STATUS_ACTIVE = 'active';

    public const STATUS_COMPLETED = 'completed';

    public const STATUS_CANCELLED = 'cancelled';

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

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function getStatusTextAttribute()
    {
        if ($this->status === self::STATUS_CONTRACT_REVIEW) {
            if (auth()->id() === $this->client_id) {
                return 'Черновик договора сформирован, на согласовании';
            }

            if (auth()->id() === $this->contractor_id) {
                return 'Черновик договора от заказчика, требуется согласование';
            }
        }

        if (auth()->id() === $this->client_id) {
            return 'Запросили договор от потенциального исполнителя';
        }

        if (auth()->id() === $this->contractor_id) {
            return 'Заказчик запросил договор';
        }

        return 'Неизвестный статус';
    }

    public function contractVersions()
    {
        return $this->hasMany(ContractVersion::class);
    }

    public function items()
    {
        return $this->hasMany(DealItem::class);
    }
}
