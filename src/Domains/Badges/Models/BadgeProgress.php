<?php

namespace Domain\Badges\Models;

use Database\Factories\EventTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BadgeProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'volunteer_id',
        'progress',
    ];

    protected static function newFactory(): EventTypeFactory
    {
        return EventTypeFactory::new();
    }

    public function badges(): HasMany
    {
        return $this->hasMany(Badge::class, 'badge_progress_slug', 'slug');
    }
}
