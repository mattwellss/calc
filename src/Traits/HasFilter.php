<?php

namespace App\Traits;

trait HasFilter
{
    /**
     * @var \Aura\Filter\RuleCollection
     */
    protected $filter;

    /**
     * @param \Aura\Filter\RuleCollection $filter
     */
    public function setFilter(\Aura\Filter\RuleCollection $filter)
    {
        $this->filter = $filter;
    }
}
