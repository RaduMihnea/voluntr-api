<?php

namespace Domain\Events\Queries;

use App\Http\Requests\Events\IndexEventRequest;
use Arr;
use Domain\Events\Models\Event;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class IndexEventQuery extends QueryBuilder
{
    public function __construct(IndexEventRequest $request)
    {
        $query = Event::query()
            ->whereHas('organization', function ($query) {
                $query->whereHas('city', function ($query) {
                    $query->where('country_id', auth()->user()->city->country_id);
                });
            });

        parent::__construct($query, $request);

        return $this
            ->allowedFilters([
                AllowedFilter::callback('date_between', function ($query, $value) {
                    $query->whereBetween('starts_at', $value)->whereBetween('ends_at', $value);
                }),
                AllowedFilter::callback('event_type', function ($query, $value) {
                    $query->whereHas('eventTypes', function ($query) use ($value) {
                        $query->whereIn('event_types.id', Arr::wrap($value));
                    });
                }),
                AllowedFilter::callback('min_age', function ($query, $value) {
                    $query->where('minimum_participant_age', '>=', $value);
                }),
                AllowedFilter::exact('organization_id'),
            ])
            ->allowedIncludes(['organization', 'eventTypes', 'enrollments'])
            ->defaultSort('-starts_at');
    }
}
