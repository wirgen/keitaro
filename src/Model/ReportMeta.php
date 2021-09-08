<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class ReportMeta
 *
 * @property string $execution_time
 * @property string $datetime
 *
 * @package Wirgen\Keitaro\Model
 */
class ReportMeta
{
    public $execution_time;
    public $datetime;

    public function __construct(array $data = [])
    {
        $this->execution_time = $data['execution_time'] ?? '';
        $this->datetime = $data['datetime'] ?? '';
    }
}
