# Introduction:

This is a simple package that defines a mixin in your Laravel application with Inertia and Vue.js to handle translations similarly to how it's done in `blade.php` files. It becomes particularly useful when working with Vue.js, as Inertia.js does not natively provide a way to manage translations when needed.

I developed this package to make my life easier and avoid having to manually implement this mixin in every project.
I hope it will be helpful for you as well.

# Set Up:

Setting up this package is very simple. All you need to do is follow these steps:

* Install the package:
```
composer require dev-alysonh/inertia-vue-translate
```
* Run the Artisan command:
```
php artisan translations:setup
```
* Import the new mixin into your app.js configuration file, like this:
```
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { translations } from './mixins/translations'; // import the mixin

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .mixin(translations) // share the mixin globally  
      .use(plugin)
      .mount(el)
  },
})
```

* Register the ShareTranslations Middleware in your bootstrap/app.php file:
```
// Laravel ^11
// If you are using Laravel version 10 or earlier, you need to register the middleware in the Kernel.php file.
<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
            \App\Http\Middleware\ShareTranslations::class // register the ShareTranslations middleware
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

```

That's it! You can now start translating texts in your Laravel application with Inertia + Vue.js, similar to how you would in blade.php files: