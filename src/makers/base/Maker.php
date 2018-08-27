<?php
/**
 * Project SphereMall SDK.
 * File: Maker.php
 * Created by Sergey Yanchevsky
 * 23.08.2018 17:43
 */

namespace spheremall\makers\base;

use spheremall\makers\interfaces\MakerInterface;
use yii\helpers\Json;

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
     * @param string $data
     *
     * @return $this|MakerInterface
     */
    public function setData(string $data)
    {
        $this->data = Json::decode($data);

        return $this;
    }

    /**
     * @return $this|MakerInterface
     */
    public function generate()
    {
        $data     = $this->data['data'] ?? [];
        $included = $this->data['included'] ?? [];
        if (!$data) {
            return $this;
        }
        $this->dataProcessing($data);

        return $this;
    }

    /**
     * @return array
     */
    public function getEntities(): array
    {
        return $this->entities;
    }

    protected function dataProcessing(array $data)
    {
        foreach ($data as $entity) {
            $type = $entity['type'] ?? '';
            if (!$type) {
                continue;
            }
            $modelName = '\\spheremall\\models\\' . ucfirst($type);
            if (!class_exists($modelName)) {
                continue;
            }
            $this->entities[] = new $modelName($entity);
        }

        return $this;
    }
}
