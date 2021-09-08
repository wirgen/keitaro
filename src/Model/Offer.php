<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Offer
 *
 * @property int $id
 * @property string $name
 * @property int $group_id
 * @property string $action_type
 * @property array $action_payload
 * @property array $action_options
 * @property int $affiliate_network_id
 * @property double $payout_value
 * @property string $payout_currency
 * @property string $payout_type
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 * @property bool $payout_auto
 * @property bool $payout_upsell
 * @property array $country
 * @property string $notes
 * @property string $affiliate_network
 * @property string $archive
 * @property string $local_path
 * @property string $preview_path
 *
 * @package Wirgen\Keitaro\Model
 */
class Offer
{
    public $id;
    public $name;
    public $group_id;
    public $action_type;
    public $action_payload;
    public $action_options;
    public $affiliate_network_id;
    public $payout_value;
    public $payout_currency;
    public $payout_type;
    public $state;
    public $created_at;
    public $updated_at;
    public $payout_auto;
    public $payout_upsell;
    public $country;
    public $notes;
    public $affiliate_network;
    public $archive;
    public $local_path;
    public $preview_path;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->group_id = $data['group_id'] ?? 0;
        $this->action_type = $data['action_type'] ?? '';
        $this->action_payload = $data['action_payload'] ?? [];
        $this->action_options = $data['action_options'] ?? [];
        $this->affiliate_network_id = $data['affiliate_network_id'] ?? 0;
        $this->payout_value = $data['payout_value'] ?? 0;
        $this->payout_currency = $data['payout_currency'] ?? '';
        $this->payout_type = $data['payout_type'] ?? '';
        $this->state = $data['state'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->payout_auto = $data['payout_auto'] ?? false;
        $this->payout_upsell = $data['payout_upsell'] ?? false;
        $this->country = $data['country'] ?? [];
        $this->notes = $data['notes'] ?? '';
        $this->affiliate_network = $data['affiliate_network'] ?? '';
        $this->archive = $data['archive'] ?? '';
        $this->local_path = $data['local_path'] ?? '';
        $this->preview_path = $data['preview_path'] ?? '';
    }
}
