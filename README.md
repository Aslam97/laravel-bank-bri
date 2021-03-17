# Laravel Bank BRI API

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/aslam/bank-bri.svg?style=flat-square)](https://packagist.org/packages/aslam/bank-bri)

- [Introduction](#introduction)
- [Installation](#installation)
- [Usage](#usage)

<a name="introduction"></a>

## Introduction

Laravel PHP library to integrate your Application with Bank BRI (Bank Republic Indonesia). For clearer and more complete documentation, please visit the official website [Developer BRI](https://developers.bri.co.id)

<a name="installation"></a>

## Installation

Require this package with composer.

```bash
composer require aslam/bank-bri
```

Publish BRI config

```bash
php artisan vendor:publish --provider="Aslam\Bri\Providers\BriServiceProvider"
```

<a name="usage"></a>

## Usage

```php
use BriAPI;

$getToken = BriAPI::getToken()->toJson();

$getToken['access_token'];
$getToken['expires_in'];

// instead of requesting access_token everytime you make an API call
// you should put the access token (first time you generate token) in your database
// later you can check if token exists and not expired. then use token from database

$bri = BriAPI::setToken($accessToken);

/**
 * Informational
 */

/**
 * Check your company account information, including account name, balance, and status.
 */
$accountInformation = $bri->accountInformation()->toJson();

/**
 * Display transaction history of your company account with a maximum period of one month for each request.
 *
 * @param string $startDate
 * @param string $endDate
 */
$accountTransactionHistory = $bri->accountTransactionHistory('01-03-2017', '01-04-2017')->toJson();

/**
 * Transactional
 */

/**
 * Create BRIVA
 *
 * @param array
 */
$createBriva = $bri->createBriva([
    'brivaNo' => '77777',
    'custCode' => '123456789115',
    'nama' => 'Sabrina',
    'amount' => '100000',
    'keterangan' => 'Testing BRIVA',
    'expiredDate' => '2020-02-27 23:59:00',
])->toJson();

/**
 * Get BRIVA information that has been created.
 *
 * @param string $briva_no
 * @param string $customer_code
 */
$getBriva = $bri->getBriva('77777', '123456789001')->toJson();

/**
 * Get payment status of an existing BRIVA account.
 *
 * @param string $briva_no
 * @param string $customer_code
 */
$getStatusBriva = $bri->getStatusBriva('77777', '123456789001')->toJson();

/**
 * Manage payment status of an existing BRIVA account
 *
 * @param array
 * @param string $statusBayar Y|N
 */
$updateStatusBriva = $bri->updateStatusBriva([
    'brivaNo' => '77777',
    'custCode' => '123456789001',
    'statusBayar' => 'Y',
])->toJson();

/**
 * Update existing BRIVA account.
 *
 * @param array
 */
$updateBriva = $bri->updateBriva([
    'brivaNo' => '77777',
    'custCode' => '123456789115',
    'nama' => 'Brigita',
    'amount' => '1000000',
    'keterangan' => "BRIVA Testing",
    'expiredDate' => "2020-03-10 23:59:00",
])->toJson();

/**
 * Delete BRIVA
 *
 * @param string $briva_no
 * @param string $cust_code
 */
$deleteBriva = $bri->deleteBriva('77777', '123456789115')->toJson();

/**
 *  This package also exposes a helper function you can use if you are not a fan of Facades
 *  Shorter, expressive, fluent using the
 *  briapi() function
 */

$getToken = briapi()->getToken()->toJson();
$accountInformation = briapi()->setToken($getToken['access_token'])
    ->accountInformation()
    ->toJson();
```

The API method returns an instance of Aslam\Bri\Response, which provides a variety of methods that may be used to inspect the response:

```php
method()->body() : string;
method()->toJson() : array|mixed;
method()->collect() :  // Illuminate\Support\Collection;
method()->status() : int;
method()->ok() : bool;
method()->successful() : bool;
method()->failed() : bool;
method()->serverError() : bool;
method()->clientError() : bool;
method()->header($header) : string;
method()->headers() : array;
```
