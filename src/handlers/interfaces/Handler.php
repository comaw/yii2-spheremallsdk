<?php
/**
 * Project SphereMall SDK.
 * File: Handler.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 17:18
 */

namespace spheremall\handlers\interfaces;

/**
 * Interface Handler
 * @package spheremall\handlers\interfaces
 */
interface Handler
{
    /**
     * Set config for Handler
     *
     * @param array $configs
     *
     */
    public function setConfigs(array $configs);

    /**
     * @param string $url
     * @param array $params
     *
     * @param bool $critical
     *
     * @return mixed
     */
    public function request(string $url, array $params = [], bool $critical = true);
}
