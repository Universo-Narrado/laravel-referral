<?php

namespace Famdirksen\LaravelReferral\Contracts;

use Famdirksen\LaravelReferral\Models\ContasIndicacoes;
use Illuminate\Database\Eloquent\Relations\MorphMany;

interface CanReferralContract
{
    public function makeReferralAccount(string $name): ContasIndicacoes;

    public function contasIndicacoes(): MorphMany;
}
