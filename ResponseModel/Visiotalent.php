<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 13:42
 */

namespace App\Classes\ApiWrapper\ResponseModel;

/**
 * Class Visiotalent
 * @package App\Classes\ApiWrapper\ResponseModel
 */
class Visiotalent extends AbstractResponseModel implements VideoInterface
{

    /**
     * @return array
     */
    public function listInterviews()
    {
        return [
            'id'                => $this->response->json()['id'],
            'thumbUrl'          => $this->response->json()['thumbUrl'],
            'iframeLink'        => $this->response->json()['iframe_link'],
            'campaignTitle'     => $this->response->json()['recruitment']['title']
        ];
    }

    /**
     * @throws \Exception
     */
    public function createInterviews()
    {
        $formatedResponse = array_values($this->response->json())[0];

        if($formatedResponse['http_code'] != '200 - OK') {
            throw new \Exception($formatedResponse['message']);
        }

        $result['externalId'] = $formatedResponse['interview_id'];
        return $result;
    }

    /**
     * @return array
     */
    public function listCampaigns()
    {
        return array_column($this->response->json(), 'title', 'id');
    }
}