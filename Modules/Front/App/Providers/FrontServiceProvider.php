<?php

namespace Modules\Front\App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Article\App\Services\Front\ArticleService;
use Modules\Front\App\View\Components\breadcrumbs;
use Modules\Front\App\View\Components\ListingPagePagination;
use Modules\Setting\App\Services\SocialNetworkService;


class FrontServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Front';

    protected string $moduleNameLower = 'front';

    /**
     * Boot the application events.
     */
    public function boot(): void
    {
        $this->registerCommands();
        $this->registerCommandSchedules();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/migrations'));

        $this->registerSharedData();
        $this->loadViewComponentsAs($this->moduleNameLower, [breadcrumbs::class, ListingPagePagination::class]);
        Paginator::useBootstrapFive();
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register commands in the format of Command::class
     */
    protected function registerCommands(): void
    {
        // $this->commands([]);
    }

    /**
     * Register command Schedules.
     */
    protected function registerCommandSchedules(): void
    {
        // $this->app->booted(function () {
        //     $schedule = $this->app->make(Schedule::class);
        //     $schedule->command('inspire')->hourly();
        // });
    }

    /**
     * Register translations.
     */
    public function registerTranslations(): void
    {
        $langPath = resource_path('lang/modules/'.$this->moduleNameLower);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleNameLower);
            $this->loadJsonTranslationsFrom($langPath);
        } else {
            $this->loadTranslationsFrom(module_path($this->moduleName, 'lang'), $this->moduleNameLower);
            $this->loadJsonTranslationsFrom(module_path($this->moduleName, 'lang'));
        }
    }

    /**
     * Register config.
     */
    protected function registerConfig(): void
    {
        $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
        $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
    }

    /**
     * Register views.
     */
    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->moduleNameLower);
        $sourcePath = module_path($this->moduleName, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->moduleNameLower.'-module-views']);

        $this->loadViewsFrom(array_merge($this->getPublishableViewPaths(), [$sourcePath]), $this->moduleNameLower);

        $componentNamespace = str_replace('/', '\\', config('modules.namespace').'\\'.$this->moduleName.'\\'.config('modules.paths.generator.component-class.path'));
        Blade::componentNamespace($componentNamespace, $this->moduleNameLower);
    }

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [];
    }

    private function getPublishableViewPaths(): array
    {
        $paths = [];
        foreach (config('view.paths') as $path) {
            if (is_dir($path.'/modules/'.$this->moduleNameLower)) {
                $paths[] = $path.'/modules/'.$this->moduleNameLower;
            }
        }

        return $paths;
    }

    protected function registerSharedData(): void
    {
        $this->app->booted(function () {
            $socialNetworks = resolve(SocialNetworkService::class)->getSocialNetworksWithTag(SocialNetworkService::TAG);
            View::composer([
                'home::index',
                'article::front.single-article.show',
                'front::author.index',
                'front::category.index',
                'front::tag.index',
                'front::search.index',
            ], static function ($view) use ($socialNetworks) {
                $view->with(resolve(ArticleService::class)->composeViewData() + ['social_networks' => $socialNetworks]);
            });
        });
    }
}
