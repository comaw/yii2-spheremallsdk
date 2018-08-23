<?php
/**
 * Project SphereMall SDK.
 * File: Maker.php
 * Created by Sergey Yanchevsky
 * 23.08.2018 17:43
 */

namespace spheremall\makers\base;

use spheremall\makers\interfaces\MakerInterface;

/**
 * Class Maker
 * @package spheremall\makers\base
 */
abstract class Maker implements MakerInterface
{

    protected $data     = [];
    protected $entities = [];

    /**
     * Maker constructor.
     *
     */
    public function __construct()
    {

    }

    /**
     * @param array $data
     *
     * @return $this|MakerInterface
     */
    public function setData(array $data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return $this|MakerInterface
     */
    public function generate()
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }
}
