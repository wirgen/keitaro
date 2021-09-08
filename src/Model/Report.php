<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class Report
 *
 * @property array $rows
 * @property int $total
 * @property ReportMeta $meta
 *
 * @package Wirgen\Keitaro\Model
 */
class Report
{
    public $rows;
    public $total;
    public $meta;

    public function __construct(array $data = [])
    {
        $this->rows = $data['rows'] ?? [];
        $this->total = $data['total'] ?? 0;
        $this->meta = new ReportMeta($data['meta'] ?? []);
    }
}
