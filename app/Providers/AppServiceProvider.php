<?php

namespace App\Providers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\ComponentAttributeBag;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/shopper.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(resource_path('views/vendor/shopper'), 'shopper');
        Blade::anonymousComponentPath(resource_path('views/vendor/shopper/components'), 'shopper');

        Blade::directive('blaze', fn (): string => '');

        if (! ComponentAttributeBag::hasMacro('twMerge')) {
            ComponentAttributeBag::macro('twMerge', function (array|string $attributes = []): ComponentAttributeBag {
                /** @var ComponentAttributeBag $this */
                if (is_string($attributes)) {
                    return $this->class($attributes);
                }

                return $this
                    ->class($attributes['class'] ?? [])
                    ->merge(Arr::except($attributes, 'class'));
            });
        }
    }
}
