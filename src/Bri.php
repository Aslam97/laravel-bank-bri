<?php

namespace Aslam\Bri;

use Aslam\Bri\Exceptions\ConnectionException;
use Aslam\Bri\Exceptions\RequestException;
use Aslam\Bri\Traits;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;

class Bri
{
    use Traits\Token;
    use Traits\Information;
    use Traits\BRIVA;
    use Traits\FundTransferInternal;

    private $apiUrl;

    private $apiUrlExtra;

    private $clientID;

    private $clientSecret;

    private $accountNumber;

    private $institutionCode;

    private $token;

    private $getToken;

    private $account;

    private $briva;

    private $brizzi;

    private $fundTransferInternal;

    private $fundTransferExternal;

    private $directDebit;

    private $foreignExchange;

    /**
     * Initiate bri API config
     *
     * @return void
     */
    public function __construct($token = null)
    {
        $this->apiUrl = config('bank-bri.api_url');
        $this->apiUrlExtra = config('bank-bri.api_url_extra');
        $this->clientID = config('bank-bri.client_id');
        $this->clientSecret = config('bank-bri.client_secret');
        $this->accountNumber = config('bank-bri.account_number');
        $this->institutionCode = config('bank-bri.institution_code');
        $this->token = $token;

        $this->getToken = config('bank-bri.get_token');
        $this->account = (object) rtrim_recursive(config('bank-bri.account'));
        $this->briva = (object) rtrim_recursive(config('bank-bri.briva'));
        $this->brizzi = (object) rtrim_recursive(config('bank-bri.brizzi'));
        $this->fundTransferInternal = (object) rtrim_recursive(config('bank-bri.fund_transfer_internal'));
        $this->fundTransferExternal = (object) rtrim_recursive(config('bank-bri.fund_transfer_external'));
        $this->directDebit = (object) rtrim_recursive(config('bank-bri.direct_debit'));
        $this->foreignExchange = (object) rtrim_recursive(config('bank-bri.foreign_exchange'));
    }

    /**
     * Send the request to the given URL.
     *
     * @param  string $httpMethod
     * @param  string $requestUrl
     * @param  string|array $data
     * @return \Aslam\Bri\Response
     *
     * @throws \Aslam\Bri\Exceptions\RequestException
     */
    public function sendRequest(string $httpMethod, string $requestUrl, $data = '')
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

                if ($method === 'DELETE') {
                    $options['body'] = $data;
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
     * @param string $token
     * @return $this
     */
    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * setAccountNumber
     *
     * @param  string $accountNumber
     * @return $this
     */
    public function setAccountNumber(string $accountNumber)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * setInstitutionCode
     *
     * @param string $institutionCode
     * @return $this
     */
    public function setInstitutionCode(string $institutionCode)
    {
        $this->institutionCode = $institutionCode;

        return $this;
    }
}
