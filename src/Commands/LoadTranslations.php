<?php

namespace DevAlysonh\InertiaVueTranslate\Commands;

use Illuminate\Console\Command;

class LoadTranslations extends Command
{
    protected $signature = 'inertia:load-translations';
    protected $description = 'Load new translations from your Laravel with Inertia + VueJs project';

    public function handle()
    {
        $this->info('Loading new translations...');
        
        $this->call('cache:clear');

        $this->info('Translations loaded!');
    }
}
