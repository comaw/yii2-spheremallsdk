<?php
/**
 * Project SphereMall SDK.
 * File: LimitParamResource.php
 * Created by Sergey Yanchevsky
 * 16.08.2018 12:46
 */

namespace spheremall\resources\traits;

/**
 * Trait LimitParamResource
 * @package spheremall\resources\traits
 */
trait LimitParamResource
{
    /**
     * Add limit to query params
     *
     *
     * @param int $limit
     *
     * @param bool $replace
     *
     * @return Resource|$this
     */
    public function limit(int $limit = 10, bool $replace = true)
    {
        $this->queriesParams['limit'] = $limit;

        return $this;
    }
}
