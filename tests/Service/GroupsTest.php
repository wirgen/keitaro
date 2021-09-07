<?php

declare(strict_types=1);

namespace Tests\Service;

use Exception;
use Tests\TestCase;
use Wirgen\Keitaro\Response\Group;

class GroupsTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testIndex(): void
    {
        $result = $this->keitaro->getGroups();
        $this->assertContainsOnlyInstancesOf(Group::class, $result);
    }
}
