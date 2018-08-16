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
     * @param int $id
     */
    public function one(int $id);

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
}
