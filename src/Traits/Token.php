<?php

namespace Aslam\Bri\Traits;

trait Token
{
    /**
     * Get BRI Token
     *
     * @return \Aslam\Bri\Response
     */
    public function getToken()
    {
        $requestUrl = $this->apiUrlExtra . $this->getToken;

        return $this->sendRequest('POST', $requestUrl, [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'form_params' => [
                'client_id' => $this->clientID,
                'client_secret' => $this->clientSecret,
            ],
        ]);
    }
}
