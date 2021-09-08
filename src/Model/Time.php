<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Time
 *
 * @property string $date
 * @property int $timezone_type
 * @property string $timezone
 *
 * @package Wirgen\Keitaro\Model
 */
class Time
{
    public $date;
    public $timezone_type;
    public $timezone;

    public function __construct(array $data = [])
    {
        $this->date = $data['date'] ?? '';
        $this->timezone_type = $data['timezone_type'] ?? 0;
        $this->timezone = $data['timezone'] ?? '';
    }
}
