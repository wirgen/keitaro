<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Trigger
 *
 * @property int $id
 * @property int $oid
 * @property int $stream_id
 * @property string $taget
 * @property string $condition
 * @property string $selected_page
 * @property string $pattern
 * @property string $action
 * @property int $interval
 * @property int $next_run_at
 * @property string $alternative_urls
 * @property string $grab_from_page
 * @property string $av_settings
 * @property bool $reverse
 * @property bool $enabled
 * @property bool $scan_page
 *
 * @package Wirgen\Keitaro\Model
 */
class Trigger
{
    public $id;
    public $oid;
    public $stream_id;
    public $taget;
    public $condition;
    public $selected_page;
    public $pattern;
    public $action;
    public $interval;
    public $next_run_at;
    public $alternative_urls;
    public $grab_from_page;
    public $av_settings;
    public $reverse;
    public $enabled;
    public $scan_page;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->oid = $data['oid'] ?? 0;
        $this->stream_id = $data['stream_id'] ?? 0;
        $this->taget = $data['taget'] ?? '';
        $this->condition = $data['condition'] ?? '';
        $this->selected_page = $data['selected_page'] ?? '';
        $this->pattern = $data['pattern'] ?? '';
        $this->action = $data['action'] ?? '';
        $this->interval = $data['interval'] ?? 0;
        $this->next_run_at = $data['next_run_at'] ?? 0;
        $this->alternative_urls = $data['alternative_urls'] ?? '';
        $this->grab_from_page = $data['grab_from_page'] ?? '';
        $this->av_settings = $data['av_settings'] ?? '';
        $this->reverse = $data['reverse'] ?? false;
        $this->enabled = $data['enabled'] ?? false;
        $this->scan_page = $data['scan_page'] ?? false;
    }
}
