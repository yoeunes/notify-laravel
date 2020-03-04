<?php

namespace Yoeunes\Notify\Laravel\ServiceProvider;

use Yoeunes\Notify\Laravel\NotifyServiceProvider;
use Yoeunes\Notify\Laravel\ServiceProvider\Providers\ServiceProviderInterface;

final class ServiceProviderManager
{
    private $provider;

    /**
     * @var ServiceProviderInterface[]
     */
    private $providers = array(
        'Yoeunes\Notify\Laravel\ServiceProvider\Providers\Laravel4',
        'Yoeunes\Notify\Laravel\ServiceProvider\Providers\Laravel50',
        'Yoeunes\Notify\Laravel\ServiceProvider\Providers\Laravel',
        'Yoeunes\Notify\Laravel\ServiceProvider\Providers\Lumen',
    );

    private $notifyServiceProvider;

    public function __construct(NotifyServiceProvider $notifyServiceProvider)
    {
        $this->notifyServiceProvider = $notifyServiceProvider;
    }

    public function boot()
    {
        $provider = $this->resolveServiceProvider();

        $provider->publishConfig($this->notifyServiceProvider);
        $provider->registerBladeDirectives();
    }

    public function register()
    {
        $provider = $this->resolveServiceProvider();

        $provider->registerNotifyManager();
    }

    /**
     * @return ServiceProviderInterface
     */
    private function resolveServiceProvider()
    {
        if ($this->provider instanceof ServiceProviderInterface) {
            return $this->provider;
        }

        foreach ($this->providers as $providerClass) {
            $provider = new $providerClass($this->notifyServiceProvider->getApplication());

            if ($provider->shouldBeUsed()) {
                return $this->provider = $provider;
            }
        }

        throw new \InvalidArgumentException('Service Provider not found.');
    }
}
