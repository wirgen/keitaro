<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class S2SPostback
 *
 * @property int $campaign_id
 * @property int $id
 * @property string $method
 * @property string $source
 * @property array $statuses
 * @property string $url
 *
 * @package Wirgen\Keitaro\Model
 */
class S2SPostback
{
    public $campaign_id;
    public $id;
    public $method;
    public $source;
    public $statuses;
    public $url;

    public function __construct(array $data = [])
    {
        $this->campaign_id = $data['campaign_id'] ?? 0;
        $this->id = $data['id'] ?? 0;
        $this->method = $data['method'] ?? '';
        $this->source = $data['source'] ?? '';
        $this->statuses = $data['statuses'] ?? [];
        $this->url = $data['url'] ?? '';
    }
}
