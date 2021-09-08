<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class User
 *
 * @property int $id
 * @property string $login
 * @property string $type
 * @property array $rules
 * @property string $permissions
 * @property UserAccessData $access_data
 * @property int $keyCount
 * @property UserPreferences $preferences
 *
 * @package Wirgen\Keitaro\Model
 */
class User
{
    public $id;
    public $login;
    public $type;
    public $rules;
    public $permissions;
    public $access_data;
    public $keyCount;
    public $preferences;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->login = $data['login'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->rules = $data['rules'] ?? [];
        $this->permissions = $data['permissions'] ?? '';
        $this->access_data = $data['access_data'] ?? new UserAccessData();
        $this->keyCount = $data['keyCount'] ?? 0;
        $this->preferences = $data['preferences'] ?? new UserPreferences();
    }
}
