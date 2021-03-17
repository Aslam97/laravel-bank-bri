<?php

namespace Aslam\Bri\Traits;

use Exception;
use Illuminate\Support\Facades\Http;

trait Token
{
    /**
     * Get BRI Token
     *
     * @return \Aslam\Bri\Response
     */
    public function getToken()
    {
        try {

            $url = $this->apiUrlV1 . $this->endpoint->get_token;

            return Http::asForm()
                ->post($url, [
                    'client_id' => $this->clientID,
                    'client_secret' => $this->clientSecret,
                ])
                ->throw()
                ->json();

        } catch (Exception $e) {
            return $e->response->json();
        }
    }
}
