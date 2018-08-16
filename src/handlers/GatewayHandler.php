<?php
/**
 * Project SphereMall SDK.
 * File: GatewayHandler.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 17:18
 */

namespace spheremall\handlers;

use spheremall\handlers\interfaces\Handler;
use yii\httpclient\Client;
use yii\web\HttpException;
use Yii;

/**
 * Class GatewayHandler
 * @package spheremall\handlers
 */
class GatewayHandler implements Handler
{

    protected $apiUrl;
    /** @var Client $http */
    protected $http;

    /**
     * GatewayHandler constructor.
     *
     * @param array $configs
     */
    public function __construct(array $configs = [])
    {
        if ($configs) {
            $this->setConfigs($configs);
        }

        $this->http = new Client([
            'transport' => 'yii\httpclient\CurlTransport'
        ]);
    }

    /**
     * @param array $configs
     *
     * @return $this
     */
    public function setConfigs(array $configs)
    {
        foreach ($configs as $configName => $configValue) {
            if (property_exists($this, $configName)) {
                $this->{$configName} = $configValue;
            }
        }

        return $this;
    }

    /**
     * @param string $url
     *
     * @param bool $critical
     *
     * @return mixed
     * @throws HttpException
     * @throws \yii\httpclient\Exception
     */
    public function request(string $url, bool $critical = true)
    {
        $url = $this->apiUrl . '/' . $url;

        $response = $this->http->createRequest()
            ->setMethod('GET')
            ->setUrl($url)
            ->send();
        if ($response->isOk) {
            return $response->getContent();
        }

        if ($critical) {
            throw new HttpException($response->getStatusCode(), $response->getContent());
        }

        return $response->getContent();
    }
}
