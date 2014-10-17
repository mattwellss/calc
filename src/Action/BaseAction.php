<?php

namespace App\Action;

abstract class BaseAction
{
    /**
     * Initialize the Action with request and response objects
     * @param \Aura\Web\Request  $request
     * @param \Aura\Web\Response $response
     */
    public function __construct(\Aura\Web\Request $request, \Aura\Web\Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
