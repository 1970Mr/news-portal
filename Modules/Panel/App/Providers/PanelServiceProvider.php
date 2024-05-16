<?php

namespace Modules\Panel\App\Providers;

use App\Http\Kernel;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Comment\App\Models\Comment;
use Modules\ContactUs\App\Models\UserMessage;
use Modules\Panel\App\Http\Middleware\ShareData;

class PanelServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'Panel';

    protected string $moduleNameLower = 'panel';

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

        $this->registerMiddlewares();

        $this->registerSharedData();
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
        $this->app->booted(function () {
            $this->publishes([module_path($this->moduleName, 'config/config.php') => config_path($this->moduleNameLower.'.php')], 'config');
            $this->mergeConfigFrom(module_path($this->moduleName, 'config/config.php'), $this->moduleNameLower);
        });
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

    protected function registerMiddlewares(): void
    {
        $this->app->make(Kernel::class)->appendMiddlewareToGroup('web', ShareData::class);
    }

    protected function registerSharedData(): void
    {
        $this->app->booted(function () {
            $this->commentsSharedData();
            $this->userMessagesSharedData();
        });
    }

    private function commentsSharedData(): void
    {
        $pendingCommentsQuery = Comment::query()->where('status', Comment::PENDING);
        $pendingCommentsCount = $pendingCommentsQuery->count();
        $pendingComments = $pendingCommentsQuery->limit(10)->latest()->get();
        $pendingCommentsRoute = route(config('app.panel_prefix', 'panel') . '.comments.index', ['filter' => Comment::PENDING]);
        View::share('pendingCommentsCount', $pendingCommentsCount);
        View::share('pendingComments', $pendingComments);
        View::share('pendingCommentsRoute', $pendingCommentsRoute);
    }

    private function userMessagesSharedData(): void
    {
        $unseenUserMessagesQuery = UserMessage::query()->whereDoesntHave('seen', function (Builder $q) {
            $q->where('seen', true);
        });
        $unseenUserMessagesCount = $unseenUserMessagesQuery->count();
        $unseenUserMessages = $unseenUserMessagesQuery->limit(10)->latest()->get();
        $unseenUserMessagesRoute = route(config('app.panel_prefix', 'panel') . '.contact-us.messages.index', ['filter' => UserMessage::UNSEEN]);
        View::share('unseenUserMessagesCount', $unseenUserMessagesCount);
        View::share('unseenUserMessages', $unseenUserMessages);
        View::share('unseenUserMessagesRoute', $unseenUserMessagesRoute);
    }
}
