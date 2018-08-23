<?php
/**
 * Project SphereMall SDK.
 * File: Resource.php
 * Created by Sergey Yanchevsky
 * 15.08.2018 11:11
 */

namespace spheremall\resources\interfaces;

/**
 * Interface Resource
 * @package spheremall\resources\interfaces
 */
interface Resource
{
    /**
     * Get first result by params
     */
    public function one();

    /**
     * @param int $id
     */
    public function oneById(int $id);

    /**
     * @return mixed
     */
    public function list();

    /**
     * @return string
     */
    public function getBasePath(): string;

    /**
     * Add query params
     * For example:
     * ['e', 'url', 'some_url'] => [{"url":{"e":"some_url"}}]
     * ['ne', 'active', '1'] => [{"active":{"ne":"1"}}]
     *
     *
     * @param array $param
     *
     * @return Resource
     */
    public function where(array $param);

    /**
     * Add in params
     * For example:
     * ['url', ['some_url', '1', 'any']] => [{"url":["some_url", "1", "any"]}]
     *
     *
     * @param array $in
     *
     * @return Resource|$this
     */
    public function in(array $in);

    /**
     * Set relationships for resources
     *
     * @param array $resources
     *
     */
    public function with(array $resources);
}
