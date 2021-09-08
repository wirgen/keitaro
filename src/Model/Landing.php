<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Landing
 *
 * @property int $id
 * @property string $landing_type
 * @property string $action_type
 * @property array $action_payload
 * @property array $action_options
 * @property string $name
 * @property int $group_id
 * @property int $offer_count
 * @property string $notes
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 * @property string $archive
 * @property string $local_path
 * @property string $preview_path
 *
 * @package Wirgen\Keitaro\Model
 */
class Landing
{
    public $id;
    public $landing_type;
    public $action_type;
    public $action_payload;
    public $action_options;
    public $name;
    public $group_id;
    public $offer_count;
    public $notes;
    public $state;
    public $created_at;
    public $updated_at;
    public $archive;
    public $local_path;
    public $preview_path;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->landing_type = $data['landing_type'] ?? '';
        $this->action_type = $data['action_type'] ?? '';
        $this->action_payload = $data['action_payload'] ?? [];
        $this->action_options = $data['action_options'] ?? [];
        $this->name = $data['name'] ?? '';
        $this->group_id = $data['group_id'] ?? 0;
        $this->offer_count = $data['offer_count'] ?? 0;
        $this->notes = $data['notes'] ?? '';
        $this->state = $data['state'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->archive = $data['archive'] ?? '';
        $this->local_path = $data['local_path'] ?? '';
        $this->preview_path = $data['preview_path'] ?? '';
    }
}
