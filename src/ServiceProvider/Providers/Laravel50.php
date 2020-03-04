<?php

namespace Yoeunes\Notify\Laravel\ServiceProvider\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;

class Laravel50 extends Laravel
{
    public function shouldBeUsed()
    {
        return $this->app instanceof Application && 0 === strpos(Application::VERSION, '5.0.');
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
