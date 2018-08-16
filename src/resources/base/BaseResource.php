<?php
/**
 * Created by PhpStorm.
 * User: comaw
 * Date: 15.08.2018
 * Time: 22:48
 */

namespace spheremall\resources\base;

use spheremall\handlers\interfaces\Handler;
use spheremall\resources\interfaces\Resource;

/**
 * Class BaseResource
 * @package spheremall\resources\base
 */
abstract class BaseResource implements Resource
{

    #region [protected properties]
    /** @var Handler $handler */
    protected $handler;
    #endregion

    #region [abstract public methods]
    /**
     * @return string
     */
    abstract public function getBasePath(): string;
    #endregion

    #region [constructor]
    /**
     * BrandsResource constructor.
     * @param Handler|null $handler
     */
    public function __construct(Handler $handler = null)
    {
        if ($handler) {
            $this->setHandler($handler);
        }
    }
    #endregion

    #region [public methods]
    /**
     * @param int $id
     *
     * @return mixed
     */
    public function one(int $id)
    {
        $url = $this->getBasePath() . '/' . $id;

        return $this->handler->request($url);
    }

    /**
     * @param Handler $handler
     * @return $this
     */
    public function setHandler(Handler $handler)
    {
        $this->handler = $handler;

        return $this;
    }
    #endregion

    #region [public methods]
    /**
     * @param string $path
     * @return string
     */
    protected function getCurrentUrl(string $path = '')
    {
        $url = [];
        $url[] = $this->getBasePath();
        if ($path) {
            $url[] = $path;
        }

        return '/' . join('/', $url);
    }
    #endregion
}
