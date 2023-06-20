<?php

namespace App\Http\Controllers\Badges;

use App\Http\Controllers\Controller;
use App\Http\Requests\Badges\IndexBadgeRequest;
use Domain\Badges\DTOs\BadgeData;
use Domain\Badges\Models\Badge;
use Domain\Badges\Queries\IndexBadgeQuery;
use Spatie\LaravelData\DataCollection;

class BadgeController extends Controller
{
    public function index(IndexBadgeRequest $request): DataCollection
    {
        $query = new IndexBadgeQuery($request);

        return BadgeData::collection($query->get());
    }
}

