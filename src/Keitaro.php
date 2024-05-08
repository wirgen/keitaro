<?php

declare(strict_types=1);

namespace Wirgen\Keitaro;

use Exception;
use Wirgen\Keitaro\Model\AffiliateNetwork;
use Wirgen\Keitaro\Model\Campaign;
use Wirgen\Keitaro\Model\Group;
use Wirgen\Keitaro\Model\Report;
use Wirgen\Keitaro\Model\User;

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
     * @return array|null
     * @throws Exception
     */
    public function request(
        string $method,
        string $path,
        array $params = []
    ): ?array {
        if ($this->curlHandler === null) {
            $this->curlHandler = curl_init();
            curl_setopt($this->curlHandler, CURLOPT_HTTPHEADER, [
                "Accept: application/json",
                "Api-Key: $this->apiKey",
                "Content-Type: application/json",
            ]);
            curl_setopt($this->curlHandler, CURLOPT_SSL_VERIFYPEER, false);
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
                $error = ($result['error'] ?? json_encode($result)) . " ($httpCode)";
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

    /* * * * * * * * * * Clicks * * * * * * * * * */

    /**
     * Clean Stats
     *
     * @param array $data
     * @throws Exception
     */
    public function cleanStats(array $data): void
    {
        $this->request('post', "/clicks/clean", array_filter($data));
    }

    /**
     * Retrieve click log
     *
     * @param array $data
     * @return Report
     * @throws Exception
     */
    public function retrieveClickLog(array $data): Report
    {
        return new Report(
            $this->request('post', "/clicks/log", array_filter($data))
        );
    }

    /**
     * Update Clicks Costs
     *
     * @param array $data
     * @throws Exception
     */
    public function updateClicksCosts(array $data): void
    {
        $this->request('post', "/clicks/update_costs", array_filter($data));
    }

    /* * * * * * * * * * Conversions * * * * * * * * * */

    /**
     * Get Conversions
     *
     * @param array $data
     * @return Report
     * @throws Exception
     */
    public function getConversions(array $data): Report
    {
        return new Report(
            $this->request('post', "/conversions/log", array_filter($data))
        );
    }

    /* * * * * * * * * * Domains * * * * * * * * * */

    /* * * * * * * * * * Groups * * * * * * * * * */

    /**
     * Get Groups
     *
     * @param string $type
     * @return Group[]
     * @throws Exception
     */
    public function getGroups(string $type = 'campaigns'): array
    {
        return array_map(static function ($item) {
            return new Group($item);
        }, $this->request('get', "/groups", ['type' => $type]));
    }

    /**
     * Create a Group
     *
     * @param array $data
     * @return Group
     * @throws Exception
     */
    public function createGroup(array $data): Group
    {
        return new Group(
            $this->request('post', "/groups", array_filter($data))
        );
    }

    /**
     * Update a Group
     *
     * @param int $id
     * @param array $data
     * @return Group
     * @throws Exception
     */
    public function updateGroup(int $id, array $data): Group
    {
        return new Group(
            $this->request('put', "/groups/$id", array_filter($data))
        );
    }

    /**
     * Delete a Group
     *
     * @param int $id
     * @throws Exception
     */
    public function deleteGroup(int $id): void
    {
        $this->request('delete', "/groups/$id/delete");
    }

    /* * * * * * * * * * Integrations * * * * * * * * * */

    /* * * * * * * * * * Landing Pages * * * * * * * * * */

    /* * * * * * * * * * Logs * * * * * * * * * */

    /* * * * * * * * * * Offers * * * * * * * * * */

    /* * * * * * * * * * Reports * * * * * * * * * */

    /**
     * Build a Custom Report
     *
     * @param array $data
     * @return Report
     * @throws Exception
     */
    public function buildCustomReport(array $data): Report
    {
        return new Report(
            $this->request('post', "/report/build", array_filter($data))
        );
    }

    /* * * * * * * * * * Traffic Sources * * * * * * * * * */

    /* * * * * * * * * * Users * * * * * * * * * */

    /**
     * Get Users
     *
     * @return User[]
     * @throws Exception
     */
    public function getUsers(): array
    {
        return array_map(static function ($item) {
            return new User($item);
        }, $this->request('get', "/users"));
    }

    /**
     * Create a User
     *
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function createUser(array $data): User
    {
        return new User(
            $this->request('post', "/users", array_filter($data))
        );
    }

    /**
     * Get a User
     *
     * @param int $id
     * @return User
     * @throws Exception
     */
    public function getUser(int $id): User
    {
        return new User(
            $this->request('get', "/users/$id")
        );
    }

    /**
     * Update a User
     *
     * @param int $id
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function updateUser(int $id, array $data): User
    {
        return new User(
            $this->request('put', "/users/$id", array_filter($data))
        );
    }

    /**
     * Remove a User
     *
     * @param int $id
     * @throws Exception
     */
    public function removeUser(int $id): void
    {
        $this->request('delete', "/users/$id");
    }

    /**
     * Update User Access Data
     *
     * @param int $id
     * @param array $data
     * @return User
     * @throws Exception
     */
    public function updateUserAccessData(int $id, array $data): User
    {
        return new User(
            $this->request('put', "/users/$id/access", array_filter($data))
        );
    }
}
