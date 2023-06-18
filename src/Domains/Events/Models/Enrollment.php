<?php

namespace Domain\Events\Models;

use Database\Factories\EnrollmentFactory;
use Domain\Events\States\EnrollmentState;
use Domain\Volunteer\Models\Volunteer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\ModelStates\HasStates;

class Enrollment extends Model
{
    use HasFactory;
    use HasStates;

    protected $fillable = [
        'volunteer_id',
        'event_id',
        'state',
        'event_name',
        'event_description',
        'event_type_id',
        'event_date',
    ];

    protected $casts = [
        'state' => EnrollmentState::class,
    ];

    protected static function newFactory(): EnrollmentFactory
    {
        return EnrollmentFactory::new();
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }

    public function volunteer(): BelongsTo
    {
        return $this->belongsTo(Volunteer::class);
    }
}
