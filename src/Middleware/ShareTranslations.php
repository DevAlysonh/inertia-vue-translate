<?php

namespace DevAlysonh\InertiaVueTranslate\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;

class ShareTranslations
{
    public function handle($request, Closure $next)
    {
        $locale = session('locale', app()->getLocale());

        \Inertia\Inertia::share([
            'translations' => Cache::rememberForever("translations.{$locale}", function () use ($locale) {
                $trans = [];
                if (File::exists(resource_path("lang/$locale.json"))) {
                    $trans = json_decode(File::get(resource_path("lang/$locale.json")), true);
                }
                return $trans;
            }),
            'locale' => $locale,
        ]);

        return $next($request);
    }
}
