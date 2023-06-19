<?php

namespace Domain\Badges\Queries;

use App\Http\Requests\Badges\IndexBadgeRequest;
use Domain\Badges\Models\Badge;
use Spatie\QueryBuilder\QueryBuilder;

class IndexBadgeQuery extends QueryBuilder
{
    public function __construct(IndexBadgeRequest $request)
    {
        $query = Badge::query();

        parent::__construct($query, $request);

        return $this;
    }
}
