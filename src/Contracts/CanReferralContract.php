<?php

namespace UniversoNarrado\LaravelReferral\Contracts;

use UniversoNarrado\LaravelReferral\Models\ContasIndicacoes;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface CanReferralContract
{
    public function makeReferralAccount(string $name): ContasIndicacoes;

    public function contasIndicacoes(): MorphMany;
}
