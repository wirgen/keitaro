<?php

declare(strict_types=1);

namespace Wirgen\Keitaro\Model;

/**
 * Class UserAccessData
 *
 * @property string $offers_access_type
 * @property string $campaigns_access_type
 * @property string $landings_access_type
 * @property string $traffic_sources_access_type
 * @property string $archive_access_type
 * @property string $geo_profiles_access_type
 * @property string $dashboard_access_type
 * @property string $clicks_access_type
 * @property string $labels_access_type
 * @property string $conversions_access_type
 * @property string $reports_access_type
 * @property string $cleaner_access_type
 * @property string $streams_access_type
 * @property string $trends_access_type
 * @property string $affiliate_networks_access_type
 * @property string $migrations_access_type
 * @property string $api_keys_access_type
 * @property string $domains_access_type
 * @property string $groups_access_type
 * @property string $geo_dbs_access_type
 *
 * @package Wirgen\Keitaro\Model
 */
class UserAccessData
{
    public $offers_access_type;
    public $campaigns_access_type;
    public $landings_access_type;
    public $traffic_sources_access_type;
    public $archive_access_type;
    public $geo_profiles_access_type;
    public $dashboard_access_type;
    public $clicks_access_type;
    public $labels_access_type;
    public $conversions_access_type;
    public $reports_access_type;
    public $cleaner_access_type;
    public $streams_access_type;
    public $trends_access_type;
    public $affiliate_networks_access_type;
    public $migrations_access_type;
    public $api_keys_access_type;
    public $domains_access_type;
    public $groups_access_type;
    public $geo_dbs_access_type;

    public function __construct(array $data = [])
    {
        $this->offers_access_type = $data['offers_access_type'] ?? '';
        $this->campaigns_access_type = $data['campaigns_access_type'] ?? '';
        $this->landings_access_type = $data['landings_access_type'] ?? '';
        $this->traffic_sources_access_type = $data['traffic_sources_access_type'] ?? '';
        $this->archive_access_type = $data['archive_access_type'] ?? '';
        $this->geo_profiles_access_type = $data['geo_profiles_access_type'] ?? '';
        $this->dashboard_access_type = $data['dashboard_access_type'] ?? '';
        $this->clicks_access_type = $data['clicks_access_type'] ?? '';
        $this->labels_access_type = $data['labels_access_type'] ?? '';
        $this->conversions_access_type = $data['conversions_access_type'] ?? '';
        $this->reports_access_type = $data['reports_access_type'] ?? '';
        $this->cleaner_access_type = $data['cleaner_access_type'] ?? '';
        $this->streams_access_type = $data['streams_access_type'] ?? '';
        $this->trends_access_type = $data['trends_access_type'] ?? '';
        $this->affiliate_networks_access_type = $data['affiliate_networks_access_type'] ?? '';
        $this->migrations_access_type = $data['migrations_access_type'] ?? '';
        $this->api_keys_access_type = $data['api_keys_access_type'] ?? '';
        $this->domains_access_type = $data['domains_access_type'] ?? '';
        $this->groups_access_type = $data['groups_access_type'] ?? '';
        $this->geo_dbs_access_type = $data['geo_dbs_access_type'] ?? '';
    }
}
