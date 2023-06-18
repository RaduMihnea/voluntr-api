<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\EnrollEventRequest;
use App\Http\Requests\Events\EventEnrollmentsRequest;
use Domain\Events\DTOs\EnrollmentData;
use Domain\Events\DTOs\EventEnrollmentData;
use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Events\Models\Enrollment;
use Domain\Events\Models\Event;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class EventEnrollmentsController extends Controller
{
    public function __invoke(EventEnrollmentsRequest $request, Event $event): PaginatedDataCollection
    {
        $enrollments = $event->enrollments()
            ->where('state', '!=', EnrollmentStateEnum::REJECTED)
            ->with('volunteer')
            ->paginate();

        return EventEnrollmentData::collection($enrollments);
    }
}
