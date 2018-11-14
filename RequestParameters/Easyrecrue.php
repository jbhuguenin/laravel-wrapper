<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 10:28
 */

namespace App\Classes\ApiWrapper\RequestParameters;

/**
 * Class Easyrecrue
 * @package App\Classes\ApiWrapper\RequestParameters
 */
class Easyrecrue extends AbstractRequestParameters implements VideoInterface
{

    public function listInterview(\ExternalAccountMapping $externalAccountMapping)
    {
        return [
            'id'    => $externalAccountMapping->external_id,
            'token' => $this->getToken()
        ];
    }

    public function addInterview(\JobApplication $jobApplication, $params = [])
    {
        return [
            'email'         => $jobApplication->candidate_email,
            'first_name'    => $jobApplication->candidate_first_name,
            'last_name'    => $jobApplication->candidate_last_name,
            'campaign_id'   => $params['recruitmentId'],
            'external_data' => $params['uid'],
            'token'         => $this->getToken(),
        ];
    }

    public function listCampaigns()
    {
        return [
            'token' => $this->getToken(),
        ];
    }

    /**
     * @param \ExternalAccountMapping $externalAccountMapping
     * @return array
     */
    public function deleteInterview(\ExternalAccountMapping $externalAccountMapping)
    {
        return [
            'id' => (int) $externalAccountMapping->external_id,
            'token' => $this->getToken(),
        ];
    }

    public function publicLink(\ExternalAccountMapping $externalAccountMapping)
    {
        return [
            'applications_id' => [$externalAccountMapping->external_id],
            'validity_week' => 3,
            'token' => $this->getToken(),
        ];
    }
}