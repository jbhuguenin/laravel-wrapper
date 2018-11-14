<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 13:42
 */

namespace App\Classes\ApiWrapper\ResponseModel;

use GuzzleHttp\Command\Event\ProcessEvent;

/**
 * Class AbstractResponseModel
 * @package App\Classes\ApiWrapper\ResponseModel
 */
abstract class AbstractResponseModel
{
    /** @var $response \GuzzleHttp\Message\ResponseInterface|null  */
    protected $response;

    /** @var $command \GuzzleHttp\Command\CommandInterface  */
    protected $command;

    /** @var $client \GuzzleHttp\Command\ServiceClientInterface  */
    protected $client;

    /**
     * AbstractResponseModel constructor.
     * @param ProcessEvent $event
     */
    public function __construct(ProcessEvent $event)
    {
        $this->response = $event->getResponse();
        $this->command = $event->getCommand();
        $this->client = $event->getClient();
    }
}