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
    /** @var Handler $handler */
    protected $handler;

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

    /**
     * @param Handler $handler
     * @return $this
     */
    public function setHandler(Handler $handler)
    {
        $this->handler = $handler;

        return $this;
    }

    /**
     * @param int $id
     */
    abstract public function one(int $id = 0);

    /**
     * @return string
     */
    abstract public function getBasePath(): string;

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
}
