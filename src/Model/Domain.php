<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Domain
 *
 * @property int $id
 * @property string $name
 * @property string $network_status
 * @property int $default_campaign
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 * @property bool $wildcard
 * @property bool $catch_not_found
 * @property string $notes
 * @property int $campaigns_count
 * @property bool $ssl_redirect
 * @property bool $allow_indexing
 *
 * @package Wirgen\Keitaro\Model
 */
class Domain
{
    public $id;
    public $name;
    public $network_status;
    public $default_campaign;
    public $state;
    public $created_at;
    public $updated_at;
    public $wildcard;
    public $catch_not_found;
    public $notes;
    public $campaigns_count;
    public $ssl_redirect;
    public $allow_indexing;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->network_status = $data['network_status'] ?? '';
        $this->default_campaign = $data['default_campaign'] ?? 0;
        $this->state = $data['state'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->wildcard = $data['wildcard'] ?? false;
        $this->catch_not_found = $data['catch_not_found'] ?? false;
        $this->notes = $data['notes'] ?? '';
        $this->campaigns_count = $data['campaigns_count'] ?? 0;
        $this->ssl_redirect = $data['ssl_redirect'] ?? false;
        $this->allow_indexing = $data['allow_indexing'] ?? false;
    }
}
