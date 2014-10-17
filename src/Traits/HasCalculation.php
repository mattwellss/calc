<?php

namespace App\Traits;

trait HasCalculation
{
    protected $calculation;

    public function setCalculation($calculation)
    {
        $this->calculation = $calculation;
    }
}
