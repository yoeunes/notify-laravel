<?php

namespace Yoeunes\Notify\Laravel\Tests\Storage;

use Yoeunes\Notify\Laravel\Storage\Storage;
use Yoeunes\Notify\Laravel\Tests\TestCase;

final class StorageTest extends TestCase
{
    public function test_simple()
    {
        $session = new Storage($this->app->make('session.store'));

        $session->flash('notifications', array('type' => 'success', 'title' => 'success title'));
        $this->assertEquals(array('type' => 'success', 'title' => 'success title'), $session->get('notifications'));

        $session->flash('notifications', array('type' => 'info', 'title' => 'info title'));
        $this->assertEquals(array('type' => 'info', 'title' => 'info title'), $session->get('notifications'));

        $this->assertEquals(array(), $session->get('notifications'));
    }
}
