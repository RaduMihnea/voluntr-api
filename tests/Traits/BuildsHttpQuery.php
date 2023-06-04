<?php

namespace Tests\Traits;

use HttpApiQueryBuilder;

trait BuildsHttpQuery
{
    public function apiQuery(): HttpApiQueryBuilder
    {
        return new HttpApiQueryBuilder();
    }
}
