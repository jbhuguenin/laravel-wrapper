<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 10:05
 */

namespace App\Classes\ApiWrapper\RequestParameters;

/**
 * Class Visiotalent
 * @package App\Classes\ApiWrapper\RequestParameters
 */
class Visiotalent extends AbstractRequestParameters implements VideoInterface
{
    /**
     * @param \ExternalAccountMapping $externalAccountMapping
     * @return array
     */
    public function listInterview(\ExternalAccountMapping $externalAccountMapping)
    {
        return [
            'userId'        => $externalAccountMapping->extraData()->userId,
            'recruitmentId' => $externalAccountMapping->extraData()->recruitmentId,
            'interviewId'   => $externalAccountMapping->external_id,
            'token'         => $this->getToken()
        ];
    }

    /**
     * @param \JobApplication $jobApplication
     * @param array $params
     * @return array
     */
    public function addInterview(\JobApplication $jobApplication, $params = [])
    {
        $additionalInformations = json_decode($this->externalAccount->additional_informations, true);

        $interviewData = [
            'firstName'     => $jobApplication->candidate_first_name,
            'lastName'      => $jobApplication->candidate_last_name,
            'email'         => $jobApplication->candidate_email,
            'gender'        => (int) $jobApplication->candidate_gender,
            'assessmentID'  => $params['uid']
        ];

        return [
            'userId'         => $additionalInformations['userId'],
            'recruitementId' => $params['recruitmentId'],
            'token'          => $this->getToken(),
            'interviews'     => [$interviewData]
        ];
    }

    /**
     * @return array
     */
    public function ListCampaigns()
    {
        $additionalInformations = json_decode($this->externalAccount->additional_informations, true);

        return [
            'userId'         => $additionalInformations['userId'],
            'token'          => $this->getToken(),
        ];
    }
}