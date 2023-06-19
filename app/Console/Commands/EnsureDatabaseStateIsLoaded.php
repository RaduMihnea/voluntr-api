<?php

namespace App\Console\Commands;

use Database\State\EnsureBadgesArePresent;
use Database\State\EnsureCitiesArePresent;
use Database\State\EnsureCountriesArePresent;
use Database\State\EnsureEnrollmentsArePresent;
use Database\State\EnsureEventMappingsArePresent;
use Database\State\EnsureEventsArePresent;
use Database\State\EnsureEventTypesArePresent;
use Database\State\EnsureOrganizationsArePresent;
use Database\State\EnsureVolunteersArePresent;
use Illuminate\Console\Command;

class EnsureDatabaseStateIsLoaded extends Command
{
    protected $signature = 'db:ensure-state';

    protected $description = 'Inserts static tables data.';

    public function handle()
    {
        collect([
            new EnsureCountriesArePresent(),
            new EnsureCitiesArePresent(),
            new EnsureEventTypesArePresent(),
            new EnsureBadgesArePresent(),
            new EnsureOrganizationsArePresent(),
            new EnsureEventsArePresent(),
            new EnsureEventMappingsArePresent(),
            new EnsureVolunteersArePresent(),
            new EnsureEnrollmentsArePresent(),
        ])->each->__invoke();
    }
}
