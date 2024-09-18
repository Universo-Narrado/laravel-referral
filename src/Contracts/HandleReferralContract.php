<?php

namespace Famdirksen\LaravelReferral\Contracts;

use Famdirksen\LaravelReferral\Models\ContasIndicacoes;
use Famdirksen\LaravelReferral\Models\Indicacoes;

interface HandleReferralContract
{
    public function toReferral(ContasIndicacoes $contasIndicacoes): Indicacoes;

    public function toReferralIfNeededBasedOnCookie(): void;
}
