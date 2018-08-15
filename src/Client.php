<?php
/**
 * Project SphereMall SDK.
 * File: Client.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 11:09
 */

namespace spheremall;

use spheremall\handlers\interfaces\Handler;
use Yii;
use yii\web\HttpException;

/**
 * Class Client
 * @package spheremall
 *
 */
class Client
{
    #region [constants]
    const DEFAULT_HANDLER = '\\spheremall\\handlers\\GatewayHandler';
    #endregion

    #region [protected properties]
    protected static $instance;
    protected $configs = [];
    /** @var Handler $handler */
    protected $handler;
    #endregion

    #region [public static methods]
    /**
     * @param array $configs
     *
     * @return Client
     * @throws HttpException
     */
    public static function app(array $configs = [])
    {
        return static::$instance ?? (static::$instance = new static($configs));
    }
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
        if ($configs) {
            $this->setConfigs($configs);
        }
        $this->setHandler();
    }
    #endregion

    #region [public methods]
    /**
     * @param string $handler
     *
     * @return $this
     * @throws HttpException
     */
    public function setHandler(string $handler = '')
    {
        if (!$handler) {
            $handler = self::DEFAULT_HANDLER;
        }
        $this->handler = new $handler($this->configs);
        if (!is_a($this->handler, Handler::class)) {
            throw new HttpException(500, Yii::t('spheremall', 'Handler "{currentHandler}" is not correct "{baseHandler}" handler', [
                'currentHandler' => $handler,
                'baseHandler' => Handler::class,
            ]));
        }

        return $this;
    }
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
