<?php

namespace Yoeunes\Notify\Laravel\Storage;

use Yoeunes\Notify\Storage\StorageInterface;

final class Storage implements StorageInterface
{
    private $session;

    public function __construct($session)
    {
        echo str_repeat(PHP_EOL, 3).get_class($session).str_repeat(PHP_EOL, 3);
        $this->session = $session;
    }

    public function get($key, $default = array())
    {
        $value = $this->session->get($key, $default);

        $this->session->forget($key);

        return $value;
    }

    public function flash($key, $value)
    {
        $this->session->flash($key, $value);
    }
}
