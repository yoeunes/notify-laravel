<?php

namespace Yoeunes\Notify\Laravel\Tests;

use Illuminate\View\Compilers\BladeCompiler;

class NotifyServiceProviderTest extends TestCase
{
    public function test_notify_service_exists()
    {
        $this->assertTrue($this->app->bound('notify'));
    }

    public function test_notify_manager_get_config()
    {
        /** @var \Yoeunes\Notify\NotifyManager $notify */
        $notify = $this->app->make('notify');

        $reflection = new \ReflectionClass(get_class($notify));
        $config = $reflection->getProperty('config');
        $config->setAccessible(true);

        $this->assertInstanceOf('\Yoeunes\Notify\Config\ConfigInterface', $config->getValue($notify));
    }

    public function test_blade_directive()
    {
        /** @var BladeCompiler $blade */
        $blade = $this->app->make('view')->getEngineResolver()->resolve('blade')->getCompiler();

        $this->assertEquals("<?php echo app('notify')->render(); ?>", $blade->compileString('@notify_render'));
        $this->assertEquals("<?php echo app('notify')->renderStyles(); ?>", $blade->compileString('@notify_css'));
        $this->assertEquals("<?php echo app('notify')->renderScripts(); ?>", $blade->compileString('@notify_js'));
    }
}
