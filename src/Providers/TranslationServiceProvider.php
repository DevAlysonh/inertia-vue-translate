<?php

namespace DevAlysonh\InertiaVueTranslate\Providers;

use Illuminate\Support\ServiceProvider;

class TranslationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../Middleware/ShareTranslations.php' => app_path('Http/Middleware/ShareTranslations.php'),
        ], 'middleware');
        
        $this->publishes([
            __DIR__.'/../resources/js/mixins/translations.js' => resource_path('js/mixins/translations.js'),
            __DIR__.'/../resources/lang' => resource_path('lang'),
        ], 'translations');
    }

    public function register()
    {
        //
    }
}