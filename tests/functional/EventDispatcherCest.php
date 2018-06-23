<?php

namespace Weedus\EventDispatcher\Tests\functional;


use Webmozart\Assert\Assert;
use Weedus\EventDispatcher\EventDispatcher;
use Weedus\EventDispatcher\Tests\Helper\TestEventSubscriber;

class EventDispatcherCest
{
    public function _before(\FunctionalTester $I)
    {
    }

    public function _after(\FunctionalTester $I)
    {
    }

    // tests
    public function tryDispatch(\FunctionalTester $I)
    {
        $subscriber = new TestEventSubscriber();
        $dispatcher = new EventDispatcher();
        $this->subscriberFastCheck($subscriber);

        $dispatcher->addSubscriber($subscriber);
        $dispatcher->addListener('test2',[$subscriber, 'bla'], -10);
        $dispatcher->addListener('test2',[$subscriber, 'blub'], 5);
        $dispatcher->addListener('test3',[$subscriber, 'blub'], -10);
        $dispatcher->addListener('test3',[$subscriber, 'bla'], 5);


        $dispatcher->dispatch('test1');
        Assert::false($subscriber->bla);
        Assert::false($subscriber->blub);
        Assert::true($subscriber->test1);
        Assert::false($subscriber->test2);
        Assert::false($subscriber->test3);
        Assert::eq(['test1'],$subscriber->testStack);
        $subscriber->reset();

        $dispatcher->dispatch('test2');
        Assert::true($subscriber->bla);
        Assert::true($subscriber->blub);
        Assert::false($subscriber->test1);
        Assert::true($subscriber->test2);
        Assert::false($subscriber->test3);
        Assert::eq(['test2','blub','bla'],$subscriber->testStack);
        $subscriber->reset();

        $dispatcher->dispatch('test3');
        Assert::true($subscriber->bla);
        Assert::true($subscriber->blub);
        Assert::true($subscriber->test1);
        Assert::true($subscriber->test2);
        Assert::true($subscriber->test3);
        Assert::eq(['test3','bla','test2','test1','blub'],$subscriber->testStack);

    }

    protected function subscriberAllFalse(TestEventSubscriber $subscriber)
    {
        Assert::false($subscriber->bla);
        Assert::false($subscriber->blub);
        Assert::false($subscriber->test1);
        Assert::false($subscriber->test2);
        Assert::false($subscriber->test3);
        Assert::allEq([],$subscriber->testStack);
    }

    protected function subscriberFastCheck(TestEventSubscriber $subscriber)
    {
        $this->subscriberAllFalse($subscriber);

        $subscriber->bla();
        $subscriber->blub();
        $subscriber->onTest1();
        $subscriber->onTest2();
        $subscriber->onTest3();

        Assert::true($subscriber->bla);
        Assert::true($subscriber->blub);
        Assert::true($subscriber->test1);
        Assert::true($subscriber->test2);
        Assert::true($subscriber->test3);

        Assert::eq(['bla','blub','test1','test2','test3'], $subscriber->testStack);
        Assert::notEq(['test1','bla','test2','blub','test3'], $subscriber->testStack);

        $subscriber->reset();

        $this->subscriberAllFalse($subscriber);
    }
}
