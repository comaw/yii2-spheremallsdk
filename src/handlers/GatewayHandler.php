<?php
/**
 * Project SphereMall SDK.
 * File: GatewayHandler.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 17:18
 */

namespace spheremall\handlers;

use spheremall\handlers\interfaces\Handler;

/**
 * Class GatewayHandler
 * @package spheremall\handlers
 */
class GatewayHandler implements Handler
{

    protected $url;

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
}
