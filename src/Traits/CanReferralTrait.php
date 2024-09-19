<?php

namespace UniversoNarrado\LaravelReferral\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use UniversoNarrado\LaravelReferral\Models\ContasIndicacoes;

trait CanReferralTrait
{
    public function makeReferralAccount(string $name): ContasIndicacoes
    {
        /** @var Model $this */

        $contasIndicacoes = new ContasIndicacoes;

        $contasIndicacoes->con_ind_morph_type = get_class($this);
        $contasIndicacoes->con_ind_morph_id = $this->getKey();
        $contasIndicacoes->con_ind_nome = $name;

        $contasIndicacoes->save();

        return $contasIndicacoes;
    }

    public function contasIndicacoes(): MorphMany
    {
        return $this->morphMany(ContasIndicacoes::class, 'con_ind_morph');
    }

}
