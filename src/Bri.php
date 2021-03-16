<?php

namespace Aslam\Bri;

use Aslam\Bri\Exceptions\BriHttpException;
use Aslam\Bri\Traits;
use Illuminate\Support\Facades\Http;

class Bri
{
    use Traits\Token;
    use Traits\Information;

    /**
     * apiUrlV1
     *
     * @var mixed
     */
    protected $apiUrlV1;

    /**
     * apiUrlV2
     *
     * @var mixed
     */
    protected $apiUrlV2;

    /**
     * clientID
     *
     * @var mixed
     */
    protected $clientID;

    /**
     * clientSecret
     *
     * @var mixed
     */
    protected $clientSecret;

    /**
     * endpoint
     *
     * @var mixed
     */
    protected $endpoint;

    /**
     * Token
     *
     * @var mixed
     */
    protected $token;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct($token = null)
    {
        $this->apiUrlV1 = config('bank-bri.api_url_v1');
        $this->apiUrlV2 = config('bank-bri.api_url_v2');
        $this->clientID = config('bank-bri.client_id');
        $this->clientSecret = config('bank-bri.client_secret');
        $this->endpoint = (object) config('bank-bri.endpoint');

        $this->token = $token;
    }

    /**
     * Send the request to the given URL.
     *
     * @param  string $httpMethod
     * @param  string $requestUrl
     * @param  array $options
     * @return \Illuminate\Http\Client\Response
     *
     * @throws BriHttpException
     */
    public function sendRequest(string $httpMethod, string $requestUrl, array $options = [])
    {
        try {
            return Http::withToken($this->token)
                ->withHeaders([
                    'BRI-Timestamp' => get_timestamp(),
                    'BRI-Signature' => get_hmac_signature($requestUrl, $httpMethod, $this->token, ''),
                ])
                ->send($httpMethod, $requestUrl, $options)
                ->throw()
                ->json();

        } catch (\Exception $e) {
            return $e->response->json();
        }
    }

    /**
     * setToken
     *
     * @param  string $token
     * @return void
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
