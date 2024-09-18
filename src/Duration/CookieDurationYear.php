<?php

namespace UniversoNarrado\LaravelReferral\Duration;

use UniversoNarrado\LaravelReferral\Contracts\ReferralCookieDurationContract;

class CookieDurationYear implements ReferralCookieDurationContract
{
    public function getMinutesToStore(): int
    {
        // Store the cookie for one year (365 days).
        return 525600;
    }
}
