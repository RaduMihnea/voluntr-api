<?php

namespace Database\State;

use Domain\Events\Models\Enrollment;
use Illuminate\Support\Facades\DB;

class EnsureEnrollmentsArePresent
{
    public function __invoke(): void
    {
        if ($this->present()) {
            return;
        }

        $enrollmentsJson = file_get_contents(database_path('state/data/enrollments.json'));
        $enrollments = json_decode($enrollmentsJson, true);

        DB::table('enrollments')->insert($enrollments);
    }

    public function present(): bool
    {
        return Enrollment::count() > 0;
    }
}
