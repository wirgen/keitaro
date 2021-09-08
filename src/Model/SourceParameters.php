<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class SourceParameters
 *
 * @property PlaceholderObject $keyword
 * @property PlaceholderObject $cost
 * @property PlaceholderObject $currency
 * @property PlaceholderObject $external_id
 * @property PlaceholderObject $creative_id
 * @property PlaceholderObject $ad_campaign_id
 * @property PlaceholderObject $source
 * @property PlaceholderObject $sub_id_1
 * @property PlaceholderObject $sub_id_2
 * @property PlaceholderObject $sub_id_3
 * @property PlaceholderObject $sub_id_4
 * @property PlaceholderObject $sub_id_5
 * @property PlaceholderObject $sub_id_6
 * @property PlaceholderObject $sub_id_7
 * @property PlaceholderObject $sub_id_8
 * @property PlaceholderObject $sub_id_9
 * @property PlaceholderObject $sub_id_10
 * @property PlaceholderObject $sub_id_11
 * @property PlaceholderObject $sub_id_12
 * @property PlaceholderObject $sub_id_13
 * @property PlaceholderObject $sub_id_14
 * @property PlaceholderObject $sub_id_15
 *
 * @package Wirgen\Keitaro\Model
 */
class SourceParameters
{
    public $keyword;
    public $cost;
    public $currency;
    public $external_id;
    public $creative_id;
    public $ad_campaign_id;
    public $source;
    public $sub_id_1;
    public $sub_id_2;
    public $sub_id_3;
    public $sub_id_4;
    public $sub_id_5;
    public $sub_id_6;
    public $sub_id_7;
    public $sub_id_8;
    public $sub_id_9;
    public $sub_id_10;
    public $sub_id_11;
    public $sub_id_12;
    public $sub_id_13;
    public $sub_id_14;
    public $sub_id_15;

    public function __construct(array $data = [])
    {
        $this->keyword = new PlaceholderObject($data['keyword'] ?? []);
        $this->cost = new PlaceholderObject($data['cost'] ?? []);
        $this->currency = new PlaceholderObject($data['currency'] ?? []);
        $this->external_id = new PlaceholderObject($data['external_id'] ?? []);
        $this->creative_id = new PlaceholderObject($data['creative_id'] ?? []);
        $this->ad_campaign_id = new PlaceholderObject($data['ad_campaign_id'] ?? []);
        $this->source = new PlaceholderObject($data['source'] ?? []);
        $this->sub_id_1 = new PlaceholderObject($data['sub_id_1'] ?? []);
        $this->sub_id_2 = new PlaceholderObject($data['sub_id_2'] ?? []);
        $this->sub_id_3 = new PlaceholderObject($data['sub_id_3'] ?? []);
        $this->sub_id_4 = new PlaceholderObject($data['sub_id_4'] ?? []);
        $this->sub_id_5 = new PlaceholderObject($data['sub_id_5'] ?? []);
        $this->sub_id_6 = new PlaceholderObject($data['sub_id_6'] ?? []);
        $this->sub_id_7 = new PlaceholderObject($data['sub_id_7'] ?? []);
        $this->sub_id_8 = new PlaceholderObject($data['sub_id_8'] ?? []);
        $this->sub_id_9 = new PlaceholderObject($data['sub_id_9'] ?? []);
        $this->sub_id_10 = new PlaceholderObject($data['sub_id_10'] ?? []);
        $this->sub_id_11 = new PlaceholderObject($data['sub_id_11'] ?? []);
        $this->sub_id_12 = new PlaceholderObject($data['sub_id_12'] ?? []);
        $this->sub_id_13 = new PlaceholderObject($data['sub_id_13'] ?? []);
        $this->sub_id_14 = new PlaceholderObject($data['sub_id_14'] ?? []);
        $this->sub_id_15 = new PlaceholderObject($data['sub_id_15'] ?? []);
    }
}
