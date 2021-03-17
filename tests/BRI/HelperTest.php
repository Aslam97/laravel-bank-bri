<?php

namespace Aslam\Bri\Tests\Unit;

use Aslam\Bri\Tests\TestCase;

class HelperTest extends TestCase
{
    public function test_rtrim_endpoint()
    {
        $endpoint = [
            'url' => 'https://url.com/',
            'url_one' => '/url_one',
            'url_two' => '/url_two/',
        ];

        $expected = [
            'url' => 'https://url.com',
            'url_one' => '/url_one',
            'url_two' => '/url_two',
        ];

        $response = rtrim_endpoint($endpoint);

        $this->assertEquals($expected, $response);
    }
}
