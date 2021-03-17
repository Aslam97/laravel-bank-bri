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

// informational
$accountInformation = $bri->accountInformation()->toJson();
$accountTransactionHistory = $bri->accountTransactionHistory($startDate, $endDate)->toJson();

/**
 * BRIVA (BRI Virtual Account)
 */

// create VA
$brivaCreateVA = $bri->createBriva([
    'institutionCode' => 'J104408',
    'brivaNo' => '77777',
    'custCode' => '123456789115',
    'nama' => 'Sabrina',
    'amount' => '100000',
    'keterangan' => 'Testing BRIVA',
    'expiredDate' => '2020-02-27 23:59:00',
])->toJson();
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
