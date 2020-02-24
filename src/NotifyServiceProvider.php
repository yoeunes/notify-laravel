<?php

namespace Yoeunes\Notify\Laravel;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Illuminate\Foundation\Application as LaravelApplication;
use Yoeunes\Notify\Laravel\Config\Config;
use Yoeunes\Notify\NotifyManager;

class NotifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../config/notify.php') ?: $raw;

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$source => config_path('notify.php')], 'config');
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('notify');
        }

        $this->mergeConfigFrom($source, 'notify');

        $this->registerBladeDirectives();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app instanceof LumenApplication) {
            $this->app->register('\Illuminate\Session\SessionServiceProvider');
            $this->app->configure('session');
        }

        $this->registerNotifyManager();
    }

    public function registerNotifyManager()
    {
        $this->app->singleton('notify', function (Application $app) {
            $config = $app['config'];

            return new NotifyManager(new Config($config));
        });

        $this->app->alias('notify', '\Yoeunes\Notify\NotifyManager');
    }

    public function registerBladeDirectives()
    {
        Blade::directive('notify_render', function () {
            return "<?php echo app('notify')->render(); ?>";
        });

        Blade::directive('notify_css', function () {
            return "<?php echo app('notify')->renderStyles(); ?>";
        });

        Blade::directive('notify_js', function () {
            return "<?php echo app('notify')->renderScripts(); ?>";
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'notify',
        ];
    }
}
