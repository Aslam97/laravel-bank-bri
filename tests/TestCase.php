<?php

namespace Aslam\Bri\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUP(): void
    {
        parent::setUp();
    }
}
