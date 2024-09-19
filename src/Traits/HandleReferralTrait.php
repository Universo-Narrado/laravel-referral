<?php

namespace UniversoNarrado\LaravelReferral\Traits;

use Illuminate\Support\Facades\Cookie;
use UniversoNarrado\LaravelReferral\Models\ContasIndicacoes;
use UniversoNarrado\LaravelReferral\Models\Indicacoes;

trait HandleReferralTrait
{
    protected static function boot()
    {
        parent::boot();

        static::created(function (self $referableModel) {
            $referableModel->toReferralIfNeededBasedOnCookie();
        });
    }

    public function toReferralIfNeededBasedOnCookie(): void
    {
        // Check if there is a cookie set
        $referralCookieName = config('referral.cookie_name');

        if ($referredToken = Cookie::get($referralCookieName)) {
            // Check if the referral account still exists
            if ($contasIndicacoes = ContasIndicacoes::byReferralToken($referredToken)) {
                // Register the model for the referralToken
                $this->toReferral($contasIndicacoes);

                if (config('referral.clear_cookie_on_referral', false)) {
                    Cookie::queue(Cookie::forget($referralCookieName));
                }
            }
        }
    }

    public function toReferral(ContasIndicacoes $contasIndicacoes): Indicacoes
    {
        //todo - register only once per referral_account
        $indicacao = new Indicacoes;

        $indicacao->ind_tipo_type = get_class($this);
        $indicacao->ind_tipo_id = $this->getKey();
        $indicacao->con_ind_id = $contasIndicacoes->con_ind_id;

        $indicacao->save();

        return $indicacao;
    }
}
