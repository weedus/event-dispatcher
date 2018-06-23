<?php

namespace Weedus\EventDispatcher\Tests\unit;

use Weedus\EventDispatcher\EventDispatcher;
use Weedus\EventDispatcher\EventDispatcherInterface;
use Weedus\EventDispatcher\Tests\Helper\TestEventSubscriber;

class EventDispatcherTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /** @var EventDispatcherInterface */
    protected $dispatcher;
    /** @var TestEventSubscriber */
    protected $subscriber;
    
    protected function _before()
    {
        $this->dispatcher= new EventDispatcher();
        $this->subscriber= new TestEventSubscriber();
    }

    protected function _after()
    {
    }

    // tests
    public function testCreation()
    {
        $this->assertInstanceOf(EventDispatcherInterface::class, $this->dispatcher);
    }

    public function testAddingListeners()
    {
        $this->assertFalse($this->dispatcher->hasListeners());

        $this->dispatcher->addListener('bla',[$this->subscriber,'bla']);

        $this->assertTrue($this->dispatcher->hasListeners());
        $this->assertFalse($this->dispatcher->hasListeners('blub'));
        $this->assertTrue($this->dispatcher->hasListeners('bla'));

        $this->dispatcher->addListener('blub',[[$this->subscriber,'blub'],10]);

        $this->assertTrue($this->dispatcher->hasListeners('blub'));
    }

    public function testRemovingListeners()
    {
        $this->assertFalse($this->dispatcher->hasListeners());
        $this->dispatcher->addListener('bla',[$this->subscriber,'bla']);
        $this->dispatcher->addListener('blub',[$this->subscriber,'blub']);

        $this->assertTrue($this->dispatcher->hasListeners('bla'));
        $this->assertTrue($this->dispatcher->hasListeners('blub'));

        $this->dispatcher->removeListener('bla',[$this->subscriber,'bla']);

        $this->assertFalse($this->dispatcher->hasListeners('bla'));
        $this->assertTrue($this->dispatcher->hasListeners('blub'));

        $this->dispatcher->removeListener('blub',[$this->subscriber,'blub']);

        $this->assertFalse($this->dispatcher->hasListeners());

        $this->dispatcher->addListener('bla',[$this->subscriber,'bla'],5);
        $this->dispatcher->addListener('bla',[$this->subscriber,'blub']);

        $this->assertTrue($this->dispatcher->hasListeners('bla'));
        $this->assertFalse($this->dispatcher->hasListeners('blub'));

        $this->dispatcher->removeListener('bla',[$this->subscriber,'bla']);
        $this->assertTrue($this->dispatcher->hasListeners('bla'));
        $this->dispatcher->removeListener('bla',[$this->subscriber,'blub']);
        $this->assertFalse($this->dispatcher->hasListeners('bla'));
    }

    public function testHandlingSubscriber()
    {
        $this->assertFalse($this->dispatcher->hasListeners());

        $this->dispatcher->addSubscriber($this->subscriber);

        $this->assertTrue($this->dispatcher->hasListeners());
        $this->assertTrue($this->dispatcher->hasListeners('test1'));
        $this->assertTrue($this->dispatcher->hasListeners('test2'));
        $this->assertTrue($this->dispatcher->hasListeners('test3'));

        $this->dispatcher->removeSubscriber($this->subscriber);
        $this->assertFalse($this->dispatcher->hasListeners());
    }
}