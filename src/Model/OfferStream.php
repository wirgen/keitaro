<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class OfferStream
 *
 * @property int $id
 * @property int $stream_id
 * @property int $offer_id
 * @property string $state
 * @property int $share
 * @property string $created_at
 * @property string $updated_at
 *
 * @package Wirgen\Keitaro\Model
 */
class OfferStream
{
    public $id;
    public $stream_id;
    public $offer_id;
    public $state;
    public $share;
    public $created_at;
    public $updated_at;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->stream_id = $data['stream_id'] ?? 0;
        $this->offer_id = $data['offer_id'] ?? 0;
        $this->state = $data['state'] ?? '';
        $this->share = $data['share'] ?? 0;
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
    }
}
