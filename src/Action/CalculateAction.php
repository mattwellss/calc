<?php

namespace App\Action;

class CalculateAction extends BaseAction
{
    use \App\Traits\HasFilter;
    use \App\Traits\HasCalculation;

    public function __invoke()
    {
        $this->response->headers->set('Content-type', 'application/json');

        $post = (array)$this->request->post;
        $valid = $this->filter->values($post);

        if ($valid) {
            try {
                $operation = $this->calculation->getOperation($post['operation']);
                $result = $operation($post['number1'], $post['number2']);
                $this->response->content->set(json_encode([
                    'ok' => true,
                    'result' => $result]));
                return;
            } catch (\Exception $e) {
                //no operation?
            }
        }
        $this->response->headers->set('Status', 400);
        $this->response->content->set(json_encode([
            'ok' => false,
            'result' => $this->filter->getMessages()]));
    }
}
