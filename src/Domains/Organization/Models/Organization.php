<?php

namespace Domain\Organization\Models;

use Database\Factories\OrganizationFactory;
use Domain\Volunteer\DTOs\VolunteerData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\LaravelData\WithData;

class Organization extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use WithData;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected string $dataClass = VolunteerData::class;

    protected static function newFactory(): OrganizationFactory
    {
        return OrganizationFactory::new();
    }
}
