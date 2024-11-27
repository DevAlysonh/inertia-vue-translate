<?php

namespace DevAlysonh\InertiaVueTranslate\Providers;

use DevAlysonh\InertiaVueTranslate\Commands\SetupInertiaVueTranslations;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            SetupInertiaVueTranslations::class,
        ]);
    }

    public function provides()
    {
        return [SetupInertiaVueTranslations::class];
    }
}