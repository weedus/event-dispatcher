<?php
/**
 * Created by PhpStorm.
 * User: ben
 * Date: 23.06.18
 * Time: 10:14
 */

namespace Weedus\EventDispatcher\Tests\Helper;


use Weedus\EventDispatcher\EventSubscriberInterface;

class TestEventSubscriber implements EventSubscriberInterface
{

    public $test1 = false;
    public $test2 = false;
    public $test3= false;

    public $bla = false;
    public $blub = false;

    public $testStack = [];

    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * (It's static for the need of lazy loading)
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * ['eventName' => 'methodName']
     *  * ['eventName' => ['methodName', $priority]]
     *  * ['eventName' => [['methodName1', $priority], ['methodName2']]]
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            'test1' => 'onTest1',
            'test2' => ['onTest2', 10],
            'test3' => [['onTest3', 10], ['onTest2'], ['onTest1', -10]],
            'reset' => 'reset'
        ];
    }

    public function onTest1()
    {
        $this->test1 = true;
        $this->testStack[] = 'test1';
    }

    public function onTest2()
    {
        $this->test2 = true;
        $this->testStack[] = 'test2';
    }

    public function onTest3()
    {
        $this->test3 = true;
        $this->testStack[] = 'test3';
    }

    public function reset()
    {
        $this->bla=false;
        $this->blub=false;
        $this->test1=false;
        $this->test2=false;
        $this->test3=false;
        $this->testStack=[];
    }

    public function bla()
    {
        $this->bla = true;
        $this->testStack[] = 'bla';
    }
    public function blub()
    {
        $this->blub = true;
        $this->testStack[] = 'blub';
    }
}