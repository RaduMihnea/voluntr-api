<?php

namespace Domain\Events\States;

use Domain\Events\Enums\EnrollmentStateEnum;

class Rejected extends EnrollmentState
{
    public static string $name = EnrollmentStateEnum::REJECTED;
}
