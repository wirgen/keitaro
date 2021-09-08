<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Stream
 *
 * @property int $id
 * @property string $type
 * @property string $name
 * @property int $campaign_id
 * @property int $position
 * @property double $weight
 * @property array $action_options
 * @property string $comments
 * @property string $state
 * @property string $updated_at
 * @property string $action_type
 * @property array $action_payload
 * @property string $schema
 * @property bool $collect_clicks
 * @property bool $filter_or
 * @property Filter[] $filters
 * @property Trigger[] $triggers
 * @property LandingStream[] $landings
 * @property OfferStream[] $offers
 *
 * @package Wirgen\Keitaro\Model
 */
class Stream
{
    public $id;
    public $type;
    public $name;
    public $campaign_id;
    public $position;
    public $weight;
    public $action_options;
    public $comments;
    public $state;
    public $updated_at;
    public $action_type;
    public $action_payload;
    public $schema;
    public $collect_clicks;
    public $filter_or;
    public $filters;
    public $triggers;
    public $landings;
    public $offers;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->type = $data['type'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->campaign_id = $data['campaign_id'] ?? 0;
        $this->position = $data['position'] ?? 0;
        $this->weight = $data['weight'] ?? 0;
        $this->action_options = $data['action_options'] ?? [];
        $this->comments = $data['comments'] ?? '';
        $this->state = $data['state'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->action_type = $data['action_type'] ?? '';
        $this->action_payload = $data['action_payload'] ?? [];
        $this->schema = $data['schema'] ?? '';
        $this->collect_clicks = $data['collect_clicks'] ?? false;
        $this->filter_or = $data['filter_or'] ?? false;
        $this->filters = $data['filters'] ?? [];
        $this->triggers = $data['triggers'] ?? [];
        $this->landings = $data['landings'] ?? [];
        $this->offers = $data['offers'] ?? [];
    }
}
