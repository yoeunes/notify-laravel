<?php

namespace Yoeunes\Notify\Laravel\ServiceProvider\Providers;

use Illuminate\Container\Container;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Yoeunes\Notify\Laravel\Config\Config;
use Yoeunes\Notify\Laravel\NotifyServiceProvider;
use Yoeunes\Notify\NotifyManager;

final class Laravel4 implements ServiceProviderInterface
{
    private $app;

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function shouldBeUsed()
    {
        return $this->app instanceof Application && 0 === strpos(Application::VERSION, '4.');
    }

    public function publishConfig(NotifyServiceProvider $provider)
    {
        $provider->package('yoeunes/notify-laravel', 'notify', __DIR__.'/../../../resources');
    }

    public function registerNotifyManager()
    {
        $this->app->singleton('notify', function (Application $app) {
            $config = $app['config'];

            return new NotifyManager(new Config($config, '::'));
        });

        $this->app->alias('notify', '\Yoeunes\Notify\NotifyManager');
    }

    public function registerBladeDirectives()
    {
        Blade::extend(function ($view, $compiler) {
            $pattern = $compiler->createPlainMatcher('notify_render');

            $replace = "<?php echo app('notify')->render(); ?>";

            return preg_replace($pattern, '$1'.$replace, $view);
        });

        Blade::extend(function ($view, $compiler) {
            $pattern = $compiler->createPlainMatcher('notify_css');

            $replace = "<?php echo app('notify')->renderStyles(); ?>";

            return preg_replace($pattern, '$1'.$replace, $view);
        });

        Blade::extend(function ($view, $compiler) {
            $pattern = $compiler->createPlainMatcher('notify_js');

            $replace = "<?php echo app('notify')->renderScripts(); ?>";

            return preg_replace($pattern, '$1'.$replace, $view);
        });
    }
}
