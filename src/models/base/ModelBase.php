<?php
/**
 * Project SphereMall SDK.
 * File: ModelBase.php
 * Created by Sergey Yanchevsky
 * 23.08.2018 17:45
 */

namespace spheremall\models\base;

use spheremall\models\interfaces\ModelInterface;

/**
 * Class ModelBase
 * @package spheremall\models\base
 */
abstract class ModelBase implements ModelInterface
{
    /** @var array $attributes */
    protected $attributes = [];

    /**
     * ModelBase constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        if ($attributes) {
            $this->setAttributes($attributes);
        }
    }

    /**
     * @param array $attributes
     *
     * @return ModelBase
     */
    public function setAttributes(array $attributes)
    {
        $id               = $attributes['id'] ?? 0;
        $attributes       = $attributes['attributes'] ?? $attributes;
        $attributes['id'] = $id;
        foreach ($attributes as $name => $value) {
            if (!is_string($name)) {
                continue;
            }
            $this->{$name} = $value;
        }

        return $this;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function __set(string $name, $value)
    {
        $this->attributes[$name] = $value;

        return $this;
    }

    /**
     * @param $name
     *
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * @param $name
     *
     * @return bool
     */
    public function __isset($name): bool
    {
        return isset($this->attributes[$name]);
    }

    public function __unset($name)
    {
        if (isset($this->attributes[$name])) {
            unset($this->attributes[$name]);
        }
    }

    /**
     * @param string $resource
     * @param array $relations
     *
     * @return array
     */
    protected function hasOne(string $resource, array $relations): array
    {
        return [
            'resource'  => $resource,
            'relations' => $relations,
        ];
    }
}
