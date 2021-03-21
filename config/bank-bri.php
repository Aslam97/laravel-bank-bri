<?php

return [
    'api_url_v1' => env('BRI_API_URL_V1', 'https://sandbox.partner.api.bri.co.id'),
    'api_url_v2' => env('BRI_API_URL_V2', 'https://partner.api.bri.co.id/sandbox'),
    'client_id' => env('BRI_CLIENT_ID', 'AhkqwhpO8GAWGqY1vbZpa3vSWnj1KK9S'),
    'client_secret' => env('BRI_CLIENT_SECRET', 'vGsfo8oMzbRPf2t4'),

    'account_number' => env('BRI_ACCOUNT_NUMBER', '888801000157508'),
    'institution_code' => env('BRI_INSTITUTION_CODE', 'J104408'),

    'endpoint' => [
        'get_token' => '/oauth/client_credential/accesstoken?grant_type=client_credentials',

        // Account Information
        'account_information' => '/v2/inquiry',
        'account_transaction_history' => '/v1/statement',

        // BRIVA (BRI Virtual Account)
        'briva' => '/v1/briva',
        'briva_status' => '/v1/briva/status',
        'briva_report' => '/v1/briva/report',
        'briva_report_time' => '/v1/briva/report_time',
    ],
];
