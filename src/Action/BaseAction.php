<?php

namespace App\Action;

abstract class BaseAction
{
    public function __construct(\Aura\Web\Request $request, \Aura\Web\Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
