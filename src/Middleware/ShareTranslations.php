<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class ShareTranslations
{
    public function handle(Request $request, Closure $next)
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
