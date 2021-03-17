<?php

return [
    'api_url_v1' => env('BRI_API_URL_V1', 'https://sandbox.partner.api.bri.co.id'),
    'api_url_v2' => env('BRI_API_URL_V2', 'https://partner.api.bri.co.id/sandbox'),
    'client_id' => env('BRI_CLIENT_ID'),
    'client_secret' => env('BRI_CLIENT_SECRET'),

    //
    'account_number' => env('BRI_ACCOUNT_NUMBER', '888801000157508'),

    'endpoint' => [
        'get_token' => '/oauth/client_credential/accesstoken?grant_type=client_credentials',

        // Account Information
        'account_information' => '/v2/inquiry/' . env('BRI_ACCOUNT_NUMBER', '888801000157508'),
        'account_transaction_history' => '/v1/statement/' . env('BRI_ACCOUNT_NUMBER', '888801000157508'),

        // BRIVA (BRI Virtual Account)
        'briva' => '/v1/briva',
    ],
];
