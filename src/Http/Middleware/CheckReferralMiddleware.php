<?php

namespace UniversoNarrado\LaravelReferral\Http\Middleware;

use Closure;
use UniversoNarrado\LaravelReferral\Contracts\ReferralCookieDurationContract;
use UniversoNarrado\LaravelReferral\Events\ReferralLinkVisitEvent;
use UniversoNarrado\LaravelReferral\Models\ContasIndicacoes;
use Illuminate\Http\Request;

class CheckReferralMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $referralCookieName = config('referral.cookie_name');

        if (
            $request->hasCookie($referralCookieName) &&
            ! config('referral.overwrite_previous_referral', false)
        ) {
            // Return next action when there is a referral cookie set
            return $next($request);
        }

        if ($ref = $request->query('r')) {
            // Check if the referral account exists, if not then just return
            if ( ! ContasIndicacoes::referralTokenExists($ref)) {
                return $next($request);
            }

            $contasIndicacoes = ContasIndicacoes::byReferralToken($ref);

            if ( ! $request->hasCookie($referralCookieName) || $request->cookie($referralCookieName) !== $ref) {
                // Register cookie as link-visited
                event(new ReferralLinkVisitEvent($contasIndicacoes));
            }

            // if old cookie and new cookie are the same, do nothing
            if ($request->cookie($referralCookieName) === $ref) {
                return $next($request);
            }

            $cookieDuration = config('referral.cookie_duration');
            $cookieDuration = new $cookieDuration();

            if ( ! $cookieDuration instanceof ReferralCookieDurationContract) {
                throw new \Exception('Invalid `cookie_duration` class defined in configuration.');
            }

            $redirect = redirect($request->fullUrl())
                ->withCookie(
                    cookie()->make($referralCookieName, $ref, (new $cookieDuration)->getMinutesToStore())
                );

            foreach (config('referral.cookie_domains', []) as $cookieDomain) {
                $redirect->withCookie(
                    cookie()->make(
                        $referralCookieName, $ref, (new $cookieDuration)->getMinutesToStore(), null, $cookieDomain
                    )
                );
            }

            return $redirect;
        }

        return $next($request);
    }
}
