<?php

declare(strict_types=1);

namespace Wirgen\Keitaro;

use Exception;
use Wirgen\Keitaro\Model\AffiliateNetwork;
use Wirgen\Keitaro\Model\Campaign;
use Wirgen\Keitaro\Model\Group;

/**
 * Class Keitaro
 *
 * @package Wirgen\Keitaro
 */
class Keitaro
{
    private $apiPath;
    private $apiKey;

    private $curlHandler;

    public function __construct(string $apiPath, string $apiKey)
    {
        $this->apiPath = "$apiPath/admin_api/v1";
        $this->apiKey = $apiKey;
    }

    /**
     * Request to API server
     *
     * @param string $method
     * @param string $path
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function request(
        string $method,
        string $path,
        array $params = []
    ): array {
        if ($this->curlHandler === null) {
            $this->curlHandler = curl_init();
            curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER, [
                "Accept: application/json",
                "Api-Key: $this->apiKey",
                "Content-Type: application/json",
            ]);
            curl_setopt($this->curlHandler, CURLOPT_RETURNTRANSFER, true);
        }

        $method = strtoupper($method);
        curl_setopt($this->curlHandler, CURLOPT_CUSTOMREQUEST, $method);
        $url = "$this->apiPath$path";
        if ($method === 'GET') {
            $url .= '?' . http_build_query($params);
        } else {
            curl_setopt($this->curlHandler, CURLOPT_POSTFIELDS, json_encode($params));
        }
        curl_setopt($this->curlHandler, CURLOPT_URL, $url);

        $result = json_decode(curl_exec($this->curlHandler), true);
        $httpCode = curl_getinfo($this->curlHandler, CURLINFO_HTTP_CODE);

        if ($httpCode !== 200) {
            if ($httpCode === 406) {
                $error = implode(
                    '; ',
                    array_map(static function ($value, $key) {
                        return "$key - " . strtolower(implode(', ', $value));
                    }, $result, array_keys($result))
                );
            } else {
                $error = $result['error'] ?? json_encode($result);
            }
            throw new Exception($error, $httpCode);
        }

        return $result;
    }

    /* * * * * * * * * * Affiliate Networks * * * * * * * * * */

    /**
     * Get the list of all Affiliate Networks
     *
     * @return AffiliateNetwork[]
     * @throws Exception
     */
    public function getAllAffiliateNetworks(): array
    {
        return array_map(static function ($item) {
            return new AffiliateNetwork($item);
        }, $this->request('get', "/affiliate_networks"));
    }

    /**
     * Create a new Affiliate Network
     *
     * @param array $data
     * @return AffiliateNetwork
     * @throws Exception
     */
    public function createAffiliateNetwork(array $data): AffiliateNetwork
    {
        return new AffiliateNetwork(
            $this->request('post', "/affiliate_networks", array_filter($data))
        );
    }

    /**
     * Get an Affiliate Network
     *
     * @param int $id
     * @return AffiliateNetwork
     * @throws Exception
     */
    public function getAffiliateNetwork(int $id): AffiliateNetwork
    {
        return new AffiliateNetwork(
            $this->request('get', "/affiliate_networks/$id")
        );
    }

    /**
     * Update an Affiliate Network
     *
     * @param int $id
     * @param array $data
     * @return AffiliateNetwork
     * @throws Exception
     */
    public function updateAffiliateNetwork(int $id, array $data): AffiliateNetwork
    {
        return new AffiliateNetwork(
            $this->request('put', "/affiliate_networks/$id", array_filter($data))
        );
    }

    /**
     * Move Affiliate Network to Archive
     *
     * @param int $id
     * @throws Exception
     */
    public function moveAffiliateNetworkToArchive(int $id): void
    {
        $this->request('delete', "/affiliate_networks/$id");
    }

    /**
     * Clone an Affiliate Network
     *
     * @param int $id
     * @return AffiliateNetwork
     * @throws Exception
     */
    public function cloneAffiliateNetwork(int $id): AffiliateNetwork
    {
        $result = $this->request('post', "/affiliate_networks/$id/clone");

        return new AffiliateNetwork($result[0]);
    }

    /* * * * * * * * * * Bot Lists * * * * * * * * * */

    /* * * * * * * * * * Campaigns * * * * * * * * * */

    /**
     * Get all Campaigns
     *
     * @return Campaign[]
     * @throws Exception
     */
    public function getAllCampaigns(): array
    {
        return array_map(static function ($item) {
            return new Campaign($item);
        }, $this->request('get', "/campaigns"));
    }

    /**
     * Create a Campaign
     *
     * @param array $data
     * @return Campaign
     * @throws Exception
     */
    public function createCampaign(array $data): Campaign
    {
        return new Campaign(
            $this->request('post', "/campaigns", array_filter($data))
        );
    }

    /**
     * Get a Campaign
     *
     * @param int $id
     * @return Campaign
     * @throws Exception
     */
    public function getCampaign(int $id): Campaign
    {
        return new Campaign(
            $this->request('get', "/campaigns/$id")
        );
    }

    /**
     * Update a Campaign
     *
     * @param int $id
     * @param array $data
     * @return Campaign
     * @throws Exception
     */
    public function updateCampaign(int $id, array $data): Campaign
    {
        return new Campaign(
            $this->request('put', "/campaigns/$id", array_filter($data))
        );
    }

    /**
     * Move Campaign to Archive
     *
     * @param int $id
     * @throws Exception
     */
    public function moveCampaignToArchive(int $id): void
    {
        $this->request('delete', "/campaigns/$id");
    }

    /**
     * Clone a Campaign
     *
     * @param int $id
     * @return Campaign
     * @throws Exception
     */
    public function cloneCampaign(int $id): Campaign
    {
        $result = $this->request('post', "/campaigns/$id/clone");

        return new Campaign($result[0]);
    }

    /**
     * Disable a Campaign
     *
     * @param int $id
     * @throws Exception
     */
    public function disableCampaign(int $id): void
    {
        $this->request('post', "/campaigns/$id/disable");
    }

    /**
     * Enable a Campaign
     *
     * @param int $id
     * @throws Exception
     */
    public function enableCampaign(int $id): void
    {
        $this->request('post', "/campaigns/$id/enable");
    }

    /**
     * Restore a Campaign
     *
     * @param int $id
     * @throws Exception
     */
    public function restoreCampaign(int $id): void
    {
        $this->request('post', "/campaigns/$id/restore");
    }

    /**
     * Update Campaign Costs
     *
     * @param int $id
     * @param array $data
     * @return Campaign
     * @throws Exception
     */
    public function updateCampaignCosts(int $id, array $data): Campaign
    {
        return new Campaign(
            $this->request('post', "/campaigns/$id/restore", array_filter($data))
        );
    }

    /**
     * Get Deleted Campaigns
     *
     * @return Campaign[]
     * @throws Exception
     */
    public function getDeletedCampaigns(): array
    {
        return array_map(static function ($item) {
            return new Campaign($item);
        }, $this->request('get', "/campaigns/deleted"));
    }

    /* * * * * * * * * * Streams * * * * * * * * * */

    /* * * * * * * * * * Clean Stats * * * * * * * * * */

    /* * * * * * * * * * Clicks * * * * * * * * * */

    /* * * * * * * * * * Conversions * * * * * * * * * */

    /* * * * * * * * * * Domains * * * * * * * * * */

    /* * * * * * * * * * Groups * * * * * * * * * */

    /**
     * Get Groups
     *
     * @throws Exception
     */
    public function getGroups($type = 'campaigns'): array
    {
        return array_map(static function ($item) {
            return new Group($item);
        }, $this->request('get', "/groups", ['type' => $type]));
    }

    /* * * * * * * * * * Integrations * * * * * * * * * */

    /* * * * * * * * * * Landing Pages * * * * * * * * * */

    /* * * * * * * * * * Logs * * * * * * * * * */

    /* * * * * * * * * * Offers * * * * * * * * * */

    /* * * * * * * * * * Reports * * * * * * * * * */

    /* * * * * * * * * * Traffic Sources * * * * * * * * * */

    /* * * * * * * * * * Users * * * * * * * * * */
}
