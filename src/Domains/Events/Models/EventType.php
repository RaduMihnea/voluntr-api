<?php

namespace Domain\Events\Models;

use Database\Factories\EventTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class EventType extends Model
{
    use HasFactory;

    protected $fillable = [
        'translation_slug',
        'color',
    ];

    public $timestamps = false;

    protected static function newFactory(): EventTypeFactory
    {
        return EventTypeFactory::new();
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
