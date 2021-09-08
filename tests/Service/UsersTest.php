<?php

namespace Tests\Service;

use Exception;
use Tests\TestCase;
use Wirgen\Keitaro\Model\User;

class UsersTest extends TestCase
{
    private const DATA = [
        'login' => 'Test',
        'new_password' => 'AsDf1234',
        'new_password_confirmation' => 'AsDf1234',
        'type' => 'USER',
    ];

    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $result = $this->keitaro->getUsers();
        $this->assertContainsOnlyInstancesOf(User::class, $result);
    }

    public function testEmpty(): void
    {
        try {
            $this->keitaro->createUser([]);
        } catch (Exception $e) {
            $this->assertEquals(406, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testStoreExist(): void
    {
        $list = $this->keitaro->getUsers();

        try {
            $this->keitaro->createUser(['login' => $list[0]->login]);
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
        $data['login'] .= '.' . microtime(true);
        $data['new_password'] = $data['new_password_confirmation'] = uniqid('', true);

        $object = new User($data);
        $result = $this->keitaro->createUser($data);
        array_map(function ($key) use ($object, $result) {
            if ($key !== 'new_password' && $key !== 'new_password_confirmation') {
                $this->assertEquals($object->$key, $result->$key);
            }
        }, array_keys($data));
    }

    public function testGetNotFound(): void
    {
        try {
            $this->keitaro->getUser(0);
        } catch (Exception $e) {
            $this->assertEquals(404, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testGetSuccess(): void
    {
        $list = $this->keitaro->getUsers();

        $result = $this->keitaro->getUser($list[0]->id);
        $this->assertEquals($list[0], $result);
        array_map(function ($key) use ($list, $result) {
            $this->assertEquals($list[0]->$key, $result->$key);
        }, array_keys(get_object_vars($result)));
    }

    /**
     * @throws Exception
     */
    public function testUpdate(): void
    {
        $list = $this->keitaro->getUsers();
        $lastKey = array_key_last($list);

        $data = self::DATA;
        $data['login'] .= '.' . microtime(true);
        $data['new_password'] = $data['new_password_confirmation'] = uniqid('', true);

        try {
            $this->keitaro->updateUser($list[$lastKey]->id, $data);
        } catch (Exception $e) {
            // Not allowed in Demo
            $this->assertEquals(403, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testDelete(): void
    {
        $list = $this->keitaro->getUsers();
        $lastKey = array_key_last($list);

        try {
            $this->keitaro->removeUser($list[$lastKey]->id);
        } catch (Exception $e) {
            // Not allowed in Demo
            $this->assertEquals(403, $e->getCode());
        }
    }

    /**
     * @throws Exception
     */
    public function testUpdateAccessData(): void
    {
        $list = $this->keitaro->getUsers();
        $lastKey = array_key_last($list);

        $this->keitaro->updateUserAccessData(
            $list[$lastKey]->id,
            [
                'access_data' => [
                    'campaigns_access_type' => 'full_access',
                ],
            ]
        );
        $this->markTestIncomplete();
    }
}
