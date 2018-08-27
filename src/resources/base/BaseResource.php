<?php
/**
 * Created by PhpStorm.
 * User: comaw
 * Date: 15.08.2018
 * Time: 22:48
 */

namespace spheremall\resources\base;

use spheremall\handlers\interfaces\Handler;
use spheremall\makers\EntitiesMaker;
use spheremall\makers\interfaces\MakerInterface;
use spheremall\resources\interfaces\Resource;
use spheremall\resources\traits\InParamResource;
use spheremall\resources\traits\LimitParamResource;
use spheremall\resources\traits\WhereParamResource;

/**
 * Class BaseResource
 * @package spheremall\resources\base
 */
abstract class BaseResource implements Resource
{
    use WhereParamResource, LimitParamResource, InParamResource;

    #region [protected properties]
    /** @var Handler $handler */
    protected $handler;
    /** @var array  $queriesParams*/
    protected $queriesParams     = [];
    /** @var array  $relationResources*/
    protected $relationResources = [];
    /** @var MakerInterface $maker */
    protected $maker;
    /** @var array $entities */
    protected $entities;
    #endregion

    #region [abstract public methods]
    /**
     * @return string
     */
    abstract public function getBasePath(): string;

    /**
     * @param MakerInterface $maker
     *
     * @return $this
     */
    abstract public function setMaker(MakerInterface $maker);
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
        $this->maker = new EntitiesMaker();
    }
    #endregion

    #region [public methods]
    /**
     * @param array $resources
     *
     * @return $this
     */
    public function with(array $resources)
    {
        $this->relationResources = $resources;

        return $this;
    }

    /**
     *
     * @return mixed
     */
    public function one()
    {
        $url = $this->getBasePath() . '';
        $this->limit(1)->offset(0);

        $response = $this->handler->request($url, $this->getParams());

        $this->entities = $this->maker->setData($response)->generate()->getEntities();

        return $entities[0] ?? null;
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function oneById(int $id)
    {
        $url = $this->getBasePath() . '/' . $id;

        return $this->handler->request($url, $this->getParams());
    }

    /**
     * @return mixed
     */
    public function list()
    {
        $url = $this->getBasePath() . '';

        return $this->handler->request($url, $this->getParams());
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
    protected function getRelations()
    {

    }

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

    /**
     * @return array
     */
    protected function getParams(): array
    {
        return $this->queriesParams;
    }
    #endregion
}
