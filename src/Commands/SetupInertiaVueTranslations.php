<?php

namespace DevAlysonh\InertiaVueTranslate\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'translations:setup')]
class SetupInertiaVueTranslations extends Command
{
    protected $signature = 'translations:setup';
    protected $description = 'Setup translations helper in your Laravel with (Inertia + VueJs) project';

    public function handle()
    {
        $this->info('Seting up Inertia Vue Translations...');
        
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Middleware'));
        copy(__DIR__ . '/../Middleware/ShareTranslations.php', app_path('Http/Middleware/ShareTranslations.php'));

        (new Filesystem)->ensureDirectoryExists(resource_path());
        (new Filesystem)->ensureDirectoryExists(resource_path('js'));
        copy(__DIR__ . '/../resources/js/mixins/translations.js', resource_path('js/mixins/translations.js'));
        (new Filesystem)->copyDirectory(__DIR__ . '/../resources/lang', resource_path('lang'));

        $this->info('Finished!');
    }
}
