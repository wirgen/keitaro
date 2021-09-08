<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class EditorFiles
 *
 * @property string $name
 * @property string $type
 * @property string $ext
 * @property string $path
 * @property array $children
 *
 * @package Wirgen\Keitaro\Model
 */
class EditorFiles
{
    public $name;
    public $type;
    public $ext;
    public $path;
    public $children;

    public function __construct(array $data = [])
    {
        $this->name = $data['name'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->ext = $data['ext'] ?? '';
        $this->path = $data['path'] ?? '';
        $this->children = $data['children'] ?? [];
    }
}
