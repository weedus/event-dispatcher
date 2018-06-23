<?php

namespace Weedus\EventDispatcher\Tests\unit;

use Weedus\EventDispatcher\ImmutableEventDispatcher;
use Weedus\EventDispatcher\Tests\Helper\TestEventSubscriber;
use Weedus\Exceptions\BadMethodCallException;

class ImmutableEventDispatcherTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testImmutability()
    {
        $subscriber= new TestEventSubscriber();
        $dispatcher = (new \Weedus\EventDispatcher\EventDispatcher())->addSubscriber($subscriber);
        $immutable = new ImmutableEventDispatcher($dispatcher);

        $this->assertTrue($immutable->hasListeners());

        $failed = false;
        try{
            $immutable->addListener('bla',[$subscriber,'bla']);
        }catch(\Exception $exception){
            $failed = true;
            $this->assertInstanceOf(BadMethodCallException::class, $exception);
        }
        $this->assertTrue($failed);

        $failed = false;
        try{
            $immutable->removeListener('test1',[$subscriber,'test1']);
        }catch(\Exception $exception){
            $failed = true;
            $this->assertInstanceOf(BadMethodCallException::class, $exception);
        }
        $this->assertTrue($failed);

        $failed = false;
        try{
            $immutable->addSubscriber($subscriber);
        }catch(\Exception $exception){
            $failed = true;
            $this->assertInstanceOf(BadMethodCallException::class, $exception);
        }
        $this->assertTrue($failed);

        $failed = false;
        try{
            $immutable->removeSubscriber($subscriber);
        }catch(\Exception $exception){
            $failed = true;
            $this->assertInstanceOf(BadMethodCallException::class, $exception);
        }
        $this->assertTrue($failed);
    }
}