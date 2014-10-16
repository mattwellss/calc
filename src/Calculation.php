<?php

namespace Calculate;

class Calculation
{
    protected $operations = [];
    public function addOperation($key, callable $handler)
    {
        $this->operations[$key] = $handler;
    }

    public function calculate($op, $a, $b)
    {
        if (!isset($this->operations[$op])) {
            throw new \Exception("{$op} is not supported!");
        }

        return call_user_func($this->operations[$op], $a, $b);
    }
}
