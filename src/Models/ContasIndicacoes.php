<?php

namespace UniversoNarrado\LaravelReferral\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContasIndicacoes extends Model
{
    protected $table = 'contas_indicacoes';

    protected static function boot()
    {
        parent::boot();

        static::creating(function (self $contasIndicacoes) {
            $contasIndicacoes->con_ind_codigo = self::generateReferralToken();
        });
    }

    // Relations
    public function indicacaoes()
    {
        return $this->hasMany(Indicacoes::class, 'con_ind_id', 'con_ind_id');
    }

    // Scopes
    public static function scopeReferralTokenExists(Builder $query, $con_ind_codigo)
    {
        return $query->where('con_ind_codigo', $con_ind_codigo)
            ->exists();
    }

    public static function scopeByReferralToken(Builder $query, $con_ind_codigo)
    {
        return $query->where('con_ind_codigo', $con_ind_codigo)
            ->first();
    }

    // Methods
    public function getReferralLink($link = null)
    {
        if ($link) {
            return $link.'?r='.$this->getReferralToken();
        }

        return url('/?r='.$this->getReferralToken());
    }

    public function getReferralToken()
    {
        return $this->con_ind_codigo;
    }

    protected static function generateReferralToken()
    {
        $length = config('referral.code_length', 5);

        do {
            $con_ind_codigo = Str::random($length);
        } while (static::referralTokenExists($con_ind_codigo));

        return $con_ind_codigo;
    }
}
