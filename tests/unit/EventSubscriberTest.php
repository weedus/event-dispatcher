<?php

namespace Weedus\EventDispatcher\Tests\unit;

use Weedus\EventDispatcher\EventSubscriberInterface;
use Weedus\EventDispatcher\Tests\Helper\TestEventSubscriber;

class EventSubscriberTest extends \Codeception\Test\Unit
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
    public function testInterface()
    {
        $subscriber = new TestEventSubscriber();
        $this->assertInstanceOf(EventSubscriberInterface::class, $subscriber);
        $this->assertTrue(method_exists($subscriber,'getSubscribedEvents'));
        $this->assertTrue(is_array($subscriber::getSubscribedEvents()));
        $this->assertEquals($subscriber::getSubscribedEvents(),TestEventSubscriber::getSubscribedEvents());
    }
}