<?php

namespace Yoeunes\Notify\Laravel\Config;

use Illuminate\Config\Repository;
use Yoeunes\Notify\Config\ConfigInterface;

final class Config implements ConfigInterface
{
    private $config;

    private $separator;

    public function __construct(Repository $config, $separator = '.')
    {
        $this->config = $config;
        $this->separator = $separator;
    }

    public function get($key, $default = null)
    {
        return $this->config->get('notify'.$this->separator.$key, $default);
    }
}
