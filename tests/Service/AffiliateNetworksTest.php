<?php

declare(strict_types=1);

namespace Tests\Service;

use Exception;
use Tests\TestCase;
use Wirgen\Keitaro\Response\AffiliateNetwork;

class AffiliateNetworksTest extends TestCase
{
    private const DATA = [
        'name' => 'Test',
        'postback_url' => 'http://example.com',
        'offer_param' => 'var1=test1&var2=test2',
        'notes' => 'Test example',
    ];

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $result = $this->keitaro->getAllAffiliateNetworks();
        $this->assertContainsOnlyInstancesOf(AffiliateNetwork::class, $result);
    }

    /**
     * @throws Exception
     */
    public function testStoreExist(): void
    {
        $list = $this->keitaro->getAllAffiliateNetworks();

        $this->expectExceptionCode(406);
        $this->keitaro->createAffiliateNetwork($list[0]->name);
    }

    /**
     * @throws Exception
     */
    public function testStoreSuccess(): void
    {
        $data = self::DATA;
        $data['name'] .= '.' . microtime(true);

        $object = new AffiliateNetwork($data);
        $result = $this->keitaro->createAffiliateNetwork(...$data);
        array_map(function ($key) use ($object, $result) {
            $this->assertEquals($object->$key, $result->$key);
        }, array_keys($data));
    }

    /**
     * @throws Exception
     */
    public function testGetNotFound(): void
    {
        $this->expectExceptionCode(404);
        $this->keitaro->getAffiliateNetwork(0);
    }

    /**
     * @throws Exception
     */
    public function testGetSuccess(): void
    {
        $list = $this->keitaro->getAllAffiliateNetworks();

        $result = $this->keitaro->getAffiliateNetwork($list[0]->id);
        array_map(function ($key) use ($list, $result) {
            if ($key !== 'offers') {
                $this->assertEquals($list[0]->$key, $result->$key);
            }
        }, array_keys(get_object_vars($result)));
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $list = $this->keitaro->getAllAffiliateNetworks();

        $data = self::DATA;
        $data['name'] .= '.' . microtime(true);
        $result = $this->keitaro->updateAffiliateNetwork($list[0]->id, ...$data);
        $this->assertNotEquals($list[0], $result);
    }

    /**
     * @throws Exception
     */
    public function testArchive(): void
    {
        $list = $this->keitaro->getAllAffiliateNetworks();

        $lastKey = array_key_last($list);
        $this->keitaro->moveAffiliateNetworkToArchive($list[$lastKey]->id);
        $result = $this->keitaro->getAffiliateNetwork($list[$lastKey]->id);
        $this->assertEquals("deleted", $result->state);
    }

    /**
     * @throws Exception
     */
    public function testClone(): void
    {
        $list = $this->keitaro->getAllAffiliateNetworks();

        $lastKey = array_key_last($list);
        $result = $this->keitaro->cloneAffiliateNetwork($list[$lastKey]->id);
        array_map(function ($key) use ($list, $result, $lastKey) {
            if ($key === 'name') {
                $this->assertEquals("Copy of {$list[$lastKey]->$key}", $result->$key);
            } elseif ($key !== 'id' && $key !== 'offers') {
                $this->assertEquals($list[$lastKey]->$key, $result->$key);
            }
        }, array_keys(get_object_vars($result)));
    }
}
