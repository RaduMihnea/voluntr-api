<?php

namespace Domain\Badges\Enums;

enum BadgeProgressSlugsEnum: string
{
    const ENROLLMENT = 'enrollment';

    const ENROLLMENT_APPROVED = 'enrollment-approved';

    const PROFILE_COMPLETED = 'profile-completed';

    const ENROLLMENT_ANIMALS = 'enrollment-animals';

    const ENROLLMENT_ART = 'enrollment-art';

    const ENROLLMENT_SPORTS = 'enrollment-sports';

    const ENROLLMENT_MUSIC = 'enrollment-music';

    const ENROLLMENT_COMMUNITY = 'enrollment-community';

    const ENROLLMENT_SOCIAL = 'enrollment-social';

    const ENROLLMENT_EDUCATION = 'enrollment-education';

    const ENROLLMENT_CHILDREN = 'enrollment-children';

    const ENROLLMENT_ENVIRONMENT = 'enrollment-environment';
}
