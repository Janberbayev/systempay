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
        'status',
        'admin_comment',
        'region_id',
        'city_id',
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
        return match ($this->status) {
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
}
