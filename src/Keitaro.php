<?php

declare(strict_types=1);

namespace Wirgen\Keitaro;

use Exception;
use Wirgen\Keitaro\Response\AffiliateNetwork;
use Wirgen\Keitaro\Response\Campaign;
use Wirgen\Keitaro\Response\Group;

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
        $this->apiPath = $apiPath;
        $this->apiKey = $apiKey;
    }

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

    /* * * * * * * * * * Affiliate Networks * * * * * * * * * */

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

    /**
     * Create a new Affiliate Network
     *
     * @param string $name
     * @param string $postback_url
     * @param string $offer_param
     * @param string $notes
     * @return AffiliateNetwork
     * @throws Exception
     */
    public function createAffiliateNetwork(
        string $name,
        string $postback_url = '',
        string $offer_param = '',
        string $notes = ''
    ): AffiliateNetwork {
        $data = array_filter(
            [
                'name' => $name,
                'postback_url' => $postback_url,
                'offer_param' => $offer_param,
                'notes' => $notes,
            ]
        );

        return new AffiliateNetwork($this->request('post', "/affiliate_networks", $data));
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
        return new AffiliateNetwork($this->request('get', "/affiliate_networks/$id"));
    }

    /**
     * Update an Affiliate Network
     *
     * @param int $id
     * @param string $name
     * @param string $postback_url
     * @param string $offer_param
     * @param string $notes
     * @return AffiliateNetwork
     * @throws Exception
     */
    public function updateAffiliateNetwork(
        int $id,
        string $name = '',
        string $postback_url = '',
        string $offer_param = '',
        string $notes = ''
    ): AffiliateNetwork {
        $data = array_filter(
            [
                'name' => $name,
                'postback_url' => $postback_url,
                'offer_param' => $offer_param,
                'notes' => $notes,
            ]
        );

        return new AffiliateNetwork($this->request('put', "/affiliate_networks/$id", $data));
    }

    /**
     * Move Affiliate Network to Archive
     *
     * @param int $id
     * @return AffiliateNetwork
     * @throws Exception
     */
    public function moveAffiliateNetworkToArchive(int $id): AffiliateNetwork
    {
        return new AffiliateNetwork($this->request('delete', "/affiliate_networks/$id"));
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
        return new AffiliateNetwork($this->request('post', "/affiliate_networks/$id/clone")[0]);
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
