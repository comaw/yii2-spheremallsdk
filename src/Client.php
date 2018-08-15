<?php
/**
 * Project SphereMall SDK.
 * File: Client.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 11:09
 */

namespace spheremall;

use spheremall\handlers\interfaces\Handler;
use spheremall\resources\BrandsResource;
use Yii;
use yii\web\HttpException;

/**
 * Class Client
 * @package spheremall
 *
 * @property BrandsResource $brands
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
    /** @var array $listOfResources */
    protected $listOfResources = [];
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
     * @param $resource
     *
     * @return $this
     * @throws HttpException
     */
    public function resource($resource)
    {
        if (is_string($resource)) {
            $this->setResource($resource);

            return $this;
        }

        if (is_array($resource)) {
            foreach ($resource as $resourceName) {
                $this->setResource($resourceName);
            }

            return $this;
        }

        throw new HttpException(500, Yii::t('spheremall', '"resource" param must be a string or an array of strings'));
    }

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

    #region [public magic methods]
    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function __set(string $name, $value)
    {
        $this->listOfResources[$name] = $value;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return mixed|null
     * @throws HttpException
     */
    public function __get(string $name)
    {
        if (!array_key_exists($name, $this->listOfResources)) {
            $this->setResource($name);
        }

        return $this->listOfResources[$name] ?? null;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function __isset(string $name)
    {
        return array_key_exists($name, $this->listOfResources);
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function __unset(string $name)
    {
        if (array_key_exists($name, $this->listOfResources)) {
            unset($this->listOfResources[$name]);
        }

        return $this;
    }
    #endregion

    #region [public magic methods]
    /**
     * @param string $name
     *
     * @return Client
     * @throws HttpException
     */
    protected function setResource(string $name)
    {
        $name = mb_strtolower($name);
        $resourceName = '\\spheremall\\resources\\' . ucfirst($name) . 'Resource';
        if (!class_exists($resourceName)) {
            throw new HttpException(500, Yii::t('spheremall', '"{resourceName}" resource not found', ['resourceName' => $name]));
        }
        $this->{$name} = new $resourceName($this->handler);

        return $this;
    }
    #endregion
}
