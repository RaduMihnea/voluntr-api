<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\EnrollEventRequest;
use App\Http\Requests\Events\EnrollmentChangeStateRequest;
use Domain\Events\DTOs\EnrollmentData;
use Domain\Events\Enums\EnrollmentStateEnum;
use Domain\Events\Models\Enrollment;
use Domain\Events\Models\Event;
use Domain\Events\States\Approved;
use Domain\Events\States\Rejected;
use Illuminate\Http\JsonResponse;
use Spatie\ModelStates\Exceptions\TransitionNotAllowed;
use Spatie\ModelStates\Exceptions\TransitionNotFound;

class EnrollmentChangeStateController extends Controller
{
    public function __invoke(EnrollmentChangeStateRequest $request, Enrollment $enrollment): EnrollmentData|JsonResponse
    {
        try {
            $enrollment->state->transitionTo(match ($request->state) {
                EnrollmentStateEnum::APPROVED => Approved::class,
                EnrollmentStateEnum::REJECTED => Rejected::class,
            });

            return EnrollmentData::from($enrollment);
        } catch (TransitionNotFound $exception) {
            return $this->respondFailedValidation(__('validation.transition_not_allowed', [
                'from' => __("validation.attributes.state.$enrollment->state"),
                'to' => __("validation.attributes.state.$request->state"),
            ]));
        }
    }
}
