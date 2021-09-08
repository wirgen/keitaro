<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class AffiliateNetwork
 *
 * @property int $id
 * @property string $name
 * @property string $postback_url
 * @property string $offer_param
 * @property string $state
 * @property string $template_name
 * @property string $notes
 * @property string $pull_api_options
 * @property string $created_at
 * @property string $updated_at
 * @property int $offers
 *
 * @package Wirgen\Keitaro\Model
 */
class AffiliateNetwork
{
    public $id;
    public $name;
    public $postback_url;
    public $offer_param;
    public $state;
    public $template_name;
    public $notes;
    public $pull_api_options;
    public $created_at;
    public $updated_at;
    public $offers;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? 0;
        $this->name = $data['name'] ?? '';
        $this->postback_url = $data['postback_url'] ?? '';
        $this->offer_param = $data['offer_param'] ?? '';
        $this->state = $data['state'] ?? '';
        $this->template_name = $data['template_name'] ?? '';
        $this->notes = $data['notes'] ?? '';
        $this->pull_api_options = $data['pull_api_options'] ?? '';
        $this->created_at = $data['created_at'] ?? '';
        $this->updated_at = $data['updated_at'] ?? '';
        $this->offers = $data['offers'] ?? 0;
    }
}
