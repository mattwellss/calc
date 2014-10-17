<?php

namespace App\Traits;

trait HasEngine
{
    protected $engine;

    public function setEngine($engine)
    {
        $this->engine = $engine;
    }
}
