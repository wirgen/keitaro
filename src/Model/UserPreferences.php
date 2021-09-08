<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class UserPreferences
 *
 * @property string $language
 * @property string $timezone
 *
 * @package Wirgen\Keitaro\Model
 */
class UserPreferences
{
    public $language;
    public $timezone;

    public function __construct(array $data = [])
    {
        $this->language = $data['language'] ?? '';
        $this->timezone = $data['timezone'] ?? '';
    }
}
