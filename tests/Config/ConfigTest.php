<?php

namespace Yoeunes\Notify\Laravel\Tests\Config;

use Yoeunes\Notify\Laravel\Config\Config;
use Yoeunes\Notify\Laravel\Tests\TestCase;

final class ConfigTest extends TestCase
{
    public function test_simple_config()
    {
        $config = new Config($this->app->make('config'));

        $this->assertEquals('toastr', $config->get('default'));
        $this->assertArrayHasKey('scripts', $config->get('notifiers.toastr'));
        $this->assertEquals('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js', $config->get('notifiers.toastr.scripts.0'));
    }
}
