<?php

namespace UniversoNarrado\LaravelReferral\Duration;

use UniversoNarrado\LaravelReferral\Contracts\ReferralCookieDurationContract;

class CookieDurationForever implements ReferralCookieDurationContract
{
    public function getMinutesToStore(): int
    {
        // Store the cookie forever (5 years - 365 days * 5).
        return 2628000;
    }
}
