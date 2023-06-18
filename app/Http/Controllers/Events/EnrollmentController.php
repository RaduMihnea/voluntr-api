<?php

namespace App\Http\Controllers\Events;

use App\Http\Controllers\Controller;
use App\Http\Requests\Events\DestroyEnrollmentRequest;
use App\Http\Requests\Events\IndexEnrollmentRequest;
use App\Http\Requests\Events\StoreEnrollmentRequest;
use Domain\Events\DTOs\EnrollmentCreateData;
use Domain\Events\DTOs\VolunteerEnrollmentData;
use Domain\Events\Models\Enrollment;
use Domain\Events\Queries\IndexEnrollmentQuery;
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
