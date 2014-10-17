<?php
namespace Aura\Framework_Project\_Config;

use Aura\Di\Config;
use Aura\Di\Container;

class Common extends Config
{
    public function define(Container $di)
    {
        $di->set('aura/project-kernel:logger', $di->lazyNew('Monolog\Logger'));
        $di->set('calculate/input-filter', (new \Aura\Filter\FilterFactory)->newInstance());
        $di->set('calculate/calculation', $di->lazyNew('Calculate\Calculation'));
        $di->set('league/plates:engine', $di->lazyNew('League\Plates\Engine'));

        $di->params['League\Plates\Engine'] = [
            'directory' => $di->get('project')->getPath('views'),
            'fileExtension' => 'html'
        ];

        $di->params['App\Action\BaseAction'] = [
            'request' => $di->lazyGet('aura/web-kernel:request'),
            'response' => $di->lazyGet('aura/web-kernel:response')
        ];

        $di->setter['App\Traits\HasFilter'] = [
            'setFilter' => $di->lazyGet('calculate/input-filter')
        ];

        $di->setter['App\Traits\HasCalculation'] = [
            'setCalculation' => $di->lazyGet('calculate/calculation')
        ];

        $di->setter['App\Traits\HasEngine'] = [
            'setEngine' => $di->lazyGet('league/plates:engine')
        ];
    }

    public function modify(Container $di)
    {
        $this->modifyLogger($di);
        $this->modifyCliDispatcher($di);
        $this->modifyWebRouter($di);
        $this->modifyWebDispatcher($di);
        $this->modifyFilters($di);
        $this->modifyCalculation($di);
    }

    protected function modifyFilters(Container $di)
    {
        $filter = $di->get('calculate/input-filter');

        $filter->addSoftRule('number1', $filter::IS, 'float');
        $filter->addSoftRule('number2', $filter::IS, 'float');
    }

    protected function modifyCalculation(Container $di)
    {
        $calculation = $di->get('calculate/calculation');

        $calculation->addOperation(new \Calculate\AddOperation);
        $calculation->addOperation(new \Calculate\SubtractOperation);
        $calculation->addOperation(new \Calculate\MultiplyOperation);
        $calculation->addOperation(new \Calculate\DivideOperation);
    }

    protected function modifyLogger(Container $di)
    {
        $project = $di->get('project');
        $mode = $project->getMode();
        $file = $project->getPath("tmp/log/{$mode}.log");

        $logger = $di->get('aura/project-kernel:logger');
        $logger->pushHandler($di->newInstance(
            'Monolog\Handler\StreamHandler',
            array(
                'stream' => $file,
            )
        ));
    }

    protected function modifyCliDispatcher(Container $di)
    {
        $context = $di->get('aura/cli-kernel:context');
        $stdio = $di->get('aura/cli-kernel:stdio');
        $logger = $di->get('aura/project-kernel:logger');
        $dispatcher = $di->get('aura/cli-kernel:dispatcher');
        $dispatcher->setObject(
            'hello',
            function ($name = 'World') use ($context, $stdio, $logger) {
                $stdio->outln("Hello {$name}!");
                $logger->debug("Said hello to '{$name}'");
            }
        );
    }

    public function modifyWebRouter(Container $di)
    {
        /**
         * @var Aura\Router\Router
         */
        $router = $di->get('aura/web-kernel:router');

        $router->add('home', '/')
               ->setValues(array('action' => 'home'));

        $router
            ->addPost('calculate', '/calculate')
            ->setValues(array('action' => 'calculate'));

    }

    public function modifyWebDispatcher($di)
    {
        $dispatcher = $di->get('aura/web-kernel:dispatcher');

        $dispatcher->setObject('home', $di->lazyNew('App\Action\HomeAction'));
        $dispatcher->setObject('calculate', $di->lazyNew('App\Action\CalculateAction'));
    }
}
