<?php

namespace App\Action;

class HomeAction extends BaseAction
{
    use \App\Traits\HasEngine;

    public function __invoke()
    {
        $this->response->content->set(
            $this->engine->render('home'));
    }
}
