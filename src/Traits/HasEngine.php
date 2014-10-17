<?php

namespace App\Traits;

trait HasEngine
{
    /**
     * @var \League\Plates\Engine
     */
    protected $engine;

    /**
     * @param \League\Plates\Engine $engine
     */
    public function setEngine(\League\Plates\Engine $engine)
    {
        $this->engine = $engine;
    }
}
