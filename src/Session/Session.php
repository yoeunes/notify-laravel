<?php

namespace Yoeunes\Notify\Laravel\Session;

use Illuminate\Session\SessionManager;
use Yoeunes\Notify\Session\SessionInterface;

class Session implements SessionInterface
{
    private $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function get($key, $default = null)
    {
        return $this->session->get($key, $default);
    }

    public function flash($key, $value)
    {
        return $this->session->flash($key, $value);
    }
}
