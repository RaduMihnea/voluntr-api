<?php

namespace Domain\Events\States;

use Domain\Events\Enums\EnrollmentStateEnum;

class Approved extends EnrollmentState
{
    public static string $name = EnrollmentStateEnum::APPROVED;
}
