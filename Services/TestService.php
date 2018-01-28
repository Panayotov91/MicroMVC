<?php

namespace Services;


class TestService implements TestServiceInterface
{
    /**
     * @var TestService2Interface
     */
    private $testService2;

    /**
     * TestService constructor.
     * @param TestService2Interface $testService2
     */
    public function __construct(TestService2Interface $testService2)
    {
        $this->testService2 = $testService2;
    }

    public function TestPrint()
    {
        echo "Service work !!!";
        echo "<br>";
        $this->testService2->printTest();
    }
}