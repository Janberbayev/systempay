<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
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

    public const MOD_PROJECT_PENDING  = 'pending';
    public const MOD_PROJECT_APPROVED = 'approved';
    public const MOD_PROJECT_REJECTED = 'rejected';
    public const MOD_PROJECT_REVISION = 'revision';

    public static function statuses(): array
    {
        return [
            self::MOD_PROJECT_PENDING,
            self::MOD_PROJECT_APPROVED,
            self::MOD_PROJECT_REJECTED,
            self::MOD_PROJECT_REVISION,
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function statusLabel(): array
    {
        return match ($this->moderation_status) {
            self::MOD_PROJECT_PENDING  => ['На проверке', 'secondary'],
            self::MOD_PROJECT_APPROVED => ['Одобрен', 'success'],
            self::MOD_PROJECT_REJECTED => ['Отклонён', 'danger'],
            self::MOD_PROJECT_REVISION => ['На доработку', 'warning'],
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
        if ($this->moderation_status !== self::MOD_PROJECT_APPROVED) {
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
            'moderation_status' => self::MOD_PROJECT_APPROVED,
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
