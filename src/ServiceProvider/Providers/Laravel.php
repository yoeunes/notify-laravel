<?php

namespace Yoeunes\Notify\Laravel\ServiceProvider\Providers;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Yoeunes\Notify\Laravel\Config\Config;
use Yoeunes\Notify\Laravel\NotifyServiceProvider;
use Yoeunes\Notify\NotifyManager;

class Laravel implements ServiceProviderInterface
{
    protected $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function shouldBeUsed()
    {
        return $this->app instanceof Application;
    }

    public function publishConfig(NotifyServiceProvider $provider)
    {
        $source = realpath($raw = __DIR__ . '/../../../resources/config/config.php') ?: $raw;

        $provider->publishes(array($source => config_path('notify.php')), 'config');

        $provider->mergeConfigFrom($source, 'notify');
    }

    public function registerNotifyManager()
    {
        $this->app->singleton('notify', function (Application $app) {
            $config = $app['config'];

            return new NotifyManager(new Config($config, '.'));
        });

        $this->app->alias('notify', '\Yoeunes\Notify\NotifyManager');
    }

    public function registerBladeDirectives()
    {
        Blade::directive('notify_render', function () {
            return "<?php echo app('notify')->render(); ?>";
        });

        Blade::directive('notify_js', function () {
            return "<?php echo app('notify')->renderScripts(); ?>";
        });

        Blade::directive('notify_css', function () {
            return "<?php echo app('notify')->renderStyles(); ?>";
        });
    }
}
