<?php

namespace Domain\Volunteer\DTOs;

use DB;
use Domain\Badges\DTOs\BadgeData;
use Domain\Events\DTOs\VolunteerEnrollmentData;
use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Volunteer\Models\Volunteer;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MapName(SnakeCaseMapper::class)]
class VolunteerPublicProfileData extends Data
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $avatar,
        public int $age,
        public string $summary,
        public string $description,
        public string $reputationLevel,
        public string $city,
        public string $country,
        #[DataCollectionOf(BadgeData::class)]
        public DataCollection $badges,
        #[DataCollectionOf(VolunteerEnrollmentData::class)]
        public DataCollection $enrollments,
    ) {
    }

    public static function fromVolunteer(Volunteer $volunteer)
    {
        return new self(
            firstName: $volunteer->first_name,
            lastName: $volunteer->last_name,
            avatar: $volunteer->avatar,
            age: $volunteer->age,
            summary: $volunteer->summary,
            description: $volunteer->description,
            reputationLevel: $volunteer->reputation_level,
            city: $volunteer->city->name,
            country: $volunteer->city?->country->name,
            badges: BadgeData::collection(DB::table('badges')
                ->selectRaw(
                    'name,
                    icon,
                    required_completion_amount,
                    awarded_points,
                    coalesce(progress, 0) as progress',
                )
                ->leftJoin('badge_progress', 'badges.badge_progress_slug', '=', 'badge_progress.slug')
                ->where('badge_progress.volunteer_id', $volunteer->id)
                ->orWhereNull('badge_progress.volunteer_id')
                ->orderByDesc('badge_progress.progress')
                ->orderByDesc('awarded_points')
                ->limit(3)
                ->get()
                ->toArray()
            ),
            enrollments: VolunteerEnrollmentData::collection($volunteer->enrollments()
                ->where('state', EnrollmentStateEnum::APPROVED)
                ->orWhereNull('event_id')
                ->orderByDesc('created_at')
                ->limit(5)->get()
            )
        );
    }
}
