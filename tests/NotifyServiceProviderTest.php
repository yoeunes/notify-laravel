<?php

namespace Yoeunes\Notify\Laravel\Tests;

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

        $config = \Closure::bind(function () {
            return $this->config;
        }, $notify, '\Yoeunes\Notify\NotifyManager')();

        $this->assertInstanceOf('\Yoeunes\Notify\Config\ConfigInterface', $config);
    }
}
