<?php
/**
 * Project SphereMall SDK.
 * File: Client.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 11:09
 */

namespace spheremall;

use Yii;
use yii\web\HttpException;

/**
 * Class Client
 * @package spheremall
 */
class Client
{
    #region [protected properties] gateway-iedereenfitopschool.nl
    protected $configs = [];
    #endregion

    #region [constructor]
    /**
     * Client constructor.
     *
     * @param array $configs
     *
     * @throws HttpException
     */
    public function __construct(array $configs = [])
    {
        $this->setConfigs($configs);
    }
    #endregion

    #region [public methods]
    /**
     * @param array $configs
     *
     * @return Client
     * @throws HttpException
     */
    public function setConfigs(array $configs = [])
    {
        $this->configs = $configs ? $configs : (Yii::$app->params['spheremall'] ?? []);
        if (!isset($this->configs['api_url'])) {
            $message = $configs
                ? Yii::t('spheremall', '"api_url" params not set')
                : Yii::t('spheremall', '"api_url" params not set in config/params.php file');

            throw new HttpException(500, $message);
        }


        if (!isset($this->configs['client_id']) && !isset($this->configs['client_secret'])) {
            $message = $configs
                ? Yii::t('spheremall', '"client_id" or "client_secret" params not set')
                : Yii::t('spheremall', '"spheremall.client_id" or "spheremall.client_secret" params not set in config/params.php file');

            throw new HttpException(500, $message);
        }

        return $this;
    }
    #endregion
}
