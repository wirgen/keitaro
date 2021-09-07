<?php

declare(strict_types=1);

namespace Tests\Service;

use Exception;
use Tests\TestCase;
use Wirgen\Keitaro\Response\Campaign;

class CampaignsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $result = $this->keitaro->getAllCampaigns();
        $this->assertContainsOnlyInstancesOf(Campaign::class, $result);
    }
}
