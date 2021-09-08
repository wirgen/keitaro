<?php

declare(strict_types=1);

namespace Tests\Service;

use DateInterval;
use DateTime;
use Exception;
use Tests\TestCase;
use Wirgen\Keitaro\Model\Campaign;

class CampaignsTest extends TestCase
{
    private const DATA = [
        'alias' => 'test',
        'type' => 'position',
        'name' => 'Test',
        'cookies_ttl' => 24,
        'state' => 'active',
        'cost_type' => 'CPC',
        'cost_auto' => false,
        'parameters' => [
            'sub_id_1' => [
                'name' => 'sub1',
                'placeholder' => '{sub1}',
                'alias' => 'Sub1',
            ],
            'sub_id_2' => [
                'name' => 'sub2',
                'placeholder' => '{sub2}',
                'alias' => 'Sub2',
            ],
            'sub_id_3' => [
                'name' => 'sub3',
                'placeholder' => '{sub3}',
                'alias' => 'Sub3',
            ],
            'sub_id_4' => [
                'name' => 'sub4',
                'placeholder' => '{sub4}',
                'alias' => 'Sub4',
            ],
            'sub_id_5' => [
                'name' => 'sub5',
                'placeholder' => '{sub5}',
                'alias' => 'Sub5',
            ],
        ],
        'notes' => 'Test example',
    ];

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $result = $this->keitaro->getAllCampaigns();
        $this->assertContainsOnlyInstancesOf(Campaign::class, $result);
    }

    public function testEmpty(): void
    {
        try {
            $this->keitaro->createCampaign([]);
        } catch (Exception $e) {
            $this->assertEquals(406, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testStoreExist(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        try {
            $this->keitaro->createCampaign(['alias' => $list[0]->alias]);
        } catch (Exception $e) {
            $this->assertEquals(406, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testStoreSuccess(): void
    {
        $data = self::DATA;
        $data['name'] .= '.' . microtime(true);
        $data['alias'] = str_replace('.', '-', strtolower($data['name']));

        $object = new Campaign($data);
        $result = $this->keitaro->createCampaign($data);
        array_map(function ($key) use ($object, $result) {
            $this->assertEquals($object->$key, $result->$key);
        }, array_keys($data));
    }

    public function testGetNotFound(): void
    {
        try {
            $this->keitaro->getCampaign(0);
        } catch (Exception $e) {
            $this->assertEquals(404, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testGetSuccess(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        $result = $this->keitaro->getCampaign($list[0]->id);
        array_map(function ($key) use ($list, $result) {
            $this->assertEquals($list[0]->$key, $result->$key);
        }, array_keys(get_object_vars($result)));
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        $data = self::DATA;
        $data['name'] .= '.' . microtime(true);
        $data['alias'] = str_replace('.', '-', strtolower($data['name']));
        $result = $this->keitaro->updateCampaign($list[0]->id, $data);
        $this->assertNotEquals($list[0], $result);
    }

    /**
     * @throws Exception
     */
    public function testArchiveRestore(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        $lastKey = array_key_last($list);
        $this->keitaro->getCampaign($list[$lastKey]->id);

        $this->keitaro->moveCampaignToArchive($list[$lastKey]->id);
        try {
            $this->keitaro->getCampaign($list[$lastKey]->id);
        } catch (Exception $e) {
            $this->assertEquals(404, $e->getCode());
        }

        $this->keitaro->restoreCampaign($list[$lastKey]->id);
        $result = $this->keitaro->getCampaign($list[$lastKey]->id);
        $this->assertEquals("active", $result->state);
    }

    /**
     * @throws Exception
     */
    public function testIndexDeleted(): void
    {
        $result = $this->keitaro->getDeletedCampaigns();
        $this->assertNotEmpty($result);
        $this->assertContainsOnlyInstancesOf(Campaign::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testClone(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        $lastKey = array_key_last($list);
        $result = $this->keitaro->cloneCampaign($list[$lastKey]->id);
        array_map(function ($key) use ($list, $result, $lastKey) {
            if ($key === 'name') {
                $this->assertEquals("Copy of {$list[$lastKey]->$key}", $result->$key);
            } elseif (!in_array($key, ['id', 'alias', 'token', 'postbacks'])) {
                $this->assertEquals($list[$lastKey]->$key, $result->$key);
            }
        }, array_keys(get_object_vars($result)));
    }

    /**
     * @throws Exception
     */
    public function testDisableEnable(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        $lastKey = array_key_last($list);
        $this->keitaro->disableCampaign($list[$lastKey]->id);
        $result = $this->keitaro->getCampaign($list[$lastKey]->id);
        $this->assertEquals("disabled", $result->state);

        $this->keitaro->enableCampaign($list[$lastKey]->id);
        $result = $this->keitaro->getCampaign($list[$lastKey]->id);
        $this->assertEquals("active", $result->state);
    }

    /**
     * @throws Exception
     */
    public function testUpdateCosts(): void
    {
        $list = $this->keitaro->getAllCampaigns();

        $lastKey = array_key_last($list);
        $result = $this->keitaro->updateCampaignCosts($list[$lastKey]->id, [
            'start_date' => (new DateTime())->format('Y-m-d H:i'),
            'end_date' => (new DateTime())->add(new DateInterval('P1D'))->format('Y-m-d H:i'),
            'timezone' => 'Europe/Madrid',
            'cost' => '123.45',
            'currency' => 'EUR',
        ]);
        $this->assertNotEmpty($result);
    }
}
