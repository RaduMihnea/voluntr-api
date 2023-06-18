<?php

namespace Domain\Events\Enums;

enum EnrollmentStateEnum: string
{
    const PENDING = 'pending';

    const APPROVED = 'approved';

    const REJECTED = 'rejected';
}
