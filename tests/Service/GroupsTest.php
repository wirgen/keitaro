<?php

declare(strict_types=1);

namespace Tests\Service;

use Exception;
use Tests\TestCase;
use Wirgen\Keitaro\Model\Group;

class GroupsTest extends TestCase
{
    private const DATA = [
        'name' => 'Test',
        'position' => 1,
        'type' => 'campaigns',
    ];

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $result = $this->keitaro->getGroups();
        $this->assertContainsOnlyInstancesOf(Group::class, $result);
    }

    public function testEmpty(): void
    {
        try {
            $this->keitaro->createGroup([]);
        } catch (Exception $e) {
            $this->assertEquals(500, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testStoreExist(): void
    {
        $list = $this->keitaro->getGroups();

        try {
            $this->keitaro->createGroup(
                [
                    'name' => $list[0]->name,
                    'type' => 'campaigns',
                ]
            );
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

        $object = new Group($data);
        $result = $this->keitaro->createGroup($data);
        array_map(function ($key) use ($object, $result) {
            if ($key !== 'position') {
                $this->assertEquals($object->$key, $result->$key);
            }
        }, array_keys($data));
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $list = $this->keitaro->getGroups();
        $lastKey = array_key_last($list);

        $data = self::DATA;
        $data['name'] .= '.' . microtime(true);
        $result = $this->keitaro->updateGroup($list[$lastKey]->id, $data);
        $this->assertNotEquals($list[$lastKey], $result);
    }

    /**
     * @throws Exception
     */
    public function testDelete(): void
    {
        $list = $this->keitaro->getGroups();
        $lastKey = array_key_last($list);

        $this->keitaro->deleteGroup($list[$lastKey]->id);
        $groupIds = [];
        array_map(static function ($item) use (&$groupIds) {
            $groupIds[] = $item->id;
        }, $this->keitaro->getGroups());
        $this->assertNotContains($list[$lastKey]->id, $groupIds);
    }
}
