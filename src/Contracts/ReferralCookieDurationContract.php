<?php

namespace UniversoNarrado\LaravelReferral\Contracts;

interface ReferralCookieDurationContract
{
    public function getMinutesToStore(): int;
}
