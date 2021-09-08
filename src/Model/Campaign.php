<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Campaign
 *
 * @property int $id
 * @property string $alias
 * @property string $name
 * @property string $type
 * @property int $cookies_ttl
 * @property int $position
 * @property string $state
 * @property string $updated_at
 * @property string $cost_type
 * @property string $cost_value
 * @property string $cost_currency
 * @property int $group_id
 * @property string $bind_visitors
 * @property int $traffic_source_id
 * @property string $token
 * @property bool $cost_auto
 * @property SourceParameters $parameters
 * @property S2SPostback[] $postbacks
 * @property string $notes
 *
 * @package Wirgen\Keitaro\Model
 */
class Campaign
{
    public $id;
    public $alias;
    public $name;
    public $type;
    public $cookies_ttl;
    public $position;
    public $state;
    public $updated_at;
    public $cost_type;
    public $cost_value;
    public $cost_currency;
    public $group_id;
    public $bind_visitors;
    public $traffic_source_id;
    public $token;
    public $cost_auto;
    public $parameters;
    public $postbacks;
    public $notes;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->alias = $data['alias'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->cookies_ttl = $data['cookies_ttl'] ?? 0;
        $this->position = $data['position'] ?? 0;
        $this->state = $data['state'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->cost_type = $data['cost_type'] ?? '';
        $this->cost_value = $data['cost_value'] ?? '';
        $this->cost_currency = $data['cost_currency'] ?? '';
        $this->group_id = $data['group_id'] ?? 0;
        $this->bind_visitors = $data['bind_visitors'] ?? '';
        $this->traffic_source_id = $data['traffic_source_id'] ?? 0;
        $this->token = $data['token'] ?? '';
        $this->cost_auto = $data['cost_auto'] ?? false;
        $this->parameters = new SourceParameters($data['parameters'] ?? []);
        $this->postbacks = $data['postbacks'] ?? [];
        $this->notes = $data['notes'] ?? '';
    }
}
