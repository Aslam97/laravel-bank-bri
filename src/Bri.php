<?php

namespace Aslam\Bri;

use Aslam\Bri\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class Bri
{
    use Traits\Token;
    use Traits\Information;
    use Traits\BRIVA;

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
     * Initiate bri API config
     *
     * @return void
     */
    public function __construct($token = null)
    {
        $this->apiUrlV1 = config('bank-bri.api_url_v1');
        $this->apiUrlV2 = config('bank-bri.api_url_v2');
        $this->clientID = config('bank-bri.client_id');
        $this->clientSecret = config('bank-bri.client_secret');
        $this->endpoint = (object) rtrim_endpoint(config('bank-bri.endpoint'));

        $this->token = $token;
    }

    /**
     * Send the request to the given URL.
     *
     * @param  string $httpMethod
     * @param  string $requestUrl
     * @param  array $options
     * @return \Aslam\Bri\Response
     *
     * @throws RequestException
     */
    public function sendRequest(string $httpMethod, string $requestUrl, array $data = [])
    {
        try {
            $options = ['http_errors' => false];

            if (!$this->token) {
                $options = array_merge($options, $data);
            } else {
                $options['headers'] = [
                    'Authorization' => 'Bearer ' . $this->token,
                    'BRI-Timestamp' => get_timestamp(),
                    'BRI-Signature' => get_hmac_signature($requestUrl, $httpMethod, $data, $this->token),
                ];

                $method = strtoupper($httpMethod);
                $methods = ['POST', 'PUT', 'PATCH'];

                if (in_array($method, $methods)) {
                    $options['headers']['Content-Type'] = 'application/json';
                    $options['json'] = $data;
                }
            }

            return tap(
                new Response(
                    (new Client())->request($httpMethod, $requestUrl, $options)
                ),
                function ($response) {
                    if (!$response->successful()) {
                        $response->throw();
                    }
                }
            );

        } catch (ConnectException $e) {
            throw new ConnectionException($e->getMessage(), 0, $e);
        } catch (RequestException $e) {
            return $e->response;
        }
    }

    /**
     * setToken
     *
     * @param  string $token
     * @return
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }
}
