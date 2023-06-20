<?php

namespace Domain\Badges\Models;

use Database\Factories\BadgeProgressFactory;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BadgeProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'volunteer_id',
        'progress',
    ];

    protected static function newFactory(): BadgeProgressFactory
    {
        return BadgeProgressFactory::new();
    }

    public function badges(): HasMany
    {
        return $this->hasMany(Badge::class, 'badge_progress_slug', 'slug');
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(Volunteer::class);
    }
}
