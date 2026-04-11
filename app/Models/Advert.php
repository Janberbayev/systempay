<?php

namespace App\Models;

use App\Models\Concerns\HasPublicationRemainingDays;
use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    use HasPublicationRemainingDays;

    protected $fillable = [
        'user_id',
        'title',
        'content',
//        'is_approved',
        'moderation_status',
        'expires_at',
        'admin_comment',
        'region_id',
        'city_id',
        ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public const MOD_ADVERT_PENDING  = 'pending';
    public const MOD_ADVERT_APPROVED = 'approved';
    public const MOD_ADVERT_REJECTED = 'rejected';
    public const MOD_ADVERT_REVISION = 'revision';

    public static function statuses(): array
    {
        return [
            self::MOD_ADVERT_PENDING,
            self::MOD_ADVERT_APPROVED,
            self::MOD_ADVERT_REJECTED,
            self::MOD_ADVERT_REVISION,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusLabel(): array
    {
        return match ($this->moderation_status) {
            self::MOD_ADVERT_PENDING  => ['На проверке', 'secondary'],
            self::MOD_ADVERT_APPROVED => ['Одобрен', 'success'],
            self::MOD_ADVERT_REJECTED => ['Отклонён', 'danger'],
            self::MOD_ADVERT_REVISION => ['На доработку', 'warning'],
            default => ['Unknown', 'dark']
        };
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Computed publication status
    public function getPublicationStatusAttribute(): string
    {
        if ($this->moderation_status !== self::MOD_ADVERT_APPROVED) {
            return 'inactive';
        }

        if (!$this->expires_at) {
            return 'inactive';
        }

        if ($this->expires_at->isPast()) {
            return 'archived';
        }

        return 'active';
    }

    // Активировать на 10 дней
    public function publish(int $days = 10): void
    {
        $this->update([
            'moderation_status' => self::MOD_ADVERT_APPROVED,
            'expires_at' => now()->addDays($days),
        ]);
    }

    // Восстановить (продлить)
    public function extend(int $days = 10): void
    {
        $this->update([
            'expires_at' => now()->addDays($days),
        ]);
    }
}
