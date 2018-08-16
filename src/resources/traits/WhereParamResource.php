<?php
/**
 * Project SphereMall SDK.
 * File: WhereParamResource.php
 * Created by Sergey Yanchevsky
 * 16.08.2018 12:46
 */

namespace spheremall\resources\traits;

use yii\helpers\Json;

/**
 * Trait WhereParamResource
 * @package spheremall\resources\traits
 */
trait WhereParamResource
{
    /**
     * Add query params
     * For example:
     * ['e', 'url', 'some_url'] => [{"url":{"e":"some_url"}}]
     * ['ne', 'active', '1'] => [{"active":{"ne":"1"}}]
     *
     *
     * @param array $param
     *
     * @return Resource|$this
     */
    public function where(array $param)
    {
        $where = Json::decode($this->queriesParams['where'] ?? "[]", true);
        $where[] = [$param[1] => [$param[0] => $param[2]]];
        $this->queriesParams['where'] = Json::encode($where);

        return $this;
    }
}
