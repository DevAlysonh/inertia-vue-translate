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
        (new Filesystem)->ensureDirectoryExists(resource_path('js/mixins'));
        (new Filesystem)->ensureDirectoryExists(resource_path('lang'));
        copy(__DIR__ . '/../resources/js/mixins/translations.js', resource_path('js/mixins/translations.js'));
        copy(__DIR__ . '/../resources/lang/en.json', resource_path('/lang/en.json'));
        copy(__DIR__ . '/../resources/lang/pt_BR.json', resource_path('/lang/pt_BR.json'));

        $this->info('Finished!');
    }
}
