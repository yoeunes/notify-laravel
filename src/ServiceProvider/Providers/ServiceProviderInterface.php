<?php

namespace Yoeunes\Notify\Laravel\ServiceProvider\Providers;

use Yoeunes\Notify\Laravel\NotifyServiceProvider;

interface ServiceProviderInterface
{
    public function shouldBeUsed();

    public function publishConfig(NotifyServiceProvider $provider);

    public function registerNotifyManager();

    public function registerBladeDirectives();
}
