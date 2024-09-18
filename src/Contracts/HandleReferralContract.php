<?php

namespace UniversoNarrado\LaravelReferral\Contracts;

use UniversoNarrado\LaravelReferral\Models\ContasIndicacoes;
use UniversoNarrado\LaravelReferral\Models\Indicacoes;

interface HandleReferralContract
{
    public function toReferral(ContasIndicacoes $contasIndicacoes): Indicacoes;

    public function toReferralIfNeededBasedOnCookie(): void;
}
