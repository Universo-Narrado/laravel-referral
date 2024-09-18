<?php

namespace UniversoNarrado\LaravelReferral\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Indicacoes extends Model
{
    protected $table = 'indicacoes';

    // Relations
    public function indTipo(): MorphTo
    {
        return $this->morphTo('ind_tipo');
    }

    public function contasIndicacoes(): BelongsTo
    {
        return $this->belongsTo(ContasIndicacoes::class, 'con_ind_id', 'con_ind_id');
    }
}
