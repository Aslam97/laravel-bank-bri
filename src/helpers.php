<?php

use Aslam\Bri\Bri;

if (!function_exists('briapi')) {

    /**
     * briapi
     *
     * @return Bri
     */
    function briapi()
    {
        return app(Bri::class);
    }
}

if (!function_exists('rtrim_recursive')) {

    /**
     * rtrim_recursive
     *
     * @param  mixed $value
     * @return void
     */
    function rtrim_recursive($value)
    {
        if (is_array($value)) {
            return array_map('rtrim_recursive', $value);
        }

        return rtrim($value, '/');
    }
}

if (!function_exists('get_hmac_signature')) {

    /**
     * Generate signature
     *
     * @param  string $requestPath
     * @param  string $httpMethod
     * @param  mixed $requestBody
     * @param  string $token
     * @return string
     */
    function get_hmac_signature(string $requestPath, string $httpMethod, $requestBody = '', string $token)
    {
        if (is_array($requestBody) && !empty($requestBody)) {
            $requestBody = json_encode($requestBody, true);
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
