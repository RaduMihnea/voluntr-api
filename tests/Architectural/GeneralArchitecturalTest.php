<?php

namespace Architectural;

test('globals')
    ->expect(['dd', 'dump'])
    ->not->toBeUsed();
