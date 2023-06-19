<?php

namespace Domain\Events\Models;

use Database\Factories\EventFactory;
use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Organization\Models\Organization;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Event extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'starts_at',
        'ends_at',
        'organization_id',
        'required_volunteers_amount',
        'minimum_participant_age',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    protected $appends = [
        'is_full',
        'enrollments_count',
        'can_enroll'
    ];

    protected static function newFactory(): EventFactory
    {
        return EventFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('cover')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CONTAIN, 300, 170)
            ->nonQueued();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function cover(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('cover')
        );
    }

    public function isFull(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->approvedEnrollments()->count() >= $this->required_volunteers_amount
        );
    }

    public function canEnroll(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->enrollments()->where('volunteer_id', auth()->id())->doesntExist() && !$this->is_full,
        );
    }

    public function enrollmentsCount(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                'pending' => $this->enrollments()->where('state', EnrollmentStateEnum::PENDING)->count(),
                'approved' => $this->approvedEnrollments()->count(),
            ]
        );
    }

    public function eventTypes(): BelongsToMany
    {
        return $this->belongsToMany(EventType::class);
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }

    public function approvedEnrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class)
            ->where('state', EnrollmentStateEnum::APPROVED)
            ->limit(3)
            ->orderBy('created_at', 'desc');
    }

    public function hasEnrollment(int $volunteerId): bool
    {
        return $this->enrollments()->where('volunteer_id', $volunteerId)->exists();
    }
}
