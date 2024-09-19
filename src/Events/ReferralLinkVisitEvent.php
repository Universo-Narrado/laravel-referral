<?php

namespace UniversoNarrado\LaravelReferral\Events;

use UniversoNarrado\LaravelReferral\Models\ContasIndicacoes;

class ReferralLinkVisitEvent
{
    public $contasIndicacoes;

    public function __construct(ContasIndicacoes $contasIndicacoes)
    {
        $this->contasIndicacoes = $contasIndicacoes;
    }
}
