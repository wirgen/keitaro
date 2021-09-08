<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Source
 *
 * @property int $id
 * @property string $name
 * @property string $postback_url
 * @property array $postback_statuses
 * @property string $template_name
 * @property bool $accept_parameters
 * @property SourceParameters $parameters
 * @property string $notes
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 * @property double $traffic_loss
 * @property string $update_in_campaigns
 *
 * @package Wirgen\Keitaro\Model
 */
class Source
{
    public $id;
    public $name;
    public $postback_url;
    public $postback_statuses;
    public $template_name;
    public $accept_parameters;
    public $parameters;
    public $notes;
    public $state;
    public $created_at;
    public $updated_at;
    public $traffic_loss;
    public $update_in_campaigns;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->postback_url = $data['postback_url'] ?? '';
        $this->postback_statuses = $data['postback_statuses'] ?? [];
        $this->template_name = $data['template_name'] ?? '';
        $this->accept_parameters = $data['accept_parameters'] ?? false;
        $this->parameters = $data['parameters'] ?? new SourceParameters();
        $this->notes = $data['notes'] ?? '';
        $this->state = $data['state'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->traffic_loss = $data['traffic_loss'] ?? 0;
        $this->update_in_campaigns = $data['update_in_campaigns'] ?? '';
    }
}
