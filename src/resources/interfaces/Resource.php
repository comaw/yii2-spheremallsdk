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
     * @return string
     */
    public function getBasePath(): string;
}
