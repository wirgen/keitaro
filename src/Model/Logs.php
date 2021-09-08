<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Logs
 *
 * @property string $datetime
 * @property string $jid
 * @property string $message
 *
 * @package Wirgen\Keitaro\Model
 */
class Logs
{
    public $datetime;
    public $jid;
    public $message;

    public function __construct(array $data = [])
    {
        $this->datetime = $data['datetime'] ?? '';
        $this->jid = $data['jid'] ?? '';
        $this->message = $data['message'] ?? '';
    }
}
