<?php

namespace Domain\Events\States;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class EnrollmentState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
            ->allowTransition(Pending::class, Approved::class)
            ->allowTransition(Pending::class, Rejected::class)
            ->allowTransition(Approved::class, Rejected::class);

    }
}
