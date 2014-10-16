<?php

namespace Calculate;

class CalculationTest extends \PHPUnit_Framework_TestCase
{
    protected function getCalculation()
    {
        return new Calculation;
    }
    public function testAddOperation()
    {
        $c = $this->getCalculation();

        $c->addOperation('echo', function ($a, $b)
        {
            echo "{$a} {$b}";
        });

        // no errors means we added an operation
        $this->assertTrue(true);
    }

    public function testBadAddoperation()
    {
        $c = $this->getCalculation();

        try {
            $c->addOperation('bad', 'not-a-callable');
            $this->assertTrue(false);
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }

    public function testCalculate()
    {
        $c = $this->getCalculation();

        $c->addOperation('append', function ($a, $b)
        {
            return $a.$b;
        });

        // no errors means we added an operation
        $this->assertEquals('hello world',
            $c->calculate('append', 'hello', ' world'));

    }
}
