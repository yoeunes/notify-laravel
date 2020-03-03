<?php

namespace Yoeunes\Notify\Laravel\Storage;

use Illuminate\Session\Store as LaravelSession;
use Yoeunes\Notify\Storage\StorageInterface;

final class Storage implements StorageInterface
{
    private $session;

    public function __construct(LaravelSession $session)
    {
        $this->session = $session;
    }

    public function get($key, $default = array())
    {
        return $this->session->pull($key, $default);
    }

    public function flash($key, $value)
    {
        $this->session->flash($key, $value);
    }
}
