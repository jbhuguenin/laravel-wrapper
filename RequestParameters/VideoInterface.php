<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 14:51
 */

namespace App\Classes\ApiWrapper\RequestParameters;

/**
 * Interface VideoInterface
 * @package App\Classes\ApiWrapper\RequestParameters
 */
interface VideoInterface
{
    /**
     * @param \ExternalAccountMapping $externalAccountMapping
     * @return mixed
     */
    public function listInterview(\ExternalAccountMapping $externalAccountMapping);

    /**
     * @param \JobApplication $jobApplication
     * @param array $params
     * @return mixed
     */
    public function addInterview(\JobApplication $jobApplication, $params = []);

    /**
     * @return mixed
     */
    public function listCampaigns();
}