<?php

declare(strict_types=1);

namespace Tests\Service;

use DateTime;
use Exception;
use Tests\TestCase;

class ReportsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testBuildReport(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        $data = [
            'range' => ['interval' => 'today'],
            'metrics' => ['campaign_id', 'datetime'],
            'filters' => [
                [
                    'name' => 'campaign_id',
                    'operator' => 'EQUALS',
                    'expression' => $list[0]->id,
                ],
            ],
        ];
        $result = $this->keitaro->buildCustomReport($data);
        $this->assertEquals($list[0]->id, $result->rows[0]['campaign_id']);
        $this->assertGreaterThanOrEqual(
            (new DateTime())->setTime(0, 0),
            new DateTime($result->rows[0]['datetime'])
        );
    }
}
