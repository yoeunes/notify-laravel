<?php

namespace Yoeunes\Notify\Laravel\Config;

use Illuminate\Contracts\Config\Repository;
use Yoeunes\Notify\Config\ConfigInterface;

final class Config implements ConfigInterface
{
    const NOTIFY = 'notify';

    private $config;

    public function __construct(Repository $config)
    {
        $this->config = $config;
    }

    public function get($key, $default = null)
    {
        return $this->config->get(self::NOTIFY . '.' . $key, $default);
    }
}
