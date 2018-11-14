<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 27/06/2018
 * Time: 09:53
 */

namespace App\Classes\ApiWrapper\RequestParameters;

/**
 * Class AbstractRequestParameters
 * @package App\Classes\ApiWrapper\RequestParameters
 */
abstract class AbstractRequestParameters
{
    /**
     * @var \ExternalAccount
     */
    protected $externalAccount;

    /**
     * AbstractParameters constructor.
     * @param \ExternalAccount $externalAccount
     */
    public function __construct(\ExternalAccount $externalAccount)
    {
        $this->externalAccount = $externalAccount;

        return $this;
    }

    /**
     * @return mixed
     */
    protected function getToken()
    {
        if($this->externalAccount->secret) {
            return $this->externalAccount->secret;
        }

        $cacheKey = sprintf('apiwrapper::token::%s', $this->externalAccount->api_login);
        if(!$token = \Cache::get($cacheKey)) {
            $token = $this->authenticate();
            \Cache::put($cacheKey, $token, 60*24*21);
        }

        return $token;
    }

    /**
     * @return mixed
     */
    protected function authenticate()
    {
        $response = app(sprintf('apiwrapper.%s', $this->externalAccount->name))->authenticate([
            'email'     => $this->externalAccount->api_login,
            'password'  => $this->externalAccount->api_password
        ]);

        return $response['token'];
    }
}