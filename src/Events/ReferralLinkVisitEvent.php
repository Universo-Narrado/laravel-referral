<?php

namespace UniversoNarrado\LaravelReferral\Events;

use UniversoNarrado\LaravelReferral\Models\ContasIndicacoes;

class ReferralLinkVisitEvent
{
    public $contasIndicacaoes;

    public function __construct(ContasIndicacoes $contasIndicacaoes)
    {
        $this->contasIndicacaoes = $contasIndicacaoes;
    }
}
