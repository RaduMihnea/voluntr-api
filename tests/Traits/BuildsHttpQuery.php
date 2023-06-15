<?php

namespace Tests\Traits;

use Tests\HttpApiQueryBuilder;

trait BuildsHttpQuery
{
    public function apiQuery(): HttpApiQueryBuilder
    {
        return new HttpApiQueryBuilder();
    }
}
