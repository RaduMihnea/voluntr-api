<?php

namespace Domain\Volunteer\Models;

use Database\Factories\VolunteerFactory;
use Domain\Regions\Models\City;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Support\Traits\Encryptable;

class Volunteer extends Authenticatable implements HasMedia
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use InteractsWithMedia;
    use Encryptable;

    protected $fillable = [
        'first_name',
        'last_name',
        'slug',
        'email',
        'password',
        'phone',
        'birthday',
        'city_id',
        'summary',
        'description',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'birthday' => 'date',
    ];

    protected array $encryptable = [
        'phone',
        'summary',
        'description',
    ];

    protected static function newFactory(): VolunteerFactory
    {
        return VolunteerFactory::new();
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')->singleFile();
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CROP, 300, 300)
            ->nonQueued();
    }

    public function avatar(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->getFirstMediaUrl('avatar')
        );
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}"
        );
    }

    public function age(): Attribute
    {
        return Attribute::make(
            get: fn () => now()->diffInYears($this->birthday)
        );
    }

    public function reputationLevel(): Attribute
    {
        return Attribute::make(
            get: fn () => 0
        );
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
