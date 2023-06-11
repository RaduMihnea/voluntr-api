<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Tests\TestCase;
use Tests\Traits\BuildsHttpQuery;

abstract class ApiTest extends TestCase
{
    use DatabaseTransactions;
    use DatabaseMigrations;
    use BuildsHttpQuery;

    protected string $baseEndpoint = '/api/v1';

    protected ?string $resource = null;

    protected ?string $parentResource = null;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(ThrottleRequests::class);
    }

    protected function getEndpoint($parentId = null, $id = null, string $query = ''): string
    {
        $endpoint = $this->baseEndpoint;

        if (! $this->parentResource) {
            $id = $parentId;
        }

        if ($this->parentResource) {
            $endpoint .= '/'.$this->parentResource.'/'.$parentId;
        }

        $endpoint .= '/'.$this->resource;

        if ($id) {
            $endpoint .= '/'.$id;
        }

        $endpoint .= empty($query) ? '' : '?'.$query;

        return $endpoint;
    }

    protected function getIndexEndpoint(string $query = ''): string
    {
        return $this->getEndpoint(null, null, $query);
    }

    protected function getShallowEndpoint($id = null): string
    {
        $endpoint = $this->baseEndpoint;

        $endpoint .= '/'.$this->resource;

        if ($id) {
            $endpoint .= '/'.$id;
        }

        return $endpoint;
    }
}
