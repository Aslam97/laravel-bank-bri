<?php

if (!function_exists('get_hmac_signature')) {

    /**
     * Generate signature
     *
     * @param  mixed $requestPath
     * @param  mixed $httpMethod
     * @param  mixed $token
     * @param  mixed $requestBody
     * @return string
     */
    function get_hmac_signature(string $requestPath, string $httpMethod, string $token, string $requestBody)
    {
        if (strtoupper($httpMethod) === 'GET' || !$requestBody) {
            $requestBody = '';
        }

        $requestPath = parse_url($requestPath)['path'];

        $payload = sprintf(
            'path=%s&verb=%s&token=Bearer %s&timestamp=%s&body=%s',
            $requestPath,
            $httpMethod,
            $token,
            get_timestamp(),
            $requestBody
        );

        $hmacSignature = base64_encode(hash_hmac('sha256', $payload, config('bank-bri.client_secret'), true));

        return $hmacSignature;
    }
}

if (!function_exists('get_timestamp')) {

    /**
     * Generate timestamp UTC Zulu
     *
     * @return string
     */
    function get_timestamp()
    {
        return gmdate("Y-m-d\TH:i:s.000\Z");
    }
}
