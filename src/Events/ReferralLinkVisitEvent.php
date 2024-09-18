<?php

namespace Famdirksen\LaravelReferral\Events;

use Famdirksen\LaravelReferral\Models\ContasIndicacoes;

class ReferralLinkVisitEvent
{
    public $contasIndicacaoes;

    public function __construct(ContasIndicacoes $contasIndicacaoes)
    {
        $this->contasIndicacaoes = $contasIndicacaoes;
    }
}
