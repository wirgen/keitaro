<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Response;

/**
 * Class Group
 *
 * @property int $id
 * @property string $name
 * @property int $position
 * @property string $type
 *
 * @package Wirgen\Keitaro\Response
 */
class Group
{
    public $id;
    public $name;
    public $position;
    public $type;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->position = $data['position'] ?? 0;
        $this->type = $data['type'] ?? '';
    }
}
