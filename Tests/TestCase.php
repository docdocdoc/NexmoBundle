<?php

namespace DocDocDoc\NexmoBundle\Tests;

use DocDocDoc\ProfileBundle\Propel\User;
use DocDocDoc\ProfileBundle\Propel\UserPeer;

class TestCase extends \PHPUnit_Framework_TestCase
{
    protected static $kernel;
    protected $session;

    protected function getContainer(array $options = array())
    {
        if (!static::$kernel) {
            static::$kernel = static::createKernel($options);
        }
        static::$kernel->boot();

        return static::$kernel->getContainer();
    }

    protected static function getKernelClass()
    {
        require_once __DIR__.'/../../../../app/AppKernel.php';

        return 'AppKernel';
    }

    protected static function createKernel(array $options = array())
    {
        $class = self::getKernelClass();

        return new $class(
            'test',
            isset($options['debug']) ? $options['debug'] : true
        );
    }

    public function tearDown()
    {
        if ($this->session) {
            $this->session->clear();
        }
    }

    protected function callAsPublic($testedObject, $method, array $args = array())
    {
        $method = new \ReflectionMethod(get_class($testedObject), $method);
        $method->setAccessible(true);

        return $method->invokeArgs($testedObject, $args);
    }
}
