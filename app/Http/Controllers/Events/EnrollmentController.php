<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\DeleteEventRequest;
use App\Http\Requests\Events\DestroyEnrollmentRequest;
use App\Http\Requests\Events\IndexEnrollmentRequest;
use App\Http\Requests\Events\IndexEventRequest;
use App\Http\Requests\Events\StoreEnrollmentRequest;
use App\Http\Requests\Events\StoreEventRequest;
use App\Http\Requests\Events\UpdateEventRequest;
use Domain\Events\Actions\CreateEventAction;
use Domain\Events\Actions\UpdateEventAction;
use Domain\Events\DTOs\EnrollmentCreateData;
use Domain\Events\DTOs\EventCreateData;
use Domain\Events\DTOs\EventData;
use Domain\Events\DTOs\VolunteerEnrollmentData;
use Domain\Events\Models\Enrollment;
use Domain\Events\Models\Event;
use Domain\Events\Queries\IndexEnrollmentQuery;
use Domain\Events\Queries\IndexEventQuery;
use Illuminate\Http\JsonResponse;
use Spatie\LaravelData\PaginatedDataCollection;

class EnrollmentController extends Controller
{
    public function index(IndexEnrollmentRequest $request): PaginatedDataCollection
    {
        $query = new IndexEnrollmentQuery($request);

        return VolunteerEnrollmentData::collection($query->paginate());
    }

    public function store(StoreEnrollmentRequest $request): VolunteerEnrollmentData
    {
        $enrollment = Enrollment::create(EnrollmentCreateData::from($request->validated())->toArray());

        return VolunteerEnrollmentData::from($enrollment);
    }

    public function destroy(DestroyEnrollmentRequest $request, Enrollment $enrollment): JsonResponse
    {
        $enrollment->delete();

        return $this->respondNoContent();
    }
}
