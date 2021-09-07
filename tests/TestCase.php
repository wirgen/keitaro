<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Wirgen\Keitaro\Keitaro;

abstract class TestCase extends BaseTestCase
{
    protected $keitaro;

    public function setup(): void
    {
        $this->keitaro = new Keitaro(getenv('KEITARO_API_PATH'), getenv('KEITARO_API_KEY'));
    }
}
