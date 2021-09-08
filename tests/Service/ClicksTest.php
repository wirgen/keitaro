<?php

declare(strict_types=1);

namespace Tests\Service;

use DateInterval;
use DateTime;
use Exception;
use Tests\TestCase;

class ClicksTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testCleanStats(): void
    {
        try {
            $this->keitaro->cleanStats(
                [
                    'start_date' => (new DateTime())->sub(new DateInterval('P7D'))->format('Y-m-d H:i'),
                    'end_date' => (new DateTime())->format('Y-m-d H:i'),
                    'timezone' => 'Europe/Madrid',
                ]
            );
        } catch (Exception $e) {
            // Not allowed in Demo
            $this->assertEquals(403, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testRetrieveLogs(): void
    {
        $data = [
            'range' => ['interval' => 'today'],
            'limit' => 50,
        ];
        $result = $this->keitaro->retrieveClickLog($data);
        $this->assertCount(50, $result->rows);
        $this->assertGreaterThanOrEqual(
            (new DateTime())->setTime(0, 0),
            new DateTime($result->rows[0]['datetime'])
        );
    }

    /**
     * @throws Exception
     */
    public function testUpdateCosts(): void
    {
        $result = $this->keitaro->getAllCampaigns();
        $lastKey = array_key_last($result);

        $data = [
            'campaign_ids' => [$result[$lastKey]->id],
            'costs' => [
                'start_date' => (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d H:i'),
                'end_date' => (new DateTime())->format('Y-m-d H:i'),
                'cost' => '12.345',
            ],
            'currency' => 'USD',
        ];
//        var_dump($data);
        $this->keitaro->updateClicksCosts($data);

        $data = [
            'range' => ['interval' => 'today'],
            'limit' => 1,
            'filters' => [
                [
                    'name' => 'campaign_id',
                    'operator' => 'EQUALS',
                    'expression' => $result[$lastKey]->id,
                ],
            ],
        ];
        $result = $this->keitaro->retrieveClickLog($data);

        $this->markTestIncomplete();
//        var_dump($result->rows[0]['campaign_id']);
//        var_dump($result->rows[0]['datetime']);
//        var_dump($result->rows[0]['cost']);
    }
}
