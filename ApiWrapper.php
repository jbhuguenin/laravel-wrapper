<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 13:42
 */

namespace App\Classes\ApiWrapper;

use App\Classes\ApiWrapper\Subscriber\ProcessResponse;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\Command\Guzzle\GuzzleClient;

/**
 * Class ApiWrapper
 * @package App\Classes\ApiWrapper
 */
class ApiWrapper extends GuzzleClient
{

    private $description;

    /**
     *
     * @param \GuzzleHttp\ClientInterface $config
     */
    public function __construct($config)
    {
        $configClient = (isset($config['client'])) ? $config['client'] : [];
        $client = new Client($configClient);

        if (! isset($config['description'])) {
            throw new \RuntimeException('missing description configuration');
        }

        $this->description = new Description($config['description']);
        parent::__construct($client, $this->getDescription(), ['process' => false]);
    }

    /**
     * @return Description|\GuzzleHttp\Command\Guzzle\DescriptionInterface
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Prepares the client based on the configuration settings of the client.
     *
     * @param array $config Constructor config as an array
     */
    protected function processConfig(array $config)
    {
        $emitter = $this->getEmitter();
        $emitter->attach(
            new ProcessResponse(
                $this->description,
                isset($config['response_locations'])
                    ? $config['response_locations']
                    : []
            )
        );

        parent::processConfig($config);
    }
}