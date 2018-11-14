<?php
/**
 * Created by PhpStorm.
 * User: jean-baptiste
 * Date: 28/06/2018
 * Time: 14:55
 */

namespace App\Classes\ApiWrapper\ResponseModel;

/**
 * Class Easyrecrue
 * @package App\Classes\ApiWrapper\ResponseModel
 */
class Easyrecrue extends AbstractResponseModel implements VideoInterface
{
    /**
     * @return mixed
     * @throws \Exception
     */
    public function createInterviews()
    {
        $formatedResponse = $this->response->json();

        if($formatedResponse['status'] != 'ok') {
            throw new \Exception();
        }

        $id = pathinfo($formatedResponse['candidate']['app_link'])['basename'];
        $result['externalId'] = $id;
        return $result;
    }

    /**
     * @return array
     */
    public function listInterviews()
    {
        return [
            'id'                => $this->response->json()['application']['id'],
            'thumbUrl'          => $this->response->json()['application']['avatar'],
            'iframeLink'        => route('api::v1::video.content') .'?url=' . urlencode($this->getPublicLink()),
            'campaignTitle'     => $this->response->json()['application']['campaign']['name']
        ];
    }

    /**
     * @return array
     */
    public function listCampaigns()
    {
        return array_column($this->response->json()['campaigns'], 'name', 'id');
    }

    /**
     * @return mixed
     */
    public function deleteInterview()
    {
        return $this->response->json();
    }

    /**
     * @return array
     */
    public function authenticate()
    {
        return ['token' => $this->response->json()['token']];
    }

    /**
     * @return array
     */
    public function publicLink()
    {
        return $this->response->json()['share']['link'];
    }

    /**
     * @return mixed
     */
    protected function getPublicLink()
    {
        $cacheKey = sprintf('apiwrapper::iframeLink::%s', $this->response->json()['application']['id']);

        if(!$publicLink = \Cache::get($cacheKey)) {

            $response = $this->client->publicLink([
                'applications_id' => [$this->response->json()['application']['id']],
                'validity_week' => 3,
                'token' => $this->command->offsetGet('token'),
            ]);

            $publicLink = $response;
            \Cache::put($cacheKey, $publicLink, 60*24*20);
        }


        return $publicLink;
    }
}