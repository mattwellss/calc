<?php

namespace App\Traits;

trait HasCalculation
{
    /**
     * @var \Calculate\Calculation
     */
    protected $calculation;

    /**
     * set the calculation object
     * @param \Calculate\Calculation $calculation
     */
    public function setCalculation($calculation)
    {
        $this->calculation = $calculation;
    }
}
