<?php

namespace UniversoNarrado\LaravelReferral;

use Illuminate\Support\ServiceProvider;

class LaravelReferralServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->setupMigrations();
        }
    }

    public function register()
    {
        $this->setupConfig();
    }

    protected function setupConfig()
    {
        $source = __DIR__.'/../config/referral.php';

        $this->publishes([
            $source => config_path('referral.php'),
        ], 'config');

        $this->mergeConfigFrom($source, 'referral');
    }

    protected function setupMigrations()
    {
        $timestamp = date('Y_m_d_His');

        foreach ([
            'create_contas_indicacoes_table',
            'create_indicacoes_table',
        ] as $file) {
            $migrationsSource = __DIR__."/../database/migrations/{$file}.php";
            $migrationsTarget = database_path("/migrations/{$timestamp}_{$file}.php");

            $this->publishes([
                $migrationsSource => $migrationsTarget,
            ], 'migrations');
        }
    }
}
