<?php

namespace App\Classes\ApiWrapper\Subscriber;

use GuzzleHttp\Command\Event\ProcessEvent;
use GuzzleHttp\Command\Guzzle\Parameter;
use GuzzleHttp\Command\Guzzle\Subscriber\ProcessResponse as AbstractProcessResponse;
use GuzzleHttp\Message\ResponseInterface;

/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 13:20
 */

class ProcessResponse extends AbstractProcessResponse
{
    protected $methodName;
    /**
     * @param Parameter $model
     * @param ProcessEvent $event
     * @return array
     */
    protected function visit(Parameter $model, ProcessEvent $event)
    {
        $this->methodName = $event->getCommand()->getName();

        if ($model->getType() === 'class') {
            $result = $this->visitOuterClass($model, $event);
        } else {
            $result = parent::visit($model, $event);
        }

        return $result;
    }

    /**
     * @param Parameter $model
     * @param ProcessEvent $event
     * @return mixed
     */
    private function visitOuterClass(Parameter $model, ProcessEvent $event) {

        if(!$className = $model->getData('className')) {
            throw new \InvalidArgumentException('Unknown className: ' . $className);
        }

        if (!class_exists($className)) {
            throw new \InvalidArgumentException('Class does not exist: ' . $className);
        }

        $class = new $className($event);

        $method = $this->methodName;

        if (!method_exists($class, $method)) {
            throw new \InvalidArgumentException(sprintf('method %s does not exist for class %s', $method, $className));
        }

        return $class->$method();
    }


}