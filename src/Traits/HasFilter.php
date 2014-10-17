<?php

namespace App\Traits;

trait HasFilter
{
    protected $filter;

    public function setFilter($filter)
    {
        $this->filter = $filter;
    }
}
