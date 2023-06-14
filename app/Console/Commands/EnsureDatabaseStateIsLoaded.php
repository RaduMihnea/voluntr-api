<?php

namespace App\Console\Commands;

use Database\State\EnsureCitiesArePresent;
use Database\State\EnsureCountriesArePresent;
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
        ])->each->__invoke();
    }
}
