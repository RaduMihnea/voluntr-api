<?php

namespace Domain\Badges\Models;

use Database\Factories\BadgeFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Badge extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'badge_progress_slug',
        'required_completion_amount',
        'awarded_points',
    ];

    protected $appends = [
        'progress',
        'is_completed',
    ];

    public $timestamps = false;

    protected static function newFactory(): BadgeFactory
    {
        return BadgeFactory::new();
    }

    public function progress(): Attribute
    {
        return Attribute::make(
            get: fn () => min($this->badgeProgress?->progress ?? 0, $this->required_completion_amount),
        );
    }

    public function isCompleted(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->badgeProgress?->progress ?? 0 > $this->required_completion_amount,
        );
    }

    public function badgeProgress(): HasOne
    {
        return $this->hasOne(BadgeProgress::class, 'slug', 'badge_progress_slug')
            ->where('volunteer_id', auth()->user()->id);
    }
}
