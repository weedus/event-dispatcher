<?php

namespace Weedus\EventDispatcher\Tests\unit;

use Weedus\EventDispatcher\Event;
use Weedus\EventDispatcher\EventInterface;

class EventTest extends \Codeception\Test\Unit
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
    public function testCreation()
    {
        $event = new Event('test',['context']);
        $this->assertInstanceOf(EventInterface::class, $event);
        $this->assertInstanceOf(Event::class, $event);
        $this->assertEquals('test',$event->getName());
        $this->assertEquals(['context'],$event->getContext());
    }

    public function testStopPropation()
    {
        $event = new Event('test',['context']);
        $this->assertFalse($event->isPropagationStopped());
        $event->stopPropagation();
        $this->assertTrue($event->isPropagationStopped());
    }
}
