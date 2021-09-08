<?php

declare(strict_types=1);

namespace Tests\Service;

use Exception;
use Tests\TestCase;

class ConversionsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testRetrieveLogs(): void
    {
        $data = [
            'range' => ['interval' => 'today'],
            'limit' => 50,
        ];
        $result = $this->keitaro->getConversions($data);
        $this->assertCount(50, $result->rows);
    }
}
