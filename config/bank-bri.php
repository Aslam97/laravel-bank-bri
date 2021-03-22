<?php

return [
    'api_url' => env('BRI_API_URL', 'https://partner.api.bri.co.id/sandbox'),
    'api_url_extra' => env('BRI_API_URL_EXTRA', 'https://sandbox.partner.api.bri.co.id'),

    'client_id' => env('BRI_CLIENT_ID', 'AhkqwhpO8GAWGqY1vbZpa3vSWnj1KK9S'),
    'client_secret' => env('BRI_CLIENT_SECRET', 'vGsfo8oMzbRPf2t4'),

    'account_number' => env('BRI_ACCOUNT_NUMBER', '888801000157508'),
    'institution_code' => env('BRI_INSTITUTION_CODE', 'J104408'),

    'get_token' => '/oauth/client_credential/accesstoken?grant_type=client_credentials',
    'get_location' => '/v1/location/near/atm/1',

    'account' => [
        'information' => '/v2/inquiry',
        'transaction_history' => '/v1/statement',
    ],

    'briva' => [
        'store' => '/v1/briva',
        'show' => '/v1/briva',
        'update' => '/v1/briva',
        'destroy' => '/v1/briva',
        'status' => '/v1/briva/status',
        'report' => '/v1/briva/report',
        'report_time' => '/v1/briva/report_time',
    ],

    'brizzi' => [
        'validate_card_number' => '/v1/brizzi/topup/checknum',
        'topup' => '/v1/brizzi/topup',
        'check_topup_status' => '/v1/brizzi/checktrx',
    ],

    'fund_transfer_internal' => [
        'account_validation' => '/v3/transfer/internal/accounts',
        'transfer' => '/v3/transfer/internal',
        'check_status' => '/v3/transfer/internal/accounts',
    ],

    'fund_transfer_external' => [
        'account_validation' => '/v2/transfer/external/accounts',
        'transfer' => '/v2/transfer/external',
        'list_bank_code' => '/v2/transfer/external/accounts',
    ],

    'direct_debit' => [],

    'foreign_exchange' => [
        'currency_rate' => '/v1/valas/getrate',
        'forex_transaction' => '/v1/valas/insert',
    ],
];
