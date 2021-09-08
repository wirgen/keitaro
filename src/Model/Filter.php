<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Filter
 *
 * @property int $id
 * @property int $stream_id
 * @property string $name
 * @property string $mode
 * @property string $payload
 * @property string $oid
 *
 * @package Wirgen\Keitaro\Model
 */
class Filter
{
    public $id;
    public $stream_id;
    public $name;
    public $mode;
    public $payload;
    public $oid;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->stream_id = $data['stream_id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->mode = $data['mode'] ?? '';
        $this->payload = $data['payload'] ?? '';
        $this->oid = $data['oid'] ?? '';
    }
}
