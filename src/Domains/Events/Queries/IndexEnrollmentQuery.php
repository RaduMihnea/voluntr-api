<?php

namespace Domain\Events\Queries;

use App\Http\Requests\Events\IndexEnrollmentRequest;
use Domain\Events\Models\Enrollment;
use Spatie\QueryBuilder\QueryBuilder;

class IndexEnrollmentQuery extends QueryBuilder
{
    public function __construct(IndexEnrollmentRequest $request)
    {
        $query = Enrollment::query()
            ->with(['event', 'event.eventTypes', 'event.organization'])
            ->where('volunteer_id', auth()->user()->id);

        parent::__construct($query, $request);

        return $this->defaultSort('-created_at');
    }
}
