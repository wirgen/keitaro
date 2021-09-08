<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class PlaceholderObject
 *
 * @property string $name
 * @property string $placeholder
 * @property string $alias
 *
 * @package Wirgen\Keitaro\Model
 */
class PlaceholderObject
{
    public $name;
    public $placeholder;
    public $alias;

    public function __construct(array $data = [])
    {
        $this->name = $data['name'] ?? '';
        $this->placeholder = $data['placeholder'] ?? '';
        $this->alias = $data['alias'] ?? '';
    }
}
