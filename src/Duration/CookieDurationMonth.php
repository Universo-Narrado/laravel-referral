<?php

namespace UniversoNarrado\LaravelReferral\Duration;

use UniversoNarrado\LaravelReferral\Contracts\ReferralCookieDurationContract;

class CookieDurationMonth implements ReferralCookieDurationContract
{
    public function getMinutesToStore(): int
    {
        // Store the cookie for one month (31 days).
        return 44640;
    }
}
