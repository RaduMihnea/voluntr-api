<?php

namespace Domain\Events\States;

use Domain\Events\Enums\EnrollmentStateEnum;

class Pending extends EnrollmentState
{
    public static string $name = EnrollmentStateEnum::PENDING;
}
