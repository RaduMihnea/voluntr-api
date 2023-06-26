<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\EnrollEventRequest;
use Domain\Badges\Enums\BadgeProgressSlugsEnum;
use Domain\Events\DTOs\EnrollmentData;
use Domain\Events\Models\Enrollment;
use Domain\Events\Models\Event;
use Domain\Events\Notifications\NewEnrollmentNotification;
use Illuminate\Http\JsonResponse;

class EventEnrollController extends Controller
{
    public function __invoke(EnrollEventRequest $request, Event $event): EnrollmentData|JsonResponse
    {
        if ($event->minimum_participant_age > auth()->user()->age) {
            return $this->respondFailedValidation(__('validation.too_young', [
                'age' => $event->minimum_participant_age,
            ]));
        }

        if ($event->is_full) {
            return $this->respondFailedValidation(__('validation.event_full'));
        }

        if ($event->hasEnrollment(auth()->user()->id)) {
            return $this->respondFailedValidation(__('validation.already_enrolled'));
        }

        $enrollment = Enrollment::create([
            'volunteer_id' => auth()->user()->id,
            'event_id' => $event->id,
        ]);

        $event->organization->notify(new NewEnrollmentNotification(
            eventName: $event->name,
            eventSlug: $event->slug,
        ));

        auth()->user()->registerBadgeProgress(BadgeProgressSlugsEnum::ENROLLMENT);

        return EnrollmentData::from($enrollment);
    }
}
