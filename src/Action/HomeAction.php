<?php

namespace App\Action;

class HomeAction extends BaseAction
{
    use \App\Traits\HasEngine;
    use \App\Traits\HasCalculation;

    /**
     * Run the action
     * @return void
     */
    public function __invoke()
    {
        $this->response->content->set(
            $this->engine->render('home', [
                'operations' => $this->calculation->getOperations()
            ]));
    }
}
